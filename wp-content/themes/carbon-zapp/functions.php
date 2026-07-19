<?php
/**
 * Carbon Zapp theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CZ_THEME_VERSION', '1.0.0' );
define( 'CZ_THEME_DIR', get_template_directory() );
define( 'CZ_THEME_URI', get_template_directory_uri() );

require CZ_THEME_DIR . '/inc/theme-setup.php';
require CZ_THEME_DIR . '/inc/enqueue.php';
require CZ_THEME_DIR . '/inc/nav-menus.php';
require CZ_THEME_DIR . '/inc/cpt-product.php';
require CZ_THEME_DIR . '/inc/product-order.php';
require CZ_THEME_DIR . '/inc/cpt-news.php';
require CZ_THEME_DIR . '/inc/acf-fields.php';
require CZ_THEME_DIR . '/inc/newsletter-ajax.php';
require CZ_THEME_DIR . '/inc/import-content.php';
