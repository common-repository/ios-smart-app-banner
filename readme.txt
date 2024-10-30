=== Plugin Name ===
Contributors: iamcam
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mistercameron%40gmail%2ecom&lc=US&item_name=Cameron%20perry&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest
Tags: ios, iphone, ipad, ios6, ios7, ios8, app, banner, affiliate
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.2
License: GPLv3
License URI: http://www.gnu.org/copyleft/gpl.html

iOS Smart App Banner plugin displays the app banners in Safari on iOS. All you need is your application ID.

== Description ==

iOS Smart App Banner is a plugin that allows you to take advantage of a new feature in iOS6+, where by placing a special <meta> tag will tell mobile Safari to open a banner at the top of the page, pointing to your app in the app store. This is an invaluable tool to help visitors find your app with as little friction as possible. This plugin also supports custom scheme + launch values.

== Installation ==

It's only three simple steps to get started.

1. Upload iOSSmartBanner to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enter the app store ID on the posts and pages you wish to display the banner

== Frequently Asked Questions ==

= How does Safari know? =

It's magic. Actually, there is a special meta tag that can go in the web page's header. When it sees it, Safari will pull the app information from the store and display the banner at the top.

= Does the banner always display on the page? =

No. The banner will display until the user taps the close button. After that, it should stay closed on successive page visits.

= What if the user already has the app? =

In that case, the banner will prompt the user to open it.

= The banner stopped displaying! =

It's probably hiding because you've dismissed it already. Try clearing your browser's cookies.

= Does it support affiliate linking? =
Yup, sure does! Go to wp-admin, then mouse over settings and select "iOS Smart Banner". Deselect the "Donate" option and enter your affiliate ID. Just a note: You are free to use your own affiliate linking with this plugin. If you find it to be useful, we kindly ask you to consider leaving the donate box checked, which will use our affiliate link to help support development of this plugin.

= How do you use the app argument feature with your app? =
That's a discussion to be had with your app developer (some info in the link below). Basically, you need to have a registered app schema and some way to handle the incoming information before it will be useful.

= Does it work on Mac OSX or the Mac App Store? =
No

= Where can I get more info on the banners? =
You can get it directly from the horse's mouth: [Apple.com](https://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/PromotingAppswithAppBanners/PromotingAppswithAppBanners.html)

== Screenshots ==

1. Step 1: Simply enter your application ID. Optionally: if your app uses a URL scheme, you may enter it as well.
2. Save & View the page from your iPhone or iPad

== Changelog ==

= 1.2 =
Added portfolio post types (for some themes)

= 1.1 =
Updated iTunes affiliate link from Linkshare to PGH

= 1.0 =
* Initial Version

 == Upgrade Notice ==
 You will need to update your affiliate details from PGH.