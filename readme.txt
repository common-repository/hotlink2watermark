=== Hotlink2Watermark ===
Contributors: tranchesdunet
Author: tranchesdunet (Jean-Marc Bianca)
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RZRLGED6KXV9W
Author URI: http://www.jmbianca.net/
Plugin URI: http://www.tranchesdunet.com/hotlink2watermark
Tags: image, picture, hotlink, hotlinking, hotlinked, steal, watermark, filigrane, ads, bandwith
Requires at least: 3.1
Tested up to: 3.5.1
Stable tag: 0.3.2

Tranform your hotlinked photos into ads!

== Description ==

**Hotlink2Watermark** is a plugin which allow you to display a watermark within each images being 'hotlinked' from your website.
An hotlinked image is an image hosted on your website but displayed on another website by an unscrupulous webmaster
This overload the bandwith of your website without bringing any visitor.
This plugin transform this inconvenience into advantage by allowing you to display a link to your image on these image.

Features:

* Add a watermark to all hotlinked image from your blog, on the fly!
* All generated pictures are buffered into a directory for optimised use
* Choice of watermark: can be a text or a picture
* .htaccess update if needed
* Can save all the referers (website which steal your bandwidh) on a csv file
* Create/delete the buffer directory on install/uninstall of the plugin, for non-wasted disk space
* **NEW** You can choose between 4 fonts for the watermark, and select text and (optional) shadow colors

Update Notice:
As there are several new features, the buffered image in the cache directory must be regenerated, with different name.
So, you should delete the whole content of the directory "cache" in the directory "hotlink2watermark" to gain some space, as the files in this directory won't be used anymore.

**Note on the support:**
For better support, I will only answer question/suggestion/etc through a dedicaced page on my website : www.tranchesdunet.com/hotlink2watermark
You can post either in english or french (preferably).

Feel free to test it and report any bugs/suggestions

Be sure to check out my other plugin:
[SideNails](http://wordpress.org/extend/plugins/sidenails/)
[My Trending Post](http://wordpress.org/extend/plugins/my-trending-post/)

== Installation ==

1. Upload `hotlink2watermark` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Setup the plugin through its own admin interface: set a text or an image, its position, size, opacity, etc...
4. Check the change on the 'stealer' website (sometime, it needs some Ctrl + F5 to renew the cache, before seeing any change)

== Screenshots ==

1. The Hotlink2Watermark admin interface. You can define the watermark's settings
2. Results on other website (example)

== Frequently Asked Questions ==

= How can I change the language for something else than English? =

This plugin is delivered with English as the default language, and French as second optional language. 
In order to use French you must have:
define ('WPLANG', 'fr_FR');
in your wp-config.php file.

= Where in the .htaccess file the settings should be located? =

There is no specific place for the settings in the .htaccess. The plugin should put it on the right place on its own. 
The only thing you should watch is if there is no other redirection for images file (e.g. gif, png, jpeg,jpg) as it can prevent this plugin to work

= What are the prerequesite for this plugin? =

You must have the GD Library enabled on your server. The plugin will make a check for it.
Also, you should have the Freetype enable too if you want to use a "text watermark" instead of "image watermark".

= I set up everything well but my watermark didn't display on other sites? =

You should checks these:
* first thing first, try a complete refresh (control + F5) on the targeted website as sometime your page on those sites is on a buffer and won't be refreshed with the new "watermarked" version until a complete refresh
* check the watermark isn't wider than your image. If you use "text watermark" try to use a shorter sentence and/or lower font size
* check if the GD library is installed AND enabled on your server. Contact your administrator for further info.

= Your plugin's doing a great work. How can I rewards you? =

Thanks for the compliment. You can use the [Paypal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RZRLGED6KXV9W) form on the plugin'admin page for paying me a coffe/beer/champagne, as you want ;)

== Changelog ==

= 0.1 =
* First public release

= 0.1.1 =
* Default language is English, now
= 0.1.2 =
* Bug correction (division by zero)
= 0.2 =
* GD Lib check
* Font name correction
* Date & time in referer.csv
* Fix header mispelling
= 0.2.1 =
* The ucase font file name correction is not applied by SVN, must change it in the code instead!
= 0.3 =
* Fix some antialiasaing issue
* fix the header for images already in cache
* Change the .htaccess rules to take count of http and https, presence of "www", case unsensitive etc.
* The default text size is now 12 instead of 20
* You can now choose between four fonts for your watermark!
* You can choose colors for both text and shadow
* You can disable the text'shadow
* Better syntax for the csv file content
= 0.3.1 =
* Fix a small error on $h2w->hex2rgb($h2w_textcolor);
= 0.3.2 =
* Fix the version number