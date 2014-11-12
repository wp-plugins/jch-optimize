<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action('init', 'check_jch_tasks');
add_action('admin_menu', 'add_jch_optimize_menu');

function add_jch_optimize_menu()
{
        $hook_suffix = add_options_page(__('JCH Optimize Pro Settings', 'jch-optimize'), 'JCH Optimize Pro', 'manage_options', 'jchoptimize-settings',
                                           'jch_options_page');

        add_action('admin_print_scripts-' . $hook_suffix, 'jch_load_resource_files');
        add_action('admin_footer-' . $hook_suffix, 'jch_load_scripts');
}

function jch_options_page()
{
//        $url          = admin_url('options-general.php?page=jchoptimize-settings');
//
//        if (false === ($creds = request_filesystem_credentials($url, '', false, plugins_url(), null) ))
//        {
//                set_transient('jch_ftp_required', 'TRUE', 1 * HOUR_IN_SECONDS);
//                return; // stop processing here
//        }
//
//        if (get_transient('jch_ftp_required') && !defined('FTP_HOST'))
//        {
//                if (!WP_Filesystem($creds))
//                {
//                        request_filesystem_credentials($url, '', true, false, null);
//                        return;
//                }
//
//                global $wp_filesystem;
//
//                $configfile = $wp_filesystem->abspath() . 'wp-config.php';
//                $configs    = $wp_filesystem->get_contents($configfile);
//
//                $ftp = <<<SCRIPT
//
//
///** Added by JCH Optimize **/
//define('FTP_HOST', '{$creds['hostname']}');
//define('FTP_USER', '{$creds['username']}');
//define('FTP_PASS', '{$creds['password']}');
//
//SCRIPT;
//                $ftp .= $creds['connection_type'] != 'ftp' ? "define('FTP_SSL', true);" : '';
//
//                $configs = preg_replace('#(DB_COLLATE.*)#', '$1' . $ftp, $configs);
//
//                $wp_filesystem->put_contents($configfile, $configs);
//        }

        ?>
        <div>
                <h2>JCH Optimize Pro Settings</h2>
                <form action="options.php" method="post" class="jch-settings-form">
                        <div style="width: 90%;">
                                <input name="Submit" type="submit" class="button" value="<?php esc_attr_e('Save Changes', 'jch-optimize'); ?>" />
                                <?php

                                /* ##<freecode>##
                                  ?>
                                  <a class="right button button-primary" href="https://www.jch-optimize.net/test/subscribe/new/jchoptimizewp.html?layout=default" target="_blank"><?php _e('Upgrade to Pro', 'jch-optimize'); ?></a>
 
                                  <?php
                                  ##<freecode>## */

                                ?>

                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                                <li class="active"><a href="#description" data-toggle="tab"><?php _e('Description', 'jch-optimize') ?></a></li>
                                <li><a href="#basic" data-toggle="tab"><?php _e('Basic Settings', 'jch-optimize') ?></a></li>
                                <li><a href="#advanced" data-toggle="tab"><?php _e('Advanced Settings', 'jch-optimize') ?></a></li>
                                <li><a href="#pro" data-toggle="tab"><?php _e('Pro Options', 'jch-optimize') ?></a></li>
                                <li><a href="#sprite" data-toggle="tab"><?php _e('Sprite Generator', 'jch-optimize') ?></a></li>
                                <li><a href="#images" data-toggle="tab"><?php _e('Optimize Images', 'jch-optimize') ?></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                                <div class="tab-pane active" id="description">
                                        <div id="extension-container" style="text-align:left;">
                                                <h1>JCH Optimize Pro Plugin</h1>
                                                <h3>(Version 1.0.1)</h3>
                                                <?php

                                                /* ##<freecode>##
                                                  echo '<div class="error">
                                                  <p>' . __('This is the free version of JCH Optimize for WordPress. For access to advance features please <a href="http://www.jch-optimize.net/test/subscribe/new/jchoptimizewp.html?layout=default" target="_blank">purchase the Pro Version!</a>') . '</p>
                                                  </div>';

                                                  ##</freecode>## */

                                                ?>
                                                <p>Can automatically optimize external resources like CSS and JavaScript, which can reduce both the size and number of requests made to your website and also compress HTML output for optimized download. GZip generated CSS and JavaScript files to about 1/4 of the original size. These optimizations may reduce server load, bandwidth requirements, and page loading times.</p>
                                                <h2>Major Features</h2>
                                                <ul>
                                                        <li>Javascript and CSS files aggregation and minification.</li>
                                                        <li>HTML minification.</li>
                                                        <li>GZip Compress aggregated files.</li>
                                                        <li>Generate sprite to combine background images.</li>
                                                </ul>
                                                <h2>Support</h2>
                                                <p>To get a more verbose description of the plugin options go <a href="https://www.jch-optimize.net/documentation/plugin-options.html" target="_blank">here</a>.
                                                </p>
                                                <p><a href="https://www.jch-optimize.net/support/knowlegebase.html" target="_blank">Here</a> are a couple common problems encountered by some persons using the plugin.</p>
                                                <p>If you need technical support click <a href="http://www.jch-optimize.net/support.html" target="_blank">here</a>.
                                                </p> 
                                        </div>
                                </div>
        <?php do_settings_sections('jch-sections'); ?>
                        <?php echo '</div>'; ?>
                        </div>

        <?php settings_fields('jch_options'); ?>
                        <input name="Submit" class="button" type="submit" value="<?php esc_attr_e('Save Changes', 'jch-optimize'); ?>" />
                </form>
        </div>
        <?php

}

