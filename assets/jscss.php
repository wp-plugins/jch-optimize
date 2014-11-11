<?php

/**
 * JCH Optimize - Joomla! plugin to aggregate and minify external resources for 
 *   optmized downloads
 * @author Samuel Marshall <sdmarshall73@gmail.com>
 * @copyright Copyright (c) 2010 Samuel Marshall. All rights reserved.
 * @license GNU/GPLv3, See LICENSE file 
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
 * 
 * This plugin includes other copyrighted works. See individual 
 * files for details.
 */
include dirname(__FILE__) . '/dir.php';

define('SHORTINIT', TRUE);

if (!isset($wp_did_header))
{
        $wp_did_header = true;

        require_once( $DIR . 'wp-load.php' );
}

require( ABSPATH . WPINC . '/formatting.php' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/widgets.php' );

wp_plugin_directory_constants();

$GLOBALS['wp_plugin_paths'] = array();

foreach (wp_get_active_and_valid_plugins() as $plugin)
{
        if (strpos($plugin, 'jch-optimize') !== FALSE)
        {
                wp_register_plugin_realpath($plugin);
                include_once( $plugin );
                break;
        }
}
unset($plugin);

function __(){};

JchOptimizeOutput::getCombinedFile();

