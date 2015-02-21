<?php

/**
 * JCH Optimize - Joomla! plugin to aggregate and minify external resources for
 * optmized downloads
 *
 * @author Samuel Marshall <sdmarshall73@gmail.com>
 * @copyright Copyright (c) 2014 Samuel Marshall
 * @license GNU/GPLv3, See LICENSE file
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * If LICENSE file missing, see <http://www.gnu.org/licenses/>.
 */
defined('_WP_EXEC') or die('Restricted access');

class JchPlatformCache implements JchInterfaceCache
{

        protected static $wp_filesystem;

        /**
         * 
         * @param type $id
         * @param type $lifetime
         * @return type
         */
        public static function getCache($id, $lifetime)
        {
                $filename = self::_getFileName($id);

                $file = JCH_CACHE_DIR . $filename;

                if (!file_exists($file))
                {
                        return FALSE;
                }

                return self::_getCacheFile($file);
        }

        /**
         * 
         * @param type $id
         * @param type $lifetime
         * @param type $function
         * @param type $args
         * @return type
         */
        public static function getCallbackCache($id, $lifetime, $function, $args)
        {
                $wp_filesystem = self::getWpFileSystem();

                $filename = self::_getFileName($id);

                $file = JCH_CACHE_DIR . $filename;

                if (!file_exists($file) || filemtime($file) > (time() + $lifetime))
                {
                        $contents = call_user_func_array($function, $args);

                        $filecontents = base64_encode(serialize($contents));

                        self::initializeCache();
                        
                        if ($wp_filesystem->put_contents($file, $filecontents))
                        {
                                return $contents;
                        }
                        else
                        {
                                throw new Exception(__('Error writing files to cache'));
                        }
                }

                return self::_getCacheFile($file);
        }

        /**
         * 
         * @param type $type
         * @return type
         */
        public static function deleteCache()
        {
                $dir = JCH_CACHE_DIR;
                
                $FI = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);

                foreach ($FI as $file)
                {
                        $filename = $file->getFileName();

                        if ($filename == 'index.html')
                        {
                                continue;
                        }

                        if (!@unlink($dir . $filename))
                        {
                                return FALSE;
                        }
                }

                return TRUE;
        }

        /**
         * 
         * @param type $file
         * @return type
         */
        private static function _getCacheFile($file)
        {
                $content = file_get_contents($file);

                return unserialize(base64_decode($content));
        }

        /**
         * 
         */
        public static function initializeCache()
        {
                $wp_filesystem = self::getWpFileSystem();

                if (!$wp_filesystem->exists(JCH_CACHE_DIR))
                {
                        @mkdir(JCH_CACHE_DIR, FS_CHMOD_DIR, TRUE);

                        $index = JCH_CACHE_DIR . 'index.html';
                        $wp_filesystem->put_contents($index, '<html><body></body></html>');
                }
        }

        /**
         * 
         * @global type $wp_filesystem
         * @return type
         */
        public static function getWpFileSystem()
        {
                if (!isset(self::$wp_filesystem))
                {
                        if (!class_exists('WP_Filesystem_Base'))
                        {
                                include_once ABSPATH . 'wp-admin/includes/file.php';
                        }

                        WP_Filesystem(request_filesystem_credentials(
                                        admin_url('options-general.php?page=jchoptimize-settings'), 'direct', false, plugins_url(), null
                        ));

                        global $wp_filesystem;

                        self::$wp_filesystem = $wp_filesystem;
                }

                return self::$wp_filesystem;
        }

        /**
         * 
         * @param type $id
         * @return type
         */
        private static function _getFileName($id)
        {
                return md5(NONCE_SALT . $id);
        }

}
