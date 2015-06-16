<?php

/**
 * JCH Optimize - Plugin to aggregate and minify external resources for
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
add_action('admin_menu', 'add_jch_optimize_menu');

function add_jch_optimize_menu()
{
        $hook_suffix = add_options_page(__('JCH Optimize Settings', 'jch-optimize'), 'JCH Optimize', 'manage_options', 'jchoptimize-settings',
                                           'jch_options_page');

        add_action('admin_print_scripts-' . $hook_suffix, 'jch_load_resource_files');
        add_action('admin_footer-' . $hook_suffix, 'jch_load_scripts');
        add_action('load-' . $hook_suffix, 'jch_initialize_settings');
}

function jch_options_page()
{
        if (version_compare(PHP_VERSION, '5.3.0', '<'))
        {

                ?>

                <div class="notice notice-error">
                        <p> <?php _e('This plugin requires PHP 5.3.0 or greater to run. Your installed version is: ' . PHP_VERSION, 'jch-optimize') ?></p>
                </div>
                <?php

        }

        ?>
        <div>
                <h2>JCH Optimize Settings</h2>
                <form action="options.php" method="post" class="jch-settings-form">
                        <div style="width: 90%;">
                                <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes', 'jch-optimize'); ?>" />
                                <?php

                                
                                  ?>
                                  <a class="right button button-secondary" href="https://www.jch-optimize.net/subscribe/new/jchoptimizewp.html?layout=default" target="_blank"><?php _e('Upgrade to Pro', 'jch-optimize'); ?></a>

                                  <?php
                                  

                                ?>

                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                                <li class="active"><a href="#description" data-toggle="tab"><?php _e('Description', 'jch-optimize') ?></a></li>

                                <?php

                                if (version_compare(PHP_VERSION, '5.3.0', '>='))
                                {

                                        ?>

                                        <li><a href="#basic" data-toggle="tab"><?php _e('Basic Settings', 'jch-optimize') ?></a></li>
                                        <li><a href="#advanced" data-toggle="tab"><?php _e('Advanced Settings', 'jch-optimize') ?></a></li>
                                        <li><a href="#pro" data-toggle="tab"><?php _e('Pro Options', 'jch-optimize') ?></a></li>
                                        <li><a href="#sprite" data-toggle="tab"><?php _e('Sprite Generator', 'jch-optimize') ?></a></li>
                                        <li><a href="#images" data-toggle="tab"><?php _e('Optimize Images', 'jch-optimize') ?></a></li>
                                        <?php

                                }

                                ?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                                <div class="tab-pane active" id="description">
                                        <div id="extension-container" style="text-align:left;">
                                                <h1>JCH Optimize Plugin</h1>
                                                <h3>(Version 1.2.1)</h3>
                                                <?php

                                                
                                                  echo '<p class="notice notice-info" style="margin: 1em 0; padding: 10px 12px">' . __('This is the free version of JCH Optimize for WordPress. For access to advance features please <a href="https://www.jch-optimize.net/subscribe/new/jchoptimizewp.html?layout=default" target="_blank">purchase the Pro Version!</a>') . '</p>';

                                                  

                                                ?>
                                                <p>Can automatically optimize external resources like CSS and JavaScript, which can reduce both the size and number of requests made to your website and also compress HTML output for optimized download. GZip generated CSS and JavaScript files to about 1/4 of the original size. These optimizations may reduce server load, bandwidth requirements, and page loading times.</p>
                                                <h2>Major Features</h2>
                                                <ul>
                                                        <li>Javascript and CSS files aggregation and minification.</li>
                                                        <li>HTML minification.</li>
                                                        <li>GZip Compress aggregated files.</li>
                                                        <li>Generate sprite to combine background images.</li>
                                                </ul>
                                                <h2>Instructions</h2>
                                                <p>Use the Automatic Settings (Minimum - Optimum) to configure the plugin. This automatically sets the options in the 'Automatic Settings Groups'. You can then try the other manual options to further configure the plugin and optimize your site. Use the Exclude options to exclude files/plugins/images that don't work so well with the plugin.</p>
                                                <h2>Support</h2>
                                                <p>First check out the <a href="https://www.jch-optimize.net/documentation.html" target="_blank">documentation</a> and especially the <a href="https://www.jch-optimize.net/documentation/tutorials.html" target="_blank">tutorials</a> on the plugin's website to learn how to use and configure the plugin.</p>
                                                <p>To get a more verbose description of the plugin options go <a href="https://www.jch-optimize.net/documentation/plugin-options.html" target="_blank">here</a>.
                                                </p>
                                                <p><a href="https://www.jch-optimize.net/support/knowlegebase.html" target="_blank">Here</a> are a couple common problems encountered by some persons using the plugin.</p>
                                                <p>If you need technical support via our ticket system or assistance in configuring the plugin click <a href="https://www.jch-optimize.net/support/tickets/ticket-list/new.html" target="_blank">here</a>. You'll need a subscription to submit tickets or get support in configuring the plugin to resolve conflicts. Otherwise you can use the <a href="https://www.jch-optimize.net/support/q-a-forum.html" target="_blank" >Forums</a> on the plugin's website or the <a href="https://wordpress.org/support/plugin/jch-optimize" target="_blank" >WordPress support system</a>.
                                                </p> 
                                                <p class="notice notice-info" style="margin: 1em 0; padding: 10px 12px">If you use this plugin please consider posting a review on the plugin's <a href="https://wordpress.org/support/view/plugin-reviews/jch-optimize" target="_blank" >WordPress page</a>. If you're having problems please submit for support and give us a chance to resolve your issues before reviewing. Thanks.</p>

                                        </div>
                                </div>
                                <?php do_settings_sections('jch-sections'); ?>
                        </div>

                        <?php settings_fields('jch_options'); ?>
                        <input name="Submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save Changes', 'jch-optimize'); ?>" />
                </form>
        </div>
        <?php

}

add_action('admin_init', 'jch_register_options');

function jch_register_options()
{
        register_setting('jch_options', 'jch_options', 'jch_options_validate');
}

function jch_initialize_settings()
{
        wp_register_style('jch-bootstrap-css', JCH_PLUGIN_URL . 'media/css/bootstrap.css');
        wp_register_style('jch-icons-css', JCH_PLUGIN_URL . 'media/css/icons.css');
        wp_register_style('jch-fonts-css', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css');
        wp_register_style('jch-chosen-css', JCH_PLUGIN_URL . 'media/css/jquery.chosen.min.css');

        wp_register_script('jch-bootstrap-js', JCH_PLUGIN_URL . 'media/js/bootstrap.min.js', array('jquery'), JCH_VERSION, TRUE);
        wp_register_script('jch-tabsstate-js', JCH_PLUGIN_URL . 'media/js/tabs-state.js', array('jquery'), JCH_VERSION, TRUE);
        wp_register_script('jch-adminutility-js', JCH_PLUGIN_URL . 'media/js/admin-utility.js', array('jquery'), JCH_VERSION, TRUE);
        wp_register_script('jch-chosen-js', JCH_PLUGIN_URL . 'media/js/jquery.chosen.min.js', array('jquery'), JCH_VERSION, TRUE);
        wp_register_script('jch-collapsible-js', JCH_PLUGIN_URL . 'media/js/jquery.collapsible.js', array('jquery'), JCH_VERSION, TRUE);

        

        if (version_compare(PHP_VERSION, '5.3.0', '<'))
        {
                return;
        }

        global $jch_redirect;
        $jch_redirect = FALSE;

        check_jch_tasks();
        jch_get_cache_info();
        jch_redirect();
        jch_get_admin_object();

        if (get_transient('jch_notices'))
        {
                add_action('admin_notices', 'jch_send_notices');
        }


        add_settings_section('jch_basic_pre', '', 'jch_basic_pre_section_text', 'jch-sections');
        add_settings_field('jch_options_auto_settings', __('Automatic Settings', 'jch-optimize'), 'jch_options_auto_settings_string', 'jch-sections',
                                                           'jch_basic_pre');
        add_settings_section('jch_basic_auto', '', 'jch_basic_auto_section_text', 'jch-sections');
        add_settings_field('jch_options_css', __('Combine CSS Files', 'jch-optimize'), 'jch_options_css_string', 'jch-sections', 'jch_basic_auto');
        add_settings_field('jch_options_javascript', __('Combine Javascript Files', 'jch-optimize'), 'jch_options_javascript_string', 'jch-sections',
                                                        'jch_basic_auto');
        add_settings_field('jch_options_gzip', __('Gzip Combined Files', 'jch-optimize'), 'jch_options_gzip_string', 'jch-sections', 'jch_basic_auto');
        add_settings_field('jch_options_css_minify', __('Minify Combined CSS File', 'jch-optimize'), 'jch_options_css_minify_string', 'jch-sections',
                                                        'jch_basic_auto');
        add_settings_field('jch_options_js_minify', __('Minify Combined Javascript File', 'jch-optimize'), 'jch_options_js_minify_string',
                                                       'jch-sections', 'jch_basic_auto');
        add_settings_field('jch_options_html_minify', __('Minify HTML', 'jch-optimize'), 'jch_options_html_minify_string', 'jch-sections',
                                                         'jch_basic_auto');
        add_settings_field('jch_options_defer_js', __('Defer combined javascript', 'jch-optimize'), 'jch_options_defer_js_string', 'jch-sections',
                                                      'jch_basic_auto');
        add_settings_field('jch_options_bottom_js', __('Manage Combined Files', 'jch-optimize'), 'jch_options_bottom_js_string', 'jch-sections',
                                                       'jch_basic_auto');
        add_settings_section('jch_basic_manual', '', 'jch_basic_manual_section_text', 'jch-sections');
        add_settings_field('jch_options_html_minify_level', __('HTML Minification Level', 'jch-optimize'), 'jch_options_html_minify_level_string',
                                                               'jch-sections', 'jch_basic_manual');
        add_settings_field('jch_options_lifetime', __('Lifetime (days)', 'jch-optimize'), 'jch_options_lifetime_string', 'jch-sections',
                                                      'jch_basic_manual');
        add_settings_field('jch_options_manage_cache', __('Manage JCH Optimize Cache', 'jch-optimize'), 'jch_options_manage_cache_string',
                                                          'jch-sections', 'jch_basic_manual');


        add_settings_section('jch_advanced_auto', '', 'jch_advanced_auto_section_text', 'jch-sections');
        add_settings_field('jch_options_excludeAllExtensions', __('Exclude files from all plugins', 'jch-optimize'),
                                                                  'jch_options_excludeAllExtensions_string', 'jch-sections', 'jch_advanced_auto');
        add_settings_section('jch_advanced_exclude', '', 'jch_advanced_exclude_section_text', 'jch-sections');
        add_settings_field('jch_options_excludeCss', __('Exclude these CSS files', 'jch-optimize'), 'jch_options_excludeCss_string', 'jch-sections',
                                                        'jch_advanced_exclude');
        add_settings_field('jch_options_excludeJs', __('Exclude these javascript files', 'jch-optimize'), 'jch_options_excludeJs_string',
                                                       'jch-sections', 'jch_advanced_exclude');
        add_settings_field('jch_options_excludeCssComponents', __('Exclude CSS files from these plugins', 'jch-optimize'),
                                                                  'jch_options_excludeCssComponents_string', 'jch-sections', 'jch_advanced_exclude');
        add_settings_field('jch_options_excludeJsComponents', __('Exclude javascript files from these plugins', 'jch-optimize'),
                                                                 'jch_options_excludeJsComponents_string', 'jch-sections', 'jch_advanced_exclude');
        add_settings_section('jch_advanced_manual', '', 'jch_advanced_manual_section_text', 'jch-sections');
        add_settings_field('jch_options_htaccess', __('Enable url re-writing', 'jch-optimize'), 'jch_options_htaccess_string', 'jch-sections',
                                                      'jch_advanced_manual');
        add_settings_field('jch_options_debug', __('Debug plugin', 'jch-optimize'), 'jch_options_debug_string', 'jch-sections', 'jch_advanced_manual');
        add_settings_field('jch_options_log', __('Log Exceptions', 'jch-optimize'), 'jch_options_log_string', 'jch-sections', 'jch_advanced_manual');
        add_settings_field('jch_options_try_catch', __('Use try catch', 'jch-optimize'), 'jch_options_try_catch_string', 'jch-sections',
                                                       'jch_advanced_manual');
        
        add_settings_section('jch_pro_group', '', 'jch_pro_group_section_text', 'jch-sections');
        add_settings_field('jch_options_pro_downloadid', __('Download ID', 'jch-optimize'), 'jch_options_pro_downloadid_string',
                                                                'jch-sections', 'jch_pro_group');
        
        add_settings_section('jch_pro_auto', '', 'jch_pro_auto_section_text', 'jch-sections');
        add_settings_field('jch_options_pro_replaceImports', __('Replace @imports in CSS', 'jch-optimize'), 'jch_options_pro_replaceImports_string',
                                                                'jch-sections', 'jch_pro_auto');
        add_settings_field('jch_options_pro_phpAndExternal', __('Include PHP files and files from external domains', 'jch-optimize'),
                                                                'jch_options_pro_phpAndExternal_string', 'jch-sections', 'jch_pro_auto');
        add_settings_field('jch_options_pro_inlineStyle', __('Include inline CSS styles', 'jch-optimize'), 'jch_options_pro_inlineStyle_string',
                                                             'jch-sections', 'jch_pro_auto');
        add_settings_field('jch_options_pro_inlineScripts', __('Include inline scripts', 'jch-optimize'), 'jch_options_pro_inlineScripts_string',
                                                               'jch-sections', 'jch_pro_auto');
        add_settings_field('jch_options_pro_searchBody', __('Parse body of page for CSS/Js files', 'jch-optimize'),
                                                            'jch_options_pro_searchBody_string', 'jch-sections', 'jch_pro_auto');
        add_settings_field('jch_options_pro_loadAsynchronous', __('Load combined javascript asynchronously', 'jch-optimize'),
                                                                  'jch_options_pro_loadAsynchronous_string', 'jch-sections', 'jch_pro_auto');
        add_settings_section('jch_pro_manual', '', 'jch_pro_manual_section_text', 'jch-sections');
        add_settings_field('jch_options_pro_lazyload', __('Lazy Load Images', 'jch-optimize'), 'jch_options_pro_lazyload_string', 'jch-sections',
                                                          'jch_pro_manual');
        add_settings_field('jch_options_pro_optimizeCssDelivery', __('Optimize CSS Delivery', 'jch-optimize'),
                                                                     'jch_options_pro_optimizeCssDelivery_string', 'jch-sections', 'jch_pro_manual');
        add_settings_field('jch_options_pro_cookielessdomain', __('CDN / Cookieless Domain', 'jch-optimize'),
                                                                  'jch_options_pro_cookielessdomain_string', 'jch-sections', 'jch_pro_manual');

        add_settings_section('jch_pro_exclude', '', 'jch_pro_exclude_section_text', 'jch-sections');
        add_settings_field('jch_options_pro_excludeLazyLoad', __('Exclude these images from lazy loading', 'jch-optimize'),
                                                                 'jch_options_pro_excludeLazyLoad_string', 'jch-sections', 'jch_pro_exclude');
        add_settings_field('jch_options_pro_excludeScripts', __('Exclude individual scripts', 'jch-optimize'),
                                                                'jch_options_pro_excludeScripts_string', 'jch-sections', 'jch_pro_exclude');
        add_settings_field('jch_options_pro_loadFilesAsync', __('Load these individual javascript files asynchronously', 'jch-optimize'),
                                                                'jch_options_pro_loadFilesAsync_string', 'jch-sections', 'jch_pro_exclude');

        add_settings_section('jch_sprite_manual', '', 'jch_sprite_manual_section_text', 'jch-sections');
        add_settings_field('jch_options_csg_enable', __('Enable Sprite Generator', 'jch-optimize'), 'jch_options_csg_enable_string', 'jch-sections',
                                                        'jch_sprite_manual');
        add_settings_field('jch_options_csg_direction', __('Sprite Build Direction', 'jch-optimize'), 'jch_options_csg_direction_string',
                                                           'jch-sections', 'jch_sprite_manual');
        add_settings_field('jch_options_csg_wrap_images', __('Wrap Images', 'jch-optimize'), 'jch_options_csg_wrap_images_string', 'jch-sections',
                                                             'jch_sprite_manual');
        add_settings_section('jch_sprite_exclude', '', 'jch_sprite_exclude_section_text', 'jch-sections');
        add_settings_field('jch_options_csg_exclude_images', __('Exclude these images from the sprite', 'jch-optimize'),
                                                                'jch_options_csg_exclude_images_string', 'jch-sections', 'jch_sprite_exclude');
        add_settings_field('jch_options_csg_include_images', __('Include these images in the sprite', 'jch-optimize'),
                                                                'jch_options_csg_include_images_string', 'jch-sections', 'jch_sprite_exclude');

        add_settings_section('jch_images', '', 'jch_images_section_text', 'jch-sections');
                
        add_settings_field('jch_options_optimizeimages', __('Optimize Images', 'jch-optimize'), 'jch_options_optimize_images_string', 'jch-sections',
                                                            'jch_images');

        add_settings_section('jch_section_end', '', 'jch_section_end_text', 'jch-sections');
}

function check_jch_tasks()
{
        if (isset($_GET['jch-task']) && $_GET['jch-task'] == 'deletecache')
        {
                delete_jch_cache();
        }

        if (isset($_GET['jch-task']) && $_GET['jch-task'] == 'postresults')
        {
                jch_process_optimize_images_results();
        }
}

function jch_load_resource_files()
{
        wp_enqueue_style('jch-bootstrap-css');
        wp_enqueue_style('jch-icons-css');
        wp_enqueue_style('jch-fonts-css');
        wp_enqueue_style('jch-chosen-css');

        wp_enqueue_script('jch-bootstrap-js');
        wp_enqueue_script('jch-tabsstate-js');
        wp_enqueue_script('jch-adminutility-js');
        wp_enqueue_script('jch-chosen-js');
        wp_enqueue_script('jch-collapsible-js');

        
}

function jch_load_scripts()
{

        ?> 
        <style type="text/css">
                .chosen-container-multi .chosen-choices li.search-field input[type=text]{ height: 25px; }    
                .chosen-container{margin-right: 4px;}
  
        </style>  
        <script type="text/javascript">
                function submitJchSettings()
                {
                        jQuery("form.jch-settings-form").submit();
                }

                jQuery(document).ready(function () {
                        jQuery(".chzn-custom-value").chosen({width: "240px"});
                        
                        jQuery('.collapsible').collapsible();
                });

        <?php                             ?>

        </script>
        <?php

}

function delete_jch_cache()
{
        global $jch_redirect;

        $result = JchPlatformCache::deleteCache();

        if ($result !== FALSE)
        {
                jch_add_notices('success', __('Cache deleted successfully!', 'jch-optimize'));
        }
        else
        {
                jch_add_notices('error', __('Cache delete action failed!', 'jch-optimize'));
        }

        $jch_redirect = TRUE;
}

function jch_redirect()
{
        global $jch_redirect;

        if ($jch_redirect)
        {
                $url = admin_url('options-general.php?page=jchoptimize-settings');

                wp_redirect($url);
                exit;
        }
}

function jch_process_optimize_images_results()
{
        global $jch_redirect;

        if (file_exists(JCH_PLUGIN_DIR . 'status.json'))
        {
                unlink(JCH_PLUGIN_DIR . 'status.json');
        }

        $cnt    = filter_input(INPUT_GET, 'cnt', FILTER_SANITIZE_NUMBER_INT);
        $dir    = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
        $msg    = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);

        $dir = JchPlatformUtility::decrypt($dir);

        if ($cnt !== FALSE && !is_null($cnt))
        {
                jch_add_notices('success', sprintf(__('%1$d images optimized in %2$s', 'jch-optimize'), $cnt, $dir));
        }
        elseif ($status !== FALSE && !is_null($status))
        {
                jch_add_notices('error', sprintf(__('Try again, optimize image function failed with message: %1$s', 'jch-optimize'), $msg));
        }

        $jch_redirect = TRUE;
}

function jch_add_notices($type, $text)
{
        $jch_notices = array();
        
        if ($notices = get_transient('jch_notices'))
        {
                $jch_notices = $notices;
        }

        $jch_notices[$type][] = $text;
        
        set_transient('jch_notices', $jch_notices, 60 * 5);
}

function jch_send_notices()
{
        $jch_notices = get_transient('jch_notices');

        foreach ($jch_notices as $type => $notices)
        {

                ?>
                <div class="notice notice-<?php echo $type ?>">
                        <?php

                        foreach ($notices as $notice)
                        {

                                ?>
                                <p> <?php echo $notice ?></p>
                                <?php

                        }

                        ?>
                </div>
                <?php

        }
        
        delete_transient('jch_notices');
}

function jch_options_validate($input)
{
        return $input;
}

function jch_group_start($type)
{
        switch ($type)
        {
                case 'auto':
                        $header      = __('Automatic Settings Group', 'jch-optimize');
                        $description = __('The fields in this group are set automatically using the Automatic settings (Minimum - Optimum). This is highly recommended to prevent conflicts. Generally you don\'t need to set these fields manually unless you are troubleshooting an issue so don\'t change these settings yourself unless you know what you are doing.',
                                          'jch-optimize');
                        $class       = 'class="collapsible" ';
                        break;

                case 'manual':
                        $header      = __('Manual Options', 'jch-optimize');
                        $description = __('You can set these options manually, after you have configured the plugin with the Automatic Settings, to further configure the plugin and optimize your site.',
                                          'jch-optimize');
                        $class       = '';
                        break;

                case 'exclude':
                        $header      = __('Exclude Options', 'jch-optimize');
                        $description = __('These settings are used to exclude files/extensions/images if they don\'t work so well with the plugin.',
                                          'jch-optimize');
                        $class       = '';
                        break;
                default:
                        $header = '';
                        $description = '';
                        $class= '';
                        break;
        }

        echo '<div class="jch-group">'
        . '<div ' . $class . '>'
        . ($header != '' ? '             <h3>' . $header . '<span class="fa"></span></h3>' : '')
        . '             <p><em>' . $description . '</em></p>'
        . '</div><div>';
}

function jch_group_end()
{
        echo '</div></div>';
}

function jch_basic_pre_section_text()
{
        echo '<div class="tab-pane" id="basic">';
}

function jch_options_auto_settings_string()
{
        $description = __('The Automatic settings configure the options in the Automatic Groups for you automatically. These six icons represent six preconfigured settings in increasingly optimized order. The risks of conflicts will also increase so try each in turn to find the optimum settings for your site. The first, which is the safest, is the default and should work on most websites. These settings do not affect the files/extensions/images etc. you have excluded.',
                          'jch-optimize');

        $aButton = jch_get_auto_settings_buttons();

        echo '<div style="display: inline-block;">';
        echo jch_gen_button_icons($aButton, $description, '</div>');
}

function jch_basic_auto_section_text()
{
        jch_group_start('auto');
}

function jch_options_css_string()
{
        $description = __('This will combine all CSS files into one file and remove all the links to the individual files from the page, replacing it with a link generated by the plugin to the combined file.',
                          'jch-optimize');

        echo jch_gen_radio_field('css', '1', $description, 's1-on s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_javascript_string()
{
        $description = __('This will combine all javascript files into one file and remove all the links to the individual files from the page, replacing it with a link generated by the plugin to the combined file.',
                          'jch-optimize');

        echo jch_gen_radio_field('javascript', '1', $description, 's1-on s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_gzip_string()
{
        $description = __('This setting compresses the generated javascript and CSS combined file with gzip, decreasing file size dramatically. This will only work if gzip compression is supported by your server.',
                          'jch-optimize');

        echo jch_gen_radio_field('gzip', '0', $description, 's1-off s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_css_minify_string()
{
        $description = __('If yes, the plugin will remove all unnecessary whitespaces and comments from the combined CSS file to reduce the size for optimized download.',
                          'jch-optimize');

        echo jch_gen_radio_field('css_minify', '0', $description, 's1-off s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_js_minify_string()
{
        $description = __('If yes, the plugin will remove all unnecessary whitespaces and comments from the combined javascript file to reduce the size for optimized download.',
                          'jch-optimize');

        echo jch_gen_radio_field('js_minify', '0', $description, 's1-off s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_html_minify_string()
{
        $description = __('If yes, the plugin will remove all unneccessary whitespaces and comments from HTML to reduce the size of the page for optimized download.',
                          'jch-optimize');

        echo jch_gen_radio_field('html_minify', '0', $description, 's1-off s2-on s3-on s4-on s5-on s6-on');
}

function jch_options_defer_js_string()
{
        $description = __('This option will add a defer attribute to the link of the combined javascript file. This will defer the loading of the javascript until after the page is loaded to reduce render blocking. Use this option with care as it may break the javascript on your page. It is highly recommended not to set this one manually but to use the pre-configured settings in Pro Options.',
                          'jch-optimize');

        echo jch_gen_radio_field('defer_js', '0', $description, 's1-off s2-off s3-off s4-off s5-off s6-on');
}

function jch_options_bottom_js_string()
{
        $description = __('Select where and how to place the links for the aggregated css/javascript files. Options are, \'Preserve Execution Order\', that will split the combined file and place them around and between excluded files accordingly, \'Combine all files to one\', that will combine all included files into one and place them just below the title tag, and \'Place JS at bottom\', that will place the combined CSS file below the title tag but the combined javascript file will be just before the ending body tag.',
                          'jch-optimize');

        $values = array(
                '0' => __('Preserve execution order', 'jch-optimize'),
                '2' => __('Combine files into one', 'jch-optimize'),
                '1' => __('Place javascript at bottom', 'jch-optimize')
        );

        echo jch_gen_select_field('bottom_js', '0', $values, $description, 'position-javascript');
}

function jch_basic_manual_section_text()
{
        jch_group_end();

        jch_group_start('manual');
}

function jch_options_html_minify_level_string()
{
        $description = __('If \'Minify HTML\' is enabled, this will determine the level of minification. The incremental changes per level are as follows: Basic - Whitespaces (ws) outside elements reduced to one ws; Advanced - Remove comments, ws around block elements and undisplayed elements, and unnecessary ws inside elements and around attributes; Ultra - Remove redundant attribute eg., text/javascript, and remove quotes from around selected attributes (HTML5)',
                          'jch-optimize');

        $values = array(
                '0' => __('Basic', 'jch-optimize'),
                '1' => __('Advanced', 'jch-optimize'),
                '2' => __('Ultra', 'jch-optimize')
        );

        echo jch_gen_select_field('html_minify_level', '0', $values, $description);
}

function jch_options_lifetime_string()
{
        $description = __('Lifetime of aggregated cached file in days. Expires headers are added to this file reflecting this time.', 'jch-optimize');

        echo jch_gen_text_field('lifetime', '30', $description);
}

function jch_options_manage_cache_string()
{
        $attribute = jch_get_cache_info();

        $description = __('Click this icon to delete all the cache of combined files saved by the plugin', 'jch-optimize');

        $aButton = jch_get_manage_cache_buttons();

        echo '<div style="display: -webkit-flex; display: -ms-flex; display: -moz-flex; display: flex;">';
        echo jch_gen_button_icons($aButton, $description, $attribute);
}

function jch_get_cache_info()
{
        static $attribute = FALSE;

        if ($attribute === FALSE)
        {
                JchPlatformCache::initializecache();

                $fi = new FilesystemIterator(JCH_CACHE_DIR, FilesystemIterator::SKIP_DOTS);

                $size = 0;

                foreach ($fi as $file)
                {
                        if ($file->getFilename() == 'index.html')
                        {
                                continue;
                        }

                        $size += $file->getSize();
                }

                $decimals = 2;
                $sz       = 'BKMGTP';
                $factor   = (int) floor((strlen($size) - 1) / 3);
                $size     = sprintf("%.{$decimals}f", $size / pow(1024, $factor)) . $sz[$factor];

                $no_files = number_format(iterator_count($fi) - 1);

                $attribute = '<div><br><div><em>' . sprintf(__('Number of files: %d'), $no_files) . '</em></div>'
                        . '<div><em>' . sprintf(__('Size: %s'), $size) . '</em></div></div>'
                        . '</div>';
        }

        return $attribute;
}

function jch_advanced_auto_section_text()
{
        jch_group_end();

        echo '</div>
  <div class="tab-pane" id="advanced">';

        jch_group_start('auto');
}

function jch_options_excludeAllExtensions_string()
{
        $description = __('Exclude all files from third party plugins and external domains from the aggregation process.', 'jch-optimize');
        echo jch_gen_radio_field('excludeAllExtensions', '1', $description, 's1-on s2-on s3-off s4-off s5-off s6-off');
}

function jch_advanced_exclude_section_text()
{
        jch_group_end();

        jch_group_start('exclude');
}

function jch_options_excludeCss_string()
{
        $description = __('Select the CSS files you want to exclude. To add a file to the list manually, type the url in the textbox and click \'Add item\'.',
                          'jch-optimize');
        $option      = 'excludeCss';

        $values = jch_get_field_value('css', $option, 'file');

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_options_excludeJs_string()
{
        $description = __('Select the javascript files you want to exclude. Select the CSS files you want to exclude. To add a file to the list manually, type the url in the textbox and click \'Add item\'.',
                          'jch-optimize');
        $option      = 'excludeJs';

        $values = jch_get_field_value('js', $option, 'file');

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_options_excludeCssComponents_string()
{
        $description = __('Select the plugins that you want to exclude CSS files from. To add a plugin to the list manually, type the folder name of the plugin in the textbox and click \'Add item\'.',
                          'jch-optimize');
        $option      = 'excludeCssComponents';

        $values = jch_get_field_value('css', $option, 'extension');

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_options_excludeJsComponents_string()
{
        $description = __('Select the plugins that you want to exclude javascript files from. To add a plugin to the list manually, type the folder name of the plugin in the textbox and click \'Add item\'.',
                          'jch-optimize');
        $option      = 'excludeJsComponents';

        $values = jch_get_field_value('js', $option, 'extension');

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_advanced_manual_section_text()
{
        jch_group_end();

        jch_group_start('manual');
}

function jch_options_htaccess_string()
{
        $description = __('By default auto is selected and the plugin will detect if mod_rewrite is enabled and will use \'url rewriting\' to remove the query from the link to the combined file to promote proxy caching. The plugin will then automatically select yes or no based on whether support for url rewriting is detected. You can manually select the one you want if the plugin got it wrong.',
                          'jch-optimize');

        $values = array(
                '0' => __('No', 'jch-optimize'),
                '1' => __('Yes', 'jch-optimize'),
                '3' => __('Yes (Without Options +FollowSymLinks)', 'jch-optimize'),
                '2' => __('Auto', 'jch-optimize')
        );

        echo jch_gen_select_field('htaccess', '2', $values, $description, '');
}

function jch_options_debug_string()
{
        $description = __('This option will add the \'commented out\' url of the individual files inside the combined file above the contents that came from that file. This is useful when configuring the plugin and trying to resolve conflicts. This will also add a Profiler menu to the AdminBar so you can review the times that the plugin methods take to run.',
                          'jch-optimize');
        echo jch_gen_radio_field('debug', '0', $description);
}

function jch_options_log_string()
{
        $description = __('If set, the plugin will log messages from caught exceptions to a jch-optimize.errors.txt file in the logs folder.',
                          'jch-optimize');
        echo jch_gen_radio_field('log', '0', $description);
}

function jch_options_try_catch_string()
{
        $description = __('The plugin will wrap each javascript file in a try catch block when combining to prevent errors coming in from any single file to affect the combined file. You can try this option if combine javascript breaks your site.',
                          'jch-optimize');

        echo jch_gen_radio_field('try_catch', '0', $description);
}

function jch_gen_button_icons(array $aButton, $description = '', $attribute = '')
{
        $sField = JchOptimizeAdmin::generateIcons($aButton);
        $sField .= $attribute;
        if ($description != '')
        {
                $sField .= '<p class="description">' . $description . '</p>';
        }

        return $sField;
}

function jch_pro_group_section_text()
{
        jch_group_end();

        echo '</div>
  <div class="tab-pane" id="pro">';

        jch_group_start('');
}

function jch_options_pro_downloadid_string()
{
        $description = __('Enter your download ID to enable automatic updates of the pro version. Log into your account on the jch-optimize.net website and access the download id from the MyAccount -> My Download Id menu item',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_pro_auto_section_text()
{
        jch_group_end();

        jch_group_start('auto');
}

function jch_options_pro_replaceImports_string()
{
        $description = __('If yes, the plugin will remove all @import properties from the aggregated CSS file with internal urls, and replace them with the respective CSS content.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_phpAndExternal_string()
{
        $description = __('PHP generated files and javascript/css files from external domains will be included in the combined file. This option requires the php paramater \'allow_url_fopen\' or \'cURL\' to be enabled on your server.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_inlineStyle_string()
{
        $description = __('Inline CSS styles will be included in the aggregated file in the order they appear on the page.', 'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_inlineScripts_string()
{
        $description = __('Inline scripts will be included in the aggregated file in the order they appear on the page. This reduces the chance of conflicts when combining files.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_searchBody_string()
{
        $description = __('If selected, the plugin will search HTML body section for files to aggregate. If not, only the head section will be searched.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_loadAsynchronous_string()
{
        $description = __('The aggregated Javascript file will be loaded asynchronously to avoid render blocking and speed up download. Only works with supporting browsers. Use along with defer for cross-browser support.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_pro_manual_section_text()
{
        jch_group_end();

        jch_group_start('manual');
}

function jch_options_pro_lazyload_string()
{
        $description = __('Enable to delay the loading of images until after the page loads and they are scrolled into view. This further reduces http requests and speeds up the loading of the page.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_optimizeCssDelivery_string()
{
        $description = __('The plugin will attempt to extract the critical CSS to format the page above the fold and inline this CSS in the head to prevent render blocking. The rest of the combined CSS will be loaded asynchronously via javascript. Select the number of HTML elements from the top of the page you want the plugin to find the applied CSS for. The smaller the number, the faster your site but you might see some jumping of the page if the number is too small.',
                          'jch-optimize');

        $values = array('0' => 'Off', '200' => '200', '400' => '400', '600' => '600', '800' => '800');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_cookielessdomain_string()
{
        $description = __('Enter your CDN or cookieless domain here. The plugin will load all static files including background images, combined js/css files and generated sprite from this domain. This requires that this domain is already set up and points to your site root.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_pro_exclude_section_text()
{
        jch_group_end();

        jch_group_start('exclude');
}

function jch_options_pro_excludeLazyLoad_string()
{
        $description = __('Select the images you want to exclude from lazy load if you\'ve turned that option on. If you\'re manually entering items you should enter the full image url for this to work. Type the url in the textbox and click \'Add item\'. The multiselect list will show it truncated but the full value will be saved.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_excludeScripts_string()
{
        $description = __('Select the inline script you want to exclude. You can identify the scripts from the first few \'minified\' characters that appear in the script. To add a script to the list manually, type a unique word or phrase that occurs in the script into the textbox and click \'Add item\'.',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_options_pro_loadFilesAsync_string()
{
        $description = __('These files will be loaded individually but asynchronously to avoid render blocking and speed up download. Try this option before excluding if there are conflicts. Only works with supporting browsers',
                          'jch-optimize');

        
          echo jch_gen_proonly_field($description);
          

        
}

function jch_sprite_manual_section_text()
{
        jch_group_end();

        echo '</div>
  <div class="tab-pane" id="sprite">';

        jch_group_start('manual');
}

function jch_options_csg_enable_string()
{
        $description = __('If enabled, the plugin will combine select background images into one called a sprite to reduce http lookups.',
                          'jch-optimize');

        echo jch_gen_radio_field('csg_enable', '0', $description);
}

/*
  function jch_options_csg_file_output_string()
  {
  $description = __('Select file format of the sprite, whether the sprite should be a png image or a gif image.', 'jch-optimize');

  $values = array('PNG' => 'PNG', 'GIF' => 'GIF');

  echo jch_gen_select_field('csg_file_output', 'PNG', $values, $description);
  }
 */

function jch_options_csg_direction_string()
{
        $description = __('Determine in which direction the images must be placed in sprite.', 'jch-optimize');

        $values = array('vertical' => __('vertical', 'jch-optimize'), 'horizontal' => __('horizontal', 'jch-optimize'));

        echo jch_gen_select_field('csg_direction', 'vertical', $values, $description);
}

function jch_options_csg_wrap_images_string()
{
        $description = __('Will wrap images in sprite into another row or column if the length of the sprite becomes longer than 2000px.',
                          'jch-optimize');

        echo jch_gen_radio_field('csg_wrap_images', '0', $description);
}

function jch_sprite_exclude_section_text()
{
        jch_group_end();

        jch_group_start('exclude');
}

function jch_options_csg_exclude_images_string()
{
        $description = __('You can exclude one or more of the images if they are displayed incorrectly by entering the name of the image complete with file extension here.',
                          'jch-optimize');

        $option = 'csg_exclude_images';

        $values = jch_get_field_value('images', $option);

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_options_csg_include_images_string()
{
        $description = __('You can include additional images in the sprite to the ones that were selected by default. Exercise care with this option as these files are likely to not display correctly.',
                          'jch-optimize');

        $option = 'csg_include_images';

        $values = jch_get_field_value('images', $option);

        echo jch_gen_multiselect_field($option, $values, $description);
}

function jch_images_section_text()
{
        jch_group_end();

        echo '</div>
  <div class="tab-pane" id="images"><br>
 <p class="description" style="font-size: 14px;" >' . __('Click through to open the directory that contains the images you want to optimize then click the \'Optimize Images\' button. The plugin will use the https://kraken.io/ API to optimize the images in the folder and will replace the existing images with the optimized images. Although this is relatively safe, it is recommended you do a backup first.',
                                                          'jch-optimize') . ' </p>    
 ';
}



function jch_options_optimize_images_string()
{
        

        
          echo jch_gen_proonly_field();
          
}

function jch_section_end_text()
{
        echo '</div>';
}

function jch_gen_radio_field($option, $default, $description, $class = '', $auto_option = FALSE)
{
        $options = get_option('jch_options');

        $checked = 'checked="checked"';
        $no      = '';
        $yes     = '';
        $auto    = '';
        $symlink = '';

        if (!isset($options[$option]))
        {
                $options[$option] = $default;
        }

        if ($options[$option] == '1')
        {
                $yes = $checked;
        }
        elseif ($options[$option] == '2')
        {
                $auto = $checked;
        }
        elseif ($options[$option] == '3')
        {
                $symlink = $checked;
        }
        else
        {
                $no = $checked;
        }

        $radio = '<fieldset id="jch_options_' . $option . '" class="' . $class . '">' .
                '        <input type="radio" id="jch_options_' . $option . '0" name="jch_options[' . $option . ']" value="0" ' . $no . ' >' .
                '        <label for="jch_options_' . $option . '0" class="">No</label>' .
                '        <input type="radio" id="jch_options_' . $option . '1" name="jch_options[' . $option . ']" value="1" ' . $yes . ' >' .
                '        <label for="jch_options_' . $option . '1" class="">Yes</label>';

        if ($auto_option)
        {
                $radio .= '        <input type="radio" id="jch_options_' . $option . '3" name="jch_options[' . $option . ']" value="3" ' . $symlink . ' >' .
                        '        <label for="jch_options_' . $option . '3" class="">Yes (Without Options +FollowSymLinks)</label>';

                $radio .= '        <input type="radio" id="jch_options_' . $option . '2" name="jch_options[' . $option . ']" value="2" ' . $auto . ' >' .
                        '        <label for="jch_options_' . $option . '2" class="">Auto</label>';
        }

        $radio .= '</fieldset>';
        $radio .= '<p class="description">' . $description . '</p>';

        return $radio;
}

function jch_gen_text_field($option, $default, $description, $class = '', $size = '6')
{
        $options = get_option('jch_options');

        if (!isset($options[$option]))
        {
                $value = $default;
        }
        else
        {
                $value = $options[$option];
        }

        $input = '<input type="text" name="jch_options[' . $option . ']" id="jch_options_' . $option . '" value="' . $value . '" size="' . $size . '" class="' . $class . '">';
        $input .= '<p class="description">' . $description . '</p>';

        return $input;
}

function jch_gen_select_field($option, $default, $values, $description, $class = '')
{
        $options = get_option('jch_options');

        if (!isset($options[$option]))
        {
                $selected_value = $default;
        }
        else
        {
                $selected_value = $options[$option];
        }

        $select = '<select id="jch_options_' . $option . '" name="jch_options[' . $option . ']" class="' . $class . '" >';

        foreach ($values as $key => $value)
        {
                $selected = $selected_value == $key ? 'selected="selected"' : '';
                $select .= '          <option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }

        $select .= '</select>';
        $select .= '<p class="description">' . $description . '</p>';

        return $select;
}

function jch_gen_textarea_field($option, $value, $description, $class = '')
{
        $options = get_option('jch_options');

        if (!isset($options[$option]))
        {
                $value = $default;
        }
        else
        {
                $value = $options[$option];
        }

        $textarea = '<textarea name="jch_options[' . $option . ']" id="jch_options_' . $option . '" cols="35" rows="3" class="' . $class . '">'
                . $value . '</textarea>';

        $textarea .= '<p class="description">' . $description . '</p>';

        return $textarea;
}

function jch_gen_multiselect_field($option, $values, $description, $class = '')
{
        $options = get_option('jch_options');

        if (isset($options[$option]))
        {
                $selected_values = JchOptimizeHelper::getArray($options[$option]);
        }
        else
        {
                $selected_values = array();
        }

        $select = '<select id="jch_options_' . $option . '" name="jch_options[' . $option . '][]" class="inputbox chzn-custom-value input-xlarge ' . $class . '" multiple="multiple" size="5" data-custom_group_text="Custom Position" data-no_results_text="Add custom item">';

        foreach ($values as $key => $value)
        {
                $selected = in_array($key, $selected_values) ? 'selected="selected"' : '';
                $select .= '          <option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }

        $select .= '</select>';
        $select .= '<button type="button" onclick="addJchOption(\'jch_options_' . $option . '\')">Add item</button>';


        $select .= '<p class="description">' . $description . '</p>';

        return $select;
}

function jch_get_auto_settings_buttons()
{
        return JchOptimizeAdmin::getSettingsIcons();
}

function jch_get_manage_cache_buttons()
{
        $aButton = array();

        $aButton[0]['link']   = add_query_arg(array('jch-task' => 'deletecache'), admin_url('options-general.php?page=jchoptimize-settings'));
        $aButton[0]['icon']   = 'fa-times-circle';
        $aButton[0]['color']  = '#C0110A';
        $aButton[0]['text']   = 'Delete plugin cache';
        $aButton[0]['script'] = '';
        $aButton[0]['class']  = 'enabled';

        return $aButton;
}

function jch_get_admin_object()
{
        static $oJchAdmin = NULL;

        if (is_null($oJchAdmin))
        {
                global $jch_redirect;

                $params    = JchPlatformSettings::getInstance(get_option('jch_options'));
                $oJchAdmin = new JchOptimizeAdmin($params, TRUE);

                if (get_transient('jch_optimize_ao_exception'))
                {
                        delete_transient('jch_optimize_ao_exception');
                }
                else
                {
                        try
                        {
                                $oJchAdmin->getAdminLinks(new JchPlatformHtml($params), '');
                        }
                        catch (RunTimeException $ex)
                        {
                                jch_add_notices('info', $ex->getMessage());
                                set_transient('jch_optimize_ao_exception', 1, 1);

                                $jch_redirect = TRUE;
                        }
                        catch (Exception $ex)
                        {
                                JchOptimizeLogger::log($ex->getMessage(), $params);

                                jch_add_notices('error', $ex->getMessage());
                                set_transient('jch_optimize_ao_exception', 1, 1);

                                $jch_redirect = TRUE;
                        }
                }
        }

        return $oJchAdmin;
}

function jch_get_field_value($sType, $sExcludeParams, $sGroup = '')
{
        $oJchAdmin = jch_get_admin_object();

        return $oJchAdmin->prepareFieldOptions($sType, $sExcludeParams, $sGroup);
}



  function jch_gen_proonly_field($description = '')
  {
  $field = '<div style="display:flex; margin-bottom: 5px;"><em style="padding: 5px; background-color: white; border: 1px #ccc;">Only available in Pro Version!</em></div>';

  if ($description != '')
  {
  $field .= '<p class="description">' . $description . '</p>';
  }

  return $field;
  }

  
