=== JCH Optimize ===
Contributors: codealfa
Tags: improve performance, optimize download speed, minify, aggregate, pagespeed, gtmetrix, webpagetest, yslow, minification, css, javascript, html, lazy load, seo, search engine optimization, website optimization, download speed, speed up website, optimize css delivery, render blocking, css sprite, gzip, combine css, combine javascript, cdn, content delivery network, website performance, website speed, fast download, web performance, website analysis, speed up download, minimize http requests, reduce bandwidth, caching, cache, speed up wordpress website
Tested up to: 4.2.2
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin automatically combines and minifies css and javascript files in your wordpress site to reduce http requests and optimize download time.

== Description ==

Speed up your WordPress site instantly with JCH Optimize! This plugin provides all the front end optimizations you need to optimize your website download speed. Core feature is to automatically aggregate CSS and javascript files to reduce the number of http requests made by the browser to download your web page. The combined CSS and javascript files can be further optimized by minifying and compressing the file with gzip. Also, the HTML output can be minified for optimized download. These optimizations may reduce server load, bandwidth requirements, and page loading times.

= Major Features =

* Javascript and CSS files aggregation and minification.
* HTML minification.
* GZip Compress aggregated files.
* Generate sprite to combine background images.
* Ability to exclude files from the aggregation to resolve conflicts

This plugin runs on a framework that is tried and proven within the Joomla! community. View the [plugin's page](http://extensions.joomla.org/extensions/extension/core-enhancements/performance/jch-optimize/) on Joomla!'s Extension Directory to see the reviews it has earned and why it has gain so much popularity in that community.

There is a [pro version available](https://www.jch-optimize.net/subscribe/new/jchoptimizewp.html?layout=default) on the [plugin's website](https://www.jch-optimize.net) with more features to further optimize your website such as:

* Load combined javascript file asynchronously
* Optimize CSS Delivery to eliminate render blocking
* CDN/Cookie-less Domain support
* Optimize images
* Lazy load images

== Installation ==

Just install from your WordPress "Plugins|Add New" screen. Manual installation is as follows:

1. Upload the zip-file and unzip it in the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to `Settings -> JCH Optimize` and enable the options you want
4. Use the Automatic Settings (Minimum - Optimum) to configure the plugin. This automatically sets the options in the 'Automatic Settings Groups'. You can then try the other manual options to further configure the plugin and optimize your site. Use the Exclude options to exclude files/plugins/images that don't work so well with the plugin.

== Frequently Asked Questions ==

= How do I know if it's working? =

After installing and activating the plugin, combining CSS and javascript files are selected by default so it should start working right away. If you look at your web page and it doesn't look any different that's a good sign...maybe. To confirm if it's working, take a look at the page source. You can do that in most browsers by right clicking on the page and selecting that option. You should see the links to your CSS/Js files removed and replaced by the aggregated file URL in the source that looks like this:
`/wp-content/plugins/jch-optimize/assets/wp-content/plugins/nz/30/1/63fccd8dc82e3f5da947573d8ded3bd4.css`

= There's no CSS Formatting after enabling the plugin =

The combined files are accessed by the browser via a jscss.php file in the `/wp-content/plugins/jch-optimize/assets/` directory. If you're not seeing any formatting on your page it means that the browser is not accessing this file for some reason. View the source of your page and try to access the JCH generated url to the combined file in your browser. You should see an error message that can guide you in fixing the problem. Generally it's a file permission issue so ensure the file at '/wp-content/plugins/jch-optimize/assets/jscss.php` has the same permission setting as your /index.php file (usually 644) and make sure all the folders in this hierarchy have the same permissions as your htdocs or public_html folder(Usually 644).

= How do I reverse the change JCH Optimize makes to my website? =

Simply deactivate or uninstall the plugin to reverse any changes it has made. The plugin doesn't modify any existing file or code but merely manipulates the HTML before it is sent to the brower. Any apparent persistent change after the plugin is deactivated is due to caching so ensure to flush all your WordPress, third party or browser cache.

== Changelog ==
= 1.2.1 =
* Fix links to combined file to include scheme and domain for better compatibility with other plugins
* Improved code that manipulates urls in the plugins

= 1.2.0 =
* Fixed bug in Autoloader function that conflicts with other plugins that have classes beginning with 'JCH'
* Fixed bug with HTML Minify removing spaces from inside pre elements when it contains other HTML elements
* Fixed compatibility issue with plugins using PHP internal buffering eg. CDN Linker, cache plugins, etc.
* Will delete plugin options on uninstall
* Multisite supported
* Fixed issue with Optimize Images not working with open_basedir setting (PRO VERSION)
* Now able to automatically update the Pro version when your download id is saved in the plugin (PRO VERSION)

= 1.1.4 =
* Improved method of accessing HTML for optimization considering levels of buffering
* Corrected function used to access home url in backend so that exclude options lists can be populated
* Fixed bug in and improved HTML minification library
* Fixed bug with Sprite Generator
* Fixed bug with CDN/Cookie-less domain feature (PRO VERSION)
* Improved Image Optimization feature (PRO VERSION)

= 1.1.3 =
* Fixed issue with the setting 'Use url rewrite - Yes (Without Options+SynLinks)' not working properly
* Fixed issue with combine javascript options sometimes creates javascript errors
* Now using Kraken.io API to optimize images (PRO VERSION)

= 1.1.2 =
* Fixed compatibility issue with XML sitemaps and feeds.
* Minor bug fixes

= 1.1.1 =
* Improved code running in admin section
* Add Profiler menu item on Admin Bar to review the times taken for the plugin methods to run.
* Keep HTML comments in 'Basic' HTML Minification level. Required for some plugins to work eg. Nextgen gallery.
* Saving cache in non-PHP files to make it compatible with  WP Engine platform.
* Minor bug fixes and improvements.

= 1.1.0 =
* Added visual indicators to show which Automatic setting is enabled
* Added multiselect exclude options so it's easier to find files/plugins to exclude from combining if they cause problems
* Bug fixes and improvements in the HTML, CSS, and javascript minification libraries
* Added levels of HTML minification

= 1.0.2 =
* Fixed bug in HMTL Minify library manifested on XHTML templates
* Fails gracefully on PHP5.2

= 1.0.1 =
* First public release on WordPress plugins repository.