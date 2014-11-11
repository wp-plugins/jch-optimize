<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('_WP_EXEC') or die('Restricted access');

class JchPlatformPaths implements JchInterfacePaths
{

        /**
         * 
         * @param type $url
         * @return type
         */
        public static function absolutePath($url)
        {
                return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, ABSPATH) . str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $url);
        }

        /**
         * 
         * @return type
         */
        public static function assetPath()
        {
                if (($rewrite_base = self::rewriteBase()) != '')
                {
                        return $rewrite_base . 'jch-optimize/assets';
                }
                else
                {
                        return plugins_url() . '/jch-optimize/assets';
                }
        }

        /**
         * 
         * @return type
         */
        public static function rewriteBase()
        {
                static $rewrite_base;

                if (!isset($rewrite_base))
                {
                        $rewrite_base     = '';
                        
                        $plugin_file_path = untrailingslashit(str_replace('jch-optimize', '', JCH_PLUGIN_DIR));

                        if (file_exists($plugin_file_path) && isset($_SERVER['DOCUMENT_ROOT']))
                        {
                                $rewrite_base = trailingslashit(JchOptimizeHelper::strReplace(untrailingslashit($_SERVER['DOCUMENT_ROOT']), '',
                                                                                                                $plugin_file_path));
                        }
                }

                return $rewrite_base;
        }

        /**
         * 
         * @return type
         */
        public static function spriteDir($url = FALSE)
        {
                if ($url)
                {
                        return JchOptimizeHelper::getBaseFolder() . 'assets/sprites/';
                }

                return JCH_PLUGIN_DIR . 'assets/sprites';
        }

        /**
         * 
         * @param type $sPath
         */
        public static function path2Url($sPath)
        {
                $oUri        = clone JchPlatformUri::getInstance();
                $sJbase      = JchPlatformUri::base(true);
                $sBaseFolder = $sJbase == '/' ? $sJbase : $sJbase . '/';

                $abspath = str_replace(DIRECTORY_SEPARATOR, '/', ABSPATH);
                $sPath   = str_replace(DIRECTORY_SEPARATOR, '/', $sPath);

                $sUriPath = $oUri->toString(array('scheme', 'user', 'pass', 'host', 'port')) . $sBaseFolder .
                        (str_replace($abspath, '', $sPath));

                return $sUriPath;
        }

        /**
         * 
         * @param type $function
         * @return type
         */
        public static function ajaxUrl($function)
        {
                return admin_url() . 'admin-ajax.php?action=' . $function;
        }
        
        /**
         * 
         * @return type
         */
        public static function rootPath()
        {
                return ABSPATH;
        }

}
