=== JCH Optimize ===
Contributors: codealfa
Tags: performance, optimize, speed, minify, aggregate, pagespeed, gtmetrix, minification, css, javascript, html, jch, lazy, load
Tested up to: 4.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin aggregates and minifies CSS and Javascript files for optimized page download

== Description ==

This plugin optimize your website download speed by automatically aggregating CSS and javascript files to reduce the number of http requests made by the browser to download your web page. The combined CSS and javascript files can be further optimize by minifying and compressing the file with gzip. Also, the HTML output can be compressed for optimized download. These optimizations may reduce server load, bandwidth requirements, and page loading times.

= Major Features =

* Javascript and CSS files aggregation and minification.
* HTML minification.
* GZip Compress aggregated files.
* Generate sprite to combine background images.
* Ability to exclude files from the aggregation to resolve conflicts

This plugin runs on a framework that is tried and proven within the Joomla! community. View the [plugin's page](http://extensions.joomla.org/extensions/extension/core-enhancements/performance/jch-optimize/) on Joomla!'s Extension Directory to see the reviews it has earned and why it has gain so much popularity in that community.

There is a [pro version available](https://www.jch-optimize.net/subscribe/new/jchoptimizewp.html?layout=default) on the [plugin's website](https://www.jch-optimize.net) with more features to further optimize your website such as:

* Optimize CSS Delivery
* CDN/Cookie-less Domain support
* Optimize images
* lazy load images

== Installation ==

Just install from your WordPress "Plugins|Add New" screen. Manual installation is as follows:

1. Upload the zip-file and unzip it in the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to `Settings -> JCH Optimize` and enable the options you want
4. It's recommended that you use the automatic pre-configured settings if you're not an advanced user

== Frequently Asked Questions ==

= How do I know if it's working? =

After installing and activating the plugin, combining CSS and javascript files are selected by default so it should start working right away. If you look at your web page and it doesn't look any different that's a good sign...maybe. To confirm if it's working, take a look at the page source. You can do that in most browsers by right clicking on the page and selecting that option. You should see the links to your CSS/Js files removed and replaced by the aggregated file URL in the source that looks like this:
`/wp-content/plugins/jch-optimize/assets/wp-content/plugins/nz/30/1/63fccd8dc82e3f5da947573d8ded3bd4.css`

= There's no CSS Formatting after enabling the plugin =

The combined files are accessed by the browser via a jscss.php file in the `/wp-content/plugins/jch-optimize/assets/` directory. If you're not seeing any formatting on your page it means that the browser is not accessing this file for some reason. View the source of your page and try to access the JCH generated url to the combined file in your browser. You should see an error message that can guide you in fixing the problem. Generally it's a file permission issue so ensure the file at '/wp-content/plugins/jch-optimize/assets/jscss.php` has the same permission setting as your /index.php file (usually 644) and make sure all the folders in this hierarchy have the same permissions as your htdocs or public_html folder(Usually 644).

= How do I reverse the change JCH Optimize makes to my website? =

Simply deactivate or uninstall the plugin to reverse any changes it has made. The plugin doesn't modify any existing file or code but merely manipulates the HTML before it is sent to the brower. Any apparent persistent change after the plugin is deactivated is due to caching so ensure to flush all your WordPress, third party or browser cache.

== Changelog ==

= 1.1.0 =
* Added visual indicators to show which Automatic setting is enabled
* Added multiselect exclude options so it's easier to find files/plugins to exclude from combining if they cause problems
* Bug fixes and improvements in the HTML, CSS, and javascript minification libraries
* Added levels of HTML minification


= 1.0.2 =
* Fixed bug in HMTL Minnify library manifested on XHTML templates
* Fails gracefully on PHP5.2

= 1.0.1 =
* First public release on WordPress plugins repository.

