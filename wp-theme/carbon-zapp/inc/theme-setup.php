<?php
/**
 * Core theme supports.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'carbon-zapp' ),
	) );
}
add_action( 'after_setup_theme', 'cz_theme_setup' );

/**
 * ACF Pro (or ACF with Repeater/Flexible Content) is required for the
 * Product/News field schema. Warn in wp-admin if it's missing instead of
 * fataling.
 */
function cz_admin_notice_missing_acf() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		echo '<div class="notice notice-error"><p><strong>Carbon Zapp theme:</strong> Advanced Custom Fields (Pro, or a version with Repeater and Flexible Content fields) is required and is not active. Product and News content will not display correctly until it is installed.</p></div>';
	}
	if ( ! class_exists( 'WPCF7' ) ) {
		echo '<div class="notice notice-error"><p><strong>Carbon Zapp theme:</strong> Contact Form 7 is required and is not active. See <code>wp-theme/CF7-SETUP.md</code> for the form to create.</p></div>';
	}
}
add_action( 'admin_notices', 'cz_admin_notice_missing_acf' );
