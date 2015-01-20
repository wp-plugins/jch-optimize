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
                return self::rewriteBase() . 'jch-optimize/assets';
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
                        $uri = JchPlatformUri::getInstance();
                        $domain = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
                        
                        $rewrite_base = trailingslashit(str_replace($domain, '', plugins_url()));
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
                        return JchOptimizeHelper::getBaseFolder() . 'media/sprites/';
                }

                return JCH_PLUGIN_DIR . 'media/sprites';
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
        
        /**
         * 
         */
        public static function imageFolder()
        {
               return JCH_PLUGIN_URL . 'media/images/'; 
        }

}
