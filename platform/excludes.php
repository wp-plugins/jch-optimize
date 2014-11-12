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

class JchPlatformExcludes implements JchInterfaceExcludes
{

        /**
         * 
         * @param type $type
         * @param type $section
         * @return type
         */
        public static function body($type, $section = 'file')
        {
                if ($type == 'js')
                {
                        if ($section == 'script')
                        {
                                return array();
                        }
                        else
                        {
                                return array();
                        }
                }

                if ($type == 'css')
                {
                        return array();
                }
        }

        /**
         * 
         * @return type
         */
        public static function extensions()
        {
                static $plugins_url_path = '';

                if ($plugins_url_path == '')
                {
                        $uri = JchPlatformUri::getInstance(plugins_url());

                        $uribase = preg_quote(JchPlatformUri::base(TRUE));
                        
                        $plugins_url_path = preg_replace("#{$uribase}#", '', $uri->toString(array('path')));
                        $plugins_url_path = preg_replace('#^/#', '', $plugins_url_path);
                }

                return $plugins_url_path . '/';
        }

        /**
         * 
         * @param type $type
         * @param type $section
         * @return type
         */
        public static function head($type, $section = 'file')
        {
                if ($type == 'js')
                {
                        if ($section == 'script')
                        {
                                return array();
                        }
                        else
                        {
                                return array();
                        }
                }

                if ($type == 'css')
                {
                        return array();
                }
        }

        /**
         * 
         * @param type $url
         * @return type
         */
        public static function editors($url)
        {
                return (preg_match('#/editors/#i', $url));
        }

}
