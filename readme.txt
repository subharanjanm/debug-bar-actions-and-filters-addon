=== Debug Bar Actions and Filters Addon ===

Contributors: subharanjan
Tags: Debug Bar, Actions, Filters, Debug Bar Actions Display, Debug Bar Filters Display, List Hooks attached, List of Hooks Fired, Developer's tool for action and filter hooks
Requires at least: 3.2
Tested up to: 3.7.1
Stable tag: 1.3
License: GPLv2

This plugin adds two more tabs in the Debug Bar to display all the hooks(Actions and Filters) for the current request. Requires "Debug Bar" plugin.

== Description ==

This plugin adds two more tabs in the Debug Bar to display hooks(Actions and Filters) attached to the current request. Actions tab displays the actions hooked to current request. Filters tab displays the filter tags along with the functions attached to it with respective priority.  
  
**Note:** 
Debug Bar plugin must be installed prior to this.
( http://wordpress.org/extend/plugins/debug-bar/ )

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.   
  
**Note:** 
Debug Bar plugin must be installed prior to this.
( http://wordpress.org/extend/plugins/debug-bar/ )

Don't use this on Live site. This is only for development purpose.

== Screenshots ==
1. Debug Bar displaying Actions 

2. Debug Bar displaying Filters 

== Frequently Asked Questions ==
1. Can it be used on live site ?
Ans: Please don't use this on live site. This is only for development purpose.

== Changelog ==

= 1.3 =
* Fixed HTML Validation error: "Saw U+0000 in stream." - props [Jrf](http://profiles.wordpress.org/jrf)
* Moved css to separate file - props [Jrf](http://profiles.wordpress.org/jrf)

= 1.2 =
* Fix for a closure issue.

= 1.1 =
* Fix for a fatal error bacuase of BuddyPress hooks
* Closed the ul tag.

= 1.0 =
Adding the initial plugin to Wordpress plugins directory.

== Upgrade Notice ==

= 1.3 =
Some bug fixes

= 1.0 =
New Installation
