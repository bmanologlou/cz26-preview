<?php
/**
 * Styles & scripts.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_enqueue_assets() {
	wp_enqueue_style(
		'cz-dm-mono',
		'https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,300;0,400;0,500;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'cz-theme',
		CZ_THEME_URI . '/assets/css/theme.css',
		array( 'cz-dm-mono' ),
		CZ_THEME_VERSION
	);

	wp_enqueue_style(
		'cz-responsive',
		CZ_THEME_URI . '/assets/css/responsive-style.css',
		array( 'cz-theme' ),
		CZ_THEME_VERSION
	);

	wp_enqueue_style(
		'cz-mobile-nav',
		CZ_THEME_URI . '/assets/css/mobile-nav.css',
		array( 'cz-theme' ),
		CZ_THEME_VERSION
	);

	wp_enqueue_script(
		'cz-main',
		CZ_THEME_URI . '/assets/js/main.js',
		array(),
		CZ_THEME_VERSION,
		true
	);

	wp_localize_script( 'cz-main', 'czAjax', array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'cz_newsletter' ),
	) );

	if ( is_singular( 'cz_product' ) ) {
		wp_enqueue_script(
			'cz-product-slider',
			CZ_THEME_URI . '/assets/js/product-slider.js',
			array(),
			CZ_THEME_VERSION,
			true
		);
	}

	if ( is_page( 'news' ) ) {
		wp_enqueue_script(
			'cz-news-filter',
			CZ_THEME_URI . '/assets/js/news-filter.js',
			array(),
			CZ_THEME_VERSION,
			true
		);
	}

	if ( is_page( 'contact' ) ) {
		wp_enqueue_style(
			'cz-cf7-overrides',
			CZ_THEME_URI . '/assets/css/cf7-overrides.css',
			array( 'cz-theme' ),
			CZ_THEME_VERSION
		);
	}

	if ( is_front_page() ) {
		wp_enqueue_script(
			'cz-hero-events',
			CZ_THEME_URI . '/assets/js/hero-events.js',
			array(),
			CZ_THEME_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'cz_enqueue_assets' );