add_action('admin_init', 'jch_admin_init');

function jch_admin_init()
{
        wp_register_style('jch-bootstrap-css', JCH_PLUGIN_URL . 'assets/css/bootstrap.css');
        wp_register_style('jch-icons-css', JCH_PLUGIN_URL . 'assets/css/icons.css');
        wp_register_style('jch-fonts-css', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');

        wp_register_script('jch-bootstrap-js', JCH_PLUGIN_URL . 'assets/js/bootstrap.min.js', array('jquery'), '', TRUE);

        ##<procode>## 
        wp_register_style('jch-progressbar-css', JCH_PLUGIN_URL . 'assets/css/pro-jquery-ui-progressbar.css');
        wp_register_style('jch-filetree-css', JCH_PLUGIN_URL . 'assets/css/pro-jqueryFileTree.css');

        wp_register_script('jch-filetree-js', JCH_PLUGIN_URL . 'assets/js/pro-jqueryFileTree.js', array('jquery'), '', TRUE);
        ##</procode>##

        register_setting('jch_options', 'jch_options', 'jch_options_validate');

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
        add_settings_section('jch_basic', '', 'jch_basic_section_text', 'jch-sections');
        add_settings_field('jch_options_lifetime', __('Lifetime (days)', 'jch-optimize'), 'jch_options_lifetime_string', 'jch-sections', 'jch_basic');
        add_settings_field('jch_options_manage_cache', __('Manage JCH Optimize Cache', 'jch-optimize'), 'jch_options_manage_cache_string',
                                                          'jch-sections', 'jch_basic');

        add_settings_section('jch_advanced_auto', '', 'jch_advanced_auto_section_text', 'jch-sections');
        add_settings_field('jch_options_excludeAllExtensions', __('Exclude files from all plugins', 'jch-optimize'),
                                                                  'jch_options_excludeAllExtensions_string', 'jch-sections', 'jch_advanced_auto');
        add_settings_section('jch_advanced', '', 'jch_advanced_section_text', 'jch-sections');
        add_settings_field('jch_options_excludeCss', __('Exclude these CSS files', 'jch-optimize'), 'jch_options_excludeCss_string', 'jch-sections',
                                                        'jch_advanced');
        add_settings_field('jch_options_excludeJs', __('Exclude these javascript files', 'jch-optimize'), 'jch_options_excludeJs_string',
                                                       'jch-sections', 'jch_advanced');
        add_settings_field('jch_options_excludeCssComponents', __('Exclude CSS files from these plugins', 'jch-optimize'),
                                                                  'jch_options_excludeCssComponents_string', 'jch-sections', 'jch_advanced');
        add_settings_field('jch_options_excludeJsComponents', __('Exclude javascript files from these plugins', 'jch-optimize'),
                                                                 'jch_options_excludeJsComponents_string', 'jch-sections', 'jch_advanced');
        add_settings_field('jch_options_htaccess', __('Enable url re-writing', 'jch-optimize'), 'jch_options_htaccess_string', 'jch-sections',
                                                      'jch_advanced');
        add_settings_field('jch_options_debug', __('Debug plugin', 'jch-optimize'), 'jch_options_debug_string', 'jch-sections', 'jch_advanced');
        add_settings_field('jch_options_log', __('Log Exceptions', 'jch-optimize'), 'jch_options_log_string', 'jch-sections', 'jch_advanced');


        add_settings_section('jch_pro', '', 'jch_pro_section_text', 'jch-sections');

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
        add_settings_section('jch_pro2', '', 'jch_pro2_section_text', 'jch-sections');
        add_settings_field('jch_options_pro_optimizeCssDelivery', __('Optimize CSS Delivery', 'jch-optimize'),
                                                                     'jch_options_pro_optimizeCssDelivery_string', 'jch-sections', 'jch_pro2');
        add_settings_field('jch_options_pro_excludeScripts', __('Exclude individual scripts', 'jch-optimize'),
                                                                'jch_options_pro_excludeScripts_string', 'jch-sections', 'jch_pro2');
        add_settings_field('jch_options_pro_loadFilesAsync', __('Load these individual javascript files asynchronously', 'jch-optimize'),
                                                                'jch_options_pro_loadFilesAsync_string', 'jch-sections', 'jch_pro2');
        add_settings_field('jch_options_pro_cookielessdomain', __('CDN / Cookieless Domain', 'jch-optimize'),
                                                                  'jch_options_pro_cookielessdomain_string', 'jch-sections', 'jch_pro2');


        add_settings_section('jch_sprite', '', 'jch_sprite_section_text', 'jch-sections');
        add_settings_field('jch_options_csg_enable', __('Enable Sprite Generator', 'jch-optimize'), 'jch_options_csg_enable_string', 'jch-sections',
                                                        'jch_sprite');
        /* add_settings_field('jch_options_csg_file_output', __('Image File Type', 'jch-optimize'), 'jch_options_csg_file_output_string', 'jch-sections',
          'jch_sprite'); */
        add_settings_field('jch_options_csg_direction', __('Sprite Build Direction', 'jch-optimize'), 'jch_options_csg_direction_string',
                                                           'jch-sections', 'jch_sprite');
        add_settings_field('jch_options_csg_wrap_images', __('Wrap Images', 'jch-optimize'), 'jch_options_csg_wrap_images_string', 'jch-sections',
                                                             'jch_sprite');
        add_settings_field('jch_options_csg_exclude_images', __('Exclude these images from the sprite', 'jch-optimize'),
                                                                'jch_options_csg_exclude_images_string', 'jch-sections', 'jch_sprite');
        add_settings_field('jch_options_csg_include_images', __('Include these images in the sprite', 'jch-optimize'),
                                                                'jch_options_csg_include_images_string', 'jch-sections', 'jch_sprite');

        add_settings_section('jch_images', '', 'jch_images_section_text', 'jch-sections');
        add_settings_field('jch_options_optimizeimages', __('Optimize Images', 'jch-optimize'), 'jch_options_optimize_images_string', 'jch-sections',
                                                            'jch_images');
}

function check_jch_tasks()
{
        $var = '';

        if (isset($_GET['jch-task']) && $_GET['jch-task'] == 'delete-cache')
        {
                delete_jch_cache();
        }

        if (isset($_GET['jch-task']) && $_GET['jch-task'] == 'optimizeimages')
        {
                jch_optimize_images();
        }

        if ($notice = get_transient('jch_notices'))
        {
                add_action('admin_notices', 'jch_send_notices');
        }
}

function jch_load_resource_files()
{
        wp_enqueue_style('jch-bootstrap-css');
        wp_enqueue_style('jch-icons-css');
        wp_enqueue_style('jch-fonts-css');

        wp_enqueue_script('jch-bootstrap-js');

        ##<procode>##
        wp_enqueue_style('jch-progressbar-css');
        wp_enqueue_style('jch-filetree-css');

        wp_enqueue_script('jch-filetree-js');
        wp_enqueue_script('jquery-ui-progressbar');
        ##</procode>##
}

function jch_load_scripts()
{

        ?> 
        <script type="text/javascript">
                function applyAutoSettings(int, pos)
                {
                        if (jQuery("fieldset.s" + int + "-on > input[type=radio]").length)
                        {
                                jQuery("fieldset.s" + int + "-on > input[type=radio]").val("1");
                        }

                        if (jQuery("fieldset.s" + int + "-off > input[type=radio]").length)
                        {
                                jQuery("fieldset.s" + int + "-off > input[type=radio]").val("0");
                        }

                        if (jQuery("select.position-javascript").length)
                        {
                                jQuery("select.position-javascript").val(pos);
                        }

                        jQuery("form.jch-settings-form").submit();
                }
                ;
        <?php ##<procode>##       ?>
                jQuery(document).ready(function ()
                {
                        jQuery("#file-tree-container").fileTree(
                                {
                                        root: "",
                                        script: ajaxurl + '?action=filetree',
                                        expandSpeed: 1000,
                                        collapseSpeed: 1000,
                                        multiFolder: false
                                }, function (file) {
                        });
                });

                var timer = null;
                var counter = 0;

                function jchOptimizeImages(page) {
                        li = jQuery("#file-tree-container ul.jqueryFileTree").find("li.expanded").last();

                        var timestamp = getTimeStamp();

                        if (li.length > 0) {
                                dir = li.find("a").attr("rel");

                                jQuery.ajax({
                                        url: ajaxurl,
                                        data: {"dir": dir, "action": "optimizeimages"},
                                        async: true,
                                        timeout: 5000
                                });

                                jQuery("#optimize-images-container").html('<div>Optimizing images. Please wait...</div><div id="progressbar"></div>');
                                jQuery("#progressbar").progressbar({value: 0})

                                timer = setInterval(function () {
                                        updateStatus(page, dir)
                                }, 1000);

                        } else {
                                alert("<?php _e('Please open a directory to optimize images', 'jch-optimize') ?>");
                        }
                }
                ;

                function updateStatus(page, dir) {

                        var timestamp = getTimeStamp();

                        jQuery.getJSON('<?php echo JCH_PLUGIN_URL . 'status.json?_=' ?>' + timestamp, function (data) {
                                var pbvalue = 0;
                                var total = data['total'];
                                var current = data['current'];

                                pbvalue = Math.floor((current / total) * 100);

                                if (pbvalue > 0) {
                                        jQuery("#progressbar").progressbar({
                                                value: pbvalue
                                        });
                                }

                                if (data['done'] == 1) {

                                        clearTimeout(timer);
                                        jQuery("#progressbar").progressbar({
                                                value: 100
                                        });

                                        window.location.href = page + "&jch-dir=" + dir + "&jch-cnt=" + data['optimize']
                                }

                        })
                                .fail(function (jqXHR) {

                                        counter = jqXHR.status == 404 ? counter + 1 : 5;

                                        if (counter == 5) {
                                                postFailure(page, jqXHR);
                                        }
                                });
                }

                function postFailure(page, jqXHR) {
                        clearTimeout(timer);
                        console.log(jqXHR);

                        window.location.href = page + "&status=fail&msg=" + encodeURIComponent(jqXHR.status + ": " + jqXHR.statusText);
                }

                function getTimeStamp() {
                        return new Date().getTime();
                }
        <?php ##</procode>##       ?>

        </script>
        <?php

}

function delete_jch_cache()
{

        $result = JchPlatformCache::deleteCache();

        if ($result !== FALSE)
        {
                set_transient('jch_notices', array('type' => 'updated', 'text' => __('Cache deleted successfully!', 'jch-optimize')), 30);
        }
        else
        {
                set_transient('jch_notices', array('type' => 'error', 'text' => __('Cache delete action failed!', 'jch-optimize')), 30);
        }

        jch_redirect();
}

function jch_redirect()
{
        $url = admin_url('options-general.php?page=jchoptimize-settings');
        wp_redirect($url);
        exit;
}

function jch_optimize_images()
{
        if (file_exists(JCH_PLUGIN_DIR . 'status.json'))
        {
                unlink(JCH_PLUGIN_DIR . 'status.json');
        }

        $cnt    = filter_input(INPUT_GET, 'jch-cnt', FILTER_SANITIZE_NUMBER_INT);
        $dir    = filter_input(INPUT_GET, 'jch-dir', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
        $msg    = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);

        $dir = JchPlatformUtility::decrypt($dir);

        if ($cnt !== FALSE && !is_null($cnt))
        {
                set_transient('jch_notices',
                              array(
                        'type' => 'updated',
                        'text' => sprintf(__('%1$d images optimized in %2$s', 'jch-optimize'), $cnt, $dir)
                        )
                        , 30);
        }
        elseif ($status !== FALSE && !is_null($status))
        {
                set_transient('jch_notices',
                              array(
                        'type' => 'error',
                        'text' => sprintf(__('Try again, optimize image function failed with message: %1$s', 'jch-optimize'), $msg)
                        )
                        , 30);
        }

        jch_redirect();
}

function jch_send_notices()
{
        $notice = get_transient('jch_notices');

        ?>
        <div class="<?php echo $notice['type'] ?>">
                <p> <?php echo $notice['text'] ?></p>
        </div>
        <?php

        delete_transient('jch_notices');
}

function jch_options_validate($input)
{
        return $input;
}

function jch_auto_group_start()
{
        echo '<div class="jch-group">'
        . '             <h3>' . __('Automatic Settings Group', 'jch-optimize') . '</h3>'
        . '             <p>' . __('The fields in this group can be set automatically using the preconfigured automatic settings in Basic Options. That is the recommended way to set these fields to avoid conflicts. The other individual fields not in this group must each be set manually.',
                                  'jch-optimize') . '</p>';
}

function jch_auto_group_end()
{
        echo '</div>';
}

function jch_basic_pre_section_text()
{
        echo '<div class="tab-pane" id="basic">';
}

function jch_options_auto_settings_string()
{
        $description = __('These six icons represent six preconfigured settings in increasingly optimized order. The risks of conflicts will also increase so try each in turn to find the optimum settings for your site. The first, which is the safest, is the default and should work on most websites. These settings do not affect the files/extensions/images etc. you have excluded.',
                          'jch-optimize');

        $aButton = jch_get_auto_settings_buttons();

        echo jch_gen_button_icons($aButton, $description);
}

function jch_basic_auto_section_text()
{
        jch_auto_group_start();
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

function jch_basic_section_text()
{
        jch_auto_group_end();
}

function jch_options_lifetime_string()
{
        $description = __('Lifetime of aggregated cached file in days. Expires headers are added to this file reflecting this time.', 'jch-optimize');

        echo jch_gen_text_field('lifetime', '30', $description);
}

function jch_options_manage_cache_string()
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

        $description = __('Click this icon to delete all the cache of combined files saved by the plugin', 'jch-optimize');

        $aButton = jch_get_manage_cache_buttons();

        $attribute = '<div><br><div><em>' . sprintf(__('Number of files: %d'), $no_files) . '</em></div>'
                . '<div><em>' . sprintf(__('Size: %s'), $size) . '</em></div></div>';

        echo jch_gen_button_icons($aButton, $description, $attribute);
}

function jch_advanced_auto_section_text()
{
        echo '</div>
  <div class="tab-pane" id="advanced">';
        jch_auto_group_start();
}

function jch_options_excludeAllExtensions_string()
{
        $description = __('Exclude all files from third party plugins and external domains from the aggregation process.', 'jch-optimize');
        echo jch_gen_radio_field('excludeAllExtensions', '1', $description, 's1-on s2-on s3-off s4-off s5-off s6-off');
}

function jch_advanced_section_text()
{
        jch_auto_group_end();
}

function jch_options_excludeCss_string()
{
        $description = __('Exclude individual CSS files from the aggregation process. Enter any part of the file url in the text area. Comma separate multiple entries.',
                          'jch-optimize');
        echo jch_gen_textarea_field('excludeCss', '', $description);
}

function jch_options_excludeJs_string()
{
        $description = __('Exclude individual javascript files from the aggregation process. Enter any part of the file url in the text area. Comma separate multiple entries.',
                          'jch-optimize');
        echo jch_gen_textarea_field('excludeJs', '', $description);
}

function jch_options_excludeCssComponents_string()
{
        $description = __('Exclude CSS files from individual plugins. Enter the plugin folder name of slug here. Comma separate multiple entries.',
                          'jch-optimize');
        echo jch_gen_textarea_field('excludeCssComponents', '', $description);
}

function jch_options_excludeJsComponents_string()
{
        $description = __('Exclude javascript files from individual plugins. Enter the plugin folder name of slug here. Comma separate multiple entries.',
                          'jch-optimize');
        echo jch_gen_textarea_field('excludeJsComponents', '', $description);
}

function jch_options_htaccess_string()
{
        $description = __('By default auto is selected and the plugin will detect if mod_rewrite is enabled and will use \'url rewriting\' to remove the query from the link to the combined file to promote proxy caching. The plugin will then automatically select yes or no based on whether support for url rewriting is detected. You can manually select the one you want if the plugin got it wrong.',
                          'jch-optimize');
        echo jch_gen_radio_field('htaccess', '2', $description, '', TRUE);
}

function jch_options_debug_string()
{
        $description = __('This option will add the \'commented out\' url of the individual files inside the combined file above the contents that came from that file. This is useful when configuring the plugin and trying to resolve conflicts.',
                          'jch-optimize');
        echo jch_gen_radio_field('debug', '0', $description);
}

function jch_options_log_string()
{
        $description = __('If set, the plugin will log messages from caught exceptions to a jch-optimize.errors.txt file in the logs folder.',
                          'jch-optimize');
        echo jch_gen_radio_field('log', '0', $description);
}

function jch_pro_section_text()
{
        echo '</div>
  <div class="tab-pane" id="pro">';
}

function jch_gen_button_icons(array $aButton, $description = '', $attribute = '')
{
        $sField = '<div class="container-icons">';

        foreach ($aButton as $sButton)
        {
                $sField .= <<<JFIELD
<div class="icon {$sButton['class']} ">
        <a href="{$sButton['link']}"  {$sButton['script']}  >
                <div style="text-align: center;">
                        <i class="fa {$sButton['icon']} fa-3x" style="margin: 7px 0; color: {$sButton['color']}"></i>
                </div>
                <span >{$sButton['text']}</span><br>
                <span class="pro-only"><em>(Pro Only)</em></span>
        </a>
</div>
JFIELD;
        }
        $sField .= $attribute;
        $sField .= '<div style="clear:both;"></div>';
        $sField .= '</div>';
        $sField .= '<p class="description">' . $description . '</p>';

        return $sField;
}

function jch_pro_auto_section_text()
{
        jch_auto_group_start();
}

function jch_options_pro_replaceImports_string()
{
        $description = __('If yes, the plugin will remove all @import properties from the aggregated CSS file with internal urls, and replace them with the respective CSS content.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_replaceImports', '1', $description, 's1-on s2-on s3-on s4-on s5-on s6-on');
        ##</procode>##
}

function jch_options_pro_phpAndExternal_string()
{
        $description = __('PHP generated files and javascript/css files from external domains will be included in the combined file. This option requires the php paramater \'allow_url_fopen\' or \'cURL\' to be enabled on your server.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_phpAndExternal', '1', $description, 's1-on s2-on s3-on s4-on s5-on s6-on');
        ##</procode>##
}

function jch_options_pro_inlineStyle_string()
{
        $description = __('Inline CSS styles will be included in the aggregated file in the order they appear on the page.', 'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_inlineStyle', '1', $description, 's1-on s2-on s3-on s4-on s5-on s6-on');
        ##</procode>##
}

function jch_options_pro_inlineScripts_string()
{
        $description = __('Inline scripts will be included in the aggregated file in the order they appear on the page. This reduces the chance of conflicts when combining files.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_inlineScripts', '0', $description, 's1-off s2-off s3-off s4-on s5-on s6-on');
        ##</procode>##
}

function jch_options_pro_searchBody_string()
{
        $description = __('If selected, the plugin will search HTML body section for files to aggregate. If not, only the head section will be searched.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_searchBody', '0', $description, 's1-off s2-off s3-off s4-off s5-on s6-on');
        ##</procode>##
}

function jch_options_pro_loadAsynchronous_string()
{
        $description = __('The aggregated Javascript file will be loaded asynchronously to avoid render blocking and speed up download. Only works with supporting browsers. Use along with defer for cross-browser support.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_radio_field('pro_loadAsynchronous', '0', $description, 's1-off s2-off s3-off s4-off s5-off s6-on');
        ##</procode>##
}

function jch_pro2_section_text()
{
        jch_auto_group_end();
}

function jch_options_pro_optimizeCssDelivery_string()
{
        $description = __('The plugin will attempt to extract the critical CSS to format the page above the fold and inline this CSS in the head to prevent render blocking. The rest of the combined CSS will be loaded asynchronously via javascript. Select the number of HTML elements from the top of the page you want the plugin to find the applied CSS for. The smaller the number, the faster your site but you might see some jumping of the page if the number is too small.',
                          'jch-optimize');

        $values = array('0' => 'Off', '200' => '200', '400' => '400', '600' => '600', '800' => '800');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_select_field('pro_optimizeCssDelivery', '0', $values, $description);
        ##</procode>##
}

function jch_options_pro_excludeScripts_string()
{
        $description = __('Select the inline script you want to exclude. You can identify the scripts from the first few \'minified\' characters that appear in the script. If you\'re seeing a text-area, exclude individual inline scripts by entering words or phrases unique to that script here. Separate multiple entries with commas.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_textarea_field('pro_excludeScripts', '', $description);
        ##</procode>##
}

function jch_options_pro_loadFilesAsync_string()
{
        $description = __('These files will be loaded individually but asynchronously to avoid render blocking and speed up download. Try this option before excluding if there are conflicts. Only works with supporting browsers',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_textarea_field('pro_loadFilesAsync', '', $description);
        ##</procode>##
}

function jch_options_pro_cookielessdomain_string()
{
        $description = __('Enter your CDN or cookieless domain here. The plugin will load all static files including background images, combined js/css files and generated sprite from this domain. This requires that this domain is already set up and points to your site root.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        echo jch_gen_text_field('pro_cookielessdomain', '', $description, '', '30');
        ##</procode>##
}

function jch_sprite_section_text()
{
        echo '</div>
  <div class="tab-pane" id="sprite">';
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

        $values = array('vertical' => 'vertical', 'horizontal' => 'horizontal');

        echo jch_gen_select_field('csg_direction', 'vertical', $values, $description);
}

function jch_options_csg_wrap_images_string()
{
        $description = __('Will wrap images in sprite into another row or column if the length of the sprite becomes longer than 2000px.',
                          'jch-optimize');

        echo jch_gen_radio_field('csg_wrap_images', '0', $description);
}

function jch_options_csg_exclude_images_string()
{
        $description = __('You can exclude one or more of the images if they are displayed incorrectly by entering the name of the image complete with file extension here. Comma separate multiple entries.',
                          'jch-optimize');

        echo jch_gen_textarea_field('csg_exclude_images', '', $description);
}

function jch_options_csg_include_images_string()
{
        $description = __('You can include additional images in the sprite to the ones that were selected by default. Exercise care with this option as these files are likely to not display correctly.',
                          'jch-optimize');

        echo jch_gen_textarea_field('csg_include_images', '', $description);
}

function jch_images_section_text()
{
        echo '</div>
  <div class="tab-pane" id="images">';
}

function jch_options_optimize_images_string()
{
        $description = __('Click through to open the directory that contains the images you want to optimize then click the \'Optimize Images\' button. The plugin will use the Yahoo! Smush.it™ lossless compressor to optimize the images in the folder and will replace the existing images with the optimized images. Although this is relatively safe, it is recommended you do a backup first.',
                          'jch-optimize');

        /* ##<freecode>##
          echo jch_gen_proonly_field($description);
          ##</freecode>## */

        ##<procode>##
        if (!function_exists('curl_init') || !function_exists('curl_exec'))
        {

                ?>
                <div class="error">
                        <p> <?php _e('cURL is required for this feature but it\'s not enabled on this server.', 'jch-optimize'); ?></p>
                </div> 
                <?php

        }
        else
        {
                echo '<div id="optimize-images-container">';
                echo '<div id="file-tree-container" style="max-width:350px;float:left;"></div>';

                $aButton = jch_get_optimize_images_buttons();

                echo jch_gen_button_icons($aButton, $description);

                echo '</div>';
        }
        ##</procode>##
}

function jch_gen_radio_field($option, $default, $description, $class = '', $auto_option = FALSE)
{
        $options = get_option('jch_options');

        $checked = 'checked="checked"';
        $no      = '';
        $yes     = '';
        $auto    = '';

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

function jch_gen_textarea_field($option, $default, $description, $class = '')
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

function jch_get_auto_settings_buttons()
{
        $aButton = array();

        $aButton[0]['link']   = '';
        $aButton[0]['icon']   = 'fa-wrench';
        $aButton[0]['text']   = 'Minimum';
        $aButton[0]['color']  = '#FFA319';
        $aButton[0]['script'] = 'onclick="applyAutoSettings(1, 0); return false;"';
        $aButton[0]['class']  = 'enabled';

        $aButton[1]['link']   = '';
        $aButton[1]['icon']   = 'fa-cog';
        $aButton[1]['text']   = 'Intermediate';
        $aButton[1]['color']  = '#FF32C7';
        $aButton[1]['script'] = 'onclick="applyAutoSettings(2, 0); return false;"';
        $aButton[1]['class']  = 'enabled';

        $aButton[2]['link']   = '';
        $aButton[2]['icon']   = 'fa-cogs';
        $aButton[2]['text']   = 'Average';
        $aButton[2]['color']  = '#CE3813';
        $aButton[2]['script'] = 'onclick="applyAutoSettings(3, 0); return false;"';
        $aButton[2]['class']  = 'enabled';

        $aButton[3]['link']   = '';
        $aButton[3]['icon']   = 'fa-forward';
        $aButton[3]['text']   = 'Deluxe';
        ##<procode>##
        $aButton[3]['color']  = '#E8CE0B';
        $aButton[3]['script'] = 'onclick="applyAutoSettings(4, 2); return false;"';
        $aButton[3]['class']  = 'enabled';
        ##</procode>##
        /* ##<freecode>##  
          $aButton[3]['color']  = '#CCC';
          $aButton[3]['script'] = '';
          $aButton[3]['class']  = 'disabled';
          ##</freecode>## */

        $aButton[4]['link']   = '';
        $aButton[4]['icon']   = 'fa-fast-forward';
        $aButton[4]['text']   = 'Premium';
        ##<procode>##
        $aButton[4]['color']  = '#9995FF';
        $aButton[4]['script'] = 'onclick="applyAutoSettings(5, 1); return false;"';
        $aButton[4]['class']  = 'enabled';
        ##</procode>##
        /* ##<freecode>##  
          $aButton[4]['color']  = '#CCC';
          $aButton[4]['script'] = '';
          $aButton[4]['class']  = 'disabled';
          ##</freecode>## */

        $aButton[5]['link']   = '';
        $aButton[5]['icon']   = 'fa-dashboard';
        $aButton[5]['text']   = 'Optimum';
        ##<procode>##
        $aButton[5]['color']  = '#60AF2C';
        $aButton[5]['script'] = 'onclick="applyAutoSettings(6, 1); return false;"';
        $aButton[5]['class']  = 'enabled';
        ##</procode>##
        /* ##<freecode>## 
          $aButton[5]['color']  = '#CCC';
          $aButton[5]['script'] = '';
          $aButton[5]['class']  = 'disabled';
          ##</freecode>## */

        return $aButton;
}

function jch_get_manage_cache_buttons()
{
        $aButton = array();

        $aButton[0]['link']   = add_query_arg(array('jch-task' => 'delete-cache'), admin_url('options-general.php?page=jchoptimize-settings'));
        $aButton[0]['icon']   = 'fa-times-circle';
        $aButton[0]['color']  = '#C0110A';
        $aButton[0]['text']   = 'Delete plugin cache';
        $aButton[0]['script'] = '';
        $aButton[0]['class']  = 'enabled';

        return $aButton;
}

/* ##<freecode>##
  function jch_gen_proonly_field($description)
  {
  $field = '<div style="display:flex; margin-bottom: 5px;"><em style="padding: 5px; background-color: white; border: 1px #ccc;">Only available in Pro Version!</em></div>' .
  '<p class="description">' . $description . '</p>';

  return $field;
  }
  ##</freecode>## */

##<procode>##

function jch_get_optimize_images_buttons()
{
        $page    = add_query_arg(array('jch-task' => 'optimizeimages'), admin_url('options-general.php?page=jchoptimize-settings'));
        $aButton = array();

        $aButton[0]['link']   = '';
        $aButton[0]['icon']   = 'fa-compress';
        $aButton[0]['color']  = '#278EB1';
        $aButton[0]['text']   = 'Optimize Images';
        $aButton[0]['script'] = 'onclick="jchOptimizeImages(\'' . $page . '\'); return false;"';
        $aButton[0]['class']  = 'enabled';

        return $aButton;
}

add_action('wp_ajax_filetree', 'jch_ajax_file_tree');

function jch_ajax_file_tree()
{
        echo JchOptimizeAjax::fileTree();

        die();
}

add_action('wp_ajax_optimizeimages', 'jch_ajax_optimize_images');

function jch_ajax_optimize_images()
{
        JchOptimizeAjax::optimizeImages(JchPlatformSettings::getInstance(get_option('jch_options')));

        die();
}

##</procode>##