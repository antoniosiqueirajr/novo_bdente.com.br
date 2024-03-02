<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cff_should_disable_pro() {
    return cff_main_pro()->cff_license_handler->should_disable_pro_features;
}

function cff_license_inactive_state() {
    return empty( cff_main_pro()->cff_license_handler->get_license_key );
}

function cff_license_notice_active() {
    return empty( cff_main_pro()->cff_license_handler->get_license_key ) || cff_main_pro()->cff_license_handler->expiredLicenseWithGracePeriodEnded;
}

/**
 * Check should add free plugin submenu for the free version
 *
 * @since 4.4
 */
function cff_should_add_free_plugin_submenu( $plugin ) {
	if ( !cff_main_pro()->cff_license_handler->should_disable_pro_features ) {
		return;
	}

	if ( $plugin === 'instagram' && !is_plugin_active( 'instagram-feed/instagram-feed.php' ) && !is_plugin_active( 'instagram-feed-pro/instagram-feed.php' ) ) {
		return true;
	}

	if ( $plugin === 'youtube' && !is_plugin_active( 'youtube-feed-pro/youtube-feed-pro.php' ) && !is_plugin_active( 'feeds-for-youtube/youtube-feed.php' ) ) {
		return true;
	}

	if ( $plugin === 'twitter' && !is_plugin_active( 'custom-twitter-feeds/custom-twitter-feed.php' ) && !is_plugin_active( 'custom-twitter-feeds-pro/custom-twitter-feed.php' ) ) {
		return true;
	}

	if ( $plugin === 'reviews' && !is_plugin_active( 'reviews-feed/sb-reviews.php' ) && !is_plugin_active( 'reviews-feed-pro/sb-reviews-pro.php' ) ) {
		return true;
	}

	return;
}


function flatten_array($array)
{
	$result = array();
	foreach ($array as $value) {
	  if (is_array($value)) {
		$result = array_merge($result, flatten_array($value));
	  } else {
		$result[] = $value;
	  }
	}
	return $result;
}