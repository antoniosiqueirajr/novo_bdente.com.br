=== Elemailer - Elementor email template & campaign builder for WordPress ===
Contributors: elemailer
Tags: email-template-builder, elementor, email-template, email, template, elementor add on, email-marketing
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 7.2
Stable tag: 4.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Design your emails without any code, list subscribers, newsletters, and many more!

== Installation ==

1. Upload the plugin folder after extracting it to the "/wp-content/plugins/(the folder of the extracted plugin)" directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. You should now have Elemailer tab on wp-admin. 

== Update Instructions ==
Update the plugin either via wp-dashboard or via FTP. After update, you should go to Elementor> Tools> Regenerate CSS and save. Then clear your browser cache and check all your email templates looks and functions fine.
== Changelog ==
= 4.1.1 =
* Fix: Compatibility with the next release of Elementor

= 4.1.0 =
* New: Typography control in many widgets with web-safe fonts
* New: New Pause, Resume, Terminate system for emails
* New: Search widgets in editor panel
* Tweak: Added Border radius & Hover control for button
* Tweak: Added Border radius for image
* Tweak: Deprecated old font size, line height controls
* Tweak: Fixed issue with XSS plugin
* Tweak: Editor UI fixes
* Tweak: Only load/paste Elemailer widgets in editor
* Tweak: Open in new tab for preview and back in iframe
* Tweak: Removed Double-opt in & Welcome email for imported subscribers
* Tweak: Removed Elementor editor top bar experiment
* Tweak: Performance improvement for Latest Posts & Selected posts widget
* Fix: Fixed issue for bulk email sending, now works via wp-cron
* Fix: Table sorting & searching not working as expected
* Fix: Fixed few php errors
* Fix: Some styles not same in email vs site preview
* Fix: Remove Elementor kit & other styles from editor view to avoid confusion
* Fix: Compatibility issue with latest Elementor update

= 4.0.17 =
* Fix: Subscriber shortcodes not working properly

= 4.0.16 =
* Fix: Double Opt in subject not working.
* Tweak: Updated for latest WP
* Tweak: Updated for latest Elementor & Elementor pro

= 4.0.15 =
* Fix: WooCommerce Item Details showing wrong order info.

= 4.0.14 =
* New: HTML widget
* Tweak: AI support for different widget and CSS controls
* Tweak: Changed some control descriptions
* Fix: Fixed section control issue due to elementor update
* Fix: Removed Global panel from left editor panel as we should
* Fix: Stats Reply to mail wrong

= 4.0.13 =
* Tweak: Fixed some windows outlook app layout issues
* Tweak: Added control for outlook background support (partial)
* Tweak: Added image alt, title for images
* New: Added custom css class option for section & widgets

= 4.0.12 =
* Fix: Template not saved if Latest posts widget used
* Fix: Typo in some files 

= 4.0.11 =
* Fix: Flicker in template library when refreshed 
* Fix: Flicker in save template system 
* Fix: Template library filter not working free/pro 
* Fix: Avoid fatal error if remote template library not found 
* Fix: Not more than 5 template working in WC email template condition 
* Fix: Delete template not working & causing fatal error 

= 4.0.10 =
* Fix: Flicker in WC emails list 
* Fix: Duplicate ignoring email from reply from setting 

= 4.0.9 =
* New: Added responsive system for tables in WC email
* New: Added condition display for WC emails and where applied
* Fix: Duplicate option not working if HTML is used in text widget
* Fix: Special characters getting lost while duplicating 
* Tweak: New subscribers, email, lists will be on top in table according to ID of DB
* Tweak: Compatibility with Latest Elementor 
* Tweak: Optimized the duplicate system to copy all option

= 4.0.8 =
* New: Added Unsubscribed and total in Lists
* New: Added Internal status and List status seperately for clearity
* Tweak: DB query 
* Tweak: Fixed type for DB update for unsubscribed
* Tweak: Prepare Edit subscriber future update 


= 4.0.7 =
* Fix: PHP warning on edit page of wp for elementor experiment
* Fix: RTL language template library button
* Fix: PHP error related to License
* Tweak: Improve shortcode layout
* Tweak: WPML translation support added
* Tweak: WC widget trasnalation issue
* New: Many typography control for WC iteam details table
* New: Added CSV export for Emails and Stats

= 4.0.6 =
* Fix: PHP warning
* Fix: Bug on manage subscription page with saving preference
* New: Added All in dropdown for Subscribers list

= 4.0.5 =
* Fix: Fatal error with Elementor update due to experiments

= 4.0.4 =
* Fix: Fatal error due to missing $user variable for internal shortcode function
* Fix: Removed deprecated function of Elementor
* Tweak: Added translation support to few texts

= 4.0.3 =
* Fix: WC Password reset & New account password link don't work
* Tweak: Added New shortcode such as %%reset_password_url%% support for WC new account and other widget

= 4.0.2 =
* New: Customer Invoice Email template
* Tweak: Added wc shortcode support such as %%get_checkout_payment_url%% 
* Tweak: Added wc shortcode support such as %%get_checkout_payment_url%% in button URL field
* Tweak: HTML export now happens in wp-content folder

= 4.0.1 =
* New: Custom CSS in setting tab for emails
* Tweak: Added image background control for product details table

= 4.0 =
* New: WooCommerce order meta widget to allow default filter use
* New: Added shortcode parsing method with filter support for future use for woocommerce
* New: Export HTML template (Basic)
* Fix: Fixed wc PHP warning for accessing orders directly
* Fix: Removed empty h4 tag in shortcode widget even if no data as there
* Fix: Fix Welcome email Unsubscribe, manage subscription not working
* Fix: PHP warning on double opt in email due to template_id variable
* Fix: WooCommerce draft emails being sent
* Tweak: Removed default 10px margin for the shortcode widget
* Tweak: Tweaked all WC widgets with shortcode support with the new method
* Tweak: Allow editing Welcome email all the times
* Tweak: Added details to footer widget & welcome email for clearity

= 3.9 =
* Fix: WooCommerce product email condition not working

= 3.8 =
* Fix: Fatal error with elementor 3.8

= 3.7 =
* Fix: Elemailer controls affecting normal post types

= 3.6 =
* New: Section default gap control globally
* New: Added new control in WC item details: Image size, Image size CSS, table size controls, Gap control
* New: Added new control in WC new account widget for link
* Fix: Added fix for css of missing default section gap 10px in sent emails
* Fix: Unable to edit Woo desings directly with edit design button
* Fix: PHP warning for background control
* Fix: WC notes, new account widgets font-size not working
* Tweak: Removed WC email force CSS for table to allow different width in that
* Tweak: Added body class directly to avoid inconsistancy and enable less CSS lines
* Tweak: Changed icons for wc widgets & description update
* Tweak: WC note widgets added class and removed default values


= 3.5 =
* New: Test email sending option added

= 3.4 =
* Fix: Fixed Typo
* Tweak: Prevnet edit design for sent emails
* Tweak: Added help article link

= 3.3 =
* Fix: Create new email not working after 3.2 update
* Tweak: Reload page on manage subscription to show proper data
* Tweak: Descriptions updated for lists edit and add new
* New: Public / Private control for lists in Manage subscription
* New: Edit design panel added in emails to allow direct editing of design

= 3.2 =
* Fix: Multiple PHP error fixed
* Fix: Subscriber Search not working properly
* Fix: Subscriber Update not working prolery with List
* Tweak: Changed Null text to N/A in subscriber list
* New: Fluent Form subscriber and email template support added
* Tweak: Compatiblity with Query monitor & Debug bar plugin
* Tweak: Fixed bug with adminify css and overlay

= 3.1 =
* Fix: Selected post widget image position issue

= 3.0 =
* New: Shortcode generator
* Tweak: Changed shortcode parttern for more support
* Tweak: CSV importer improved
 
= 2.8 =
* Fix: WC emails don't have proper styles

= 2.7 =
* New: Elemailer shortcode generator
* Fix: WC guest order emails are blank

= 2.6 =
* New: Added body background control for emails
* Tweak: Control issues due to 3rd party plugins
* Fix: Removed Container experiement inside Elemailer

= 2.5 =
* New: WPForms form integration

= 2.4 =
* New: Ninja form integration
* Fix: CSS fix for template layout broken when using Optimize DOM output feature of Elementor

= 2.3 =
* Fix: Double opt-in confirmation not working
* New: Custom shortcode with message modifier for double opt in confirm page
* New: Added Setting option for wp_mail override system
* New: Added filter and action for wp_mail override system of elemailer to allow HTML, search-replace override.
* Tweak: Added shortcode widget description regarding new shortcodes
* Fix: Fatal error at stats page on elemailer.
* Fix: Fatal error on stats tracking code if the given token doesn't match DB token.
* Tweak: Renamed 'Reply-to' to 'Sent to List ' in stats page as that's appropriate
* New: Added 5 shortcode for the welcome email ( user firstname, last name etc )
* Fix: Welcome email tracking not working
* Fix: Post notification & newsletter - email's created_at shortcode not working and causing a php error
* Fix: cf7 content type html checkbox issue with elemailer with js
* Tweak: Change the way cf7 integration works ( seperate functions for shortcode method vs selecting template method )
* Tweak: Added doc links in the setting panel.

= 2.2 =
* Fix: Custom unsubscribe success page not working
* Fix: Undefined index php warning fix
* Tweak: Translation string support for Unsubscribe & success page

= 2.1 =
* Fix: Elementor _register_controls deprication message fixed
* Fix: Elementor add_form_action deprication message fixed

= 2.0 =
* New: Piotnet Addons For Elementor (PAFE)- Form full integration
* Tweak: WooCommerce widgets showing in normal form editor
* Tweak: WooCommerce new user account widget more shortcode support

= 1.0.9 =
* Fix: Subscriber not being added if not logged in from Elementor
* Fix: php warning due to not having value
* New: Translation support added

= 1.0.8 =
* New: WooCommerce emails support added
* New: WooCommerce booking emails support added
* New: Cf7 integration for subscription
* Improved: Improved cf7 integration by adding select option directly
* Fix: PHP warnings in settings panel option
* Fix: Issue with manage, unsubscribe pages when other template is used for homepage

= 1.0.7 =
* Fix: Background image and color not working properly on email template
= 1.0.6 =
* Fix: Template library save layout issue fix
* Fix: Template library preview fix

= 1.0.5 =
* New: Template library added
* New: Save template and reuse them

== 1.0.4 ==
* Fix: Heading widget link issue
* Fix: Conflict with ACF frontend plugin
* Fix: Alignment Icons missing in controls
* Fix: Elementor pro Notice system to trigger only if elementor pro exists

= 1.0.3 =
* Fix: Compatibility with elementor pro 3.5
* New : Shortcode system for other plugin uses in future

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 4.1.0 =
Attention!Major release!. Please take a full Backup of your site before you update.

1. Before Update - Remove your current email Newsletter or Post Notification. 
2. After the update, go to Elementor > Tools > Regenerate CSS. 
3. Finally, check all your Email templates to make sure the layout is correct.
