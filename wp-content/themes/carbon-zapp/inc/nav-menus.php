<?php
/**
 * Primary nav fallback (used until the user builds a menu in
 * Appearance > Menus). Mirrors the flat nav from _nav.html.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_nav_links() {
	return array(
		array( 'label' => 'Home', 'url' => home_url( '/' ), 'active' => is_front_page() ),
		array( 'label' => 'Solutions', 'url' => cz_page_url( 'solutions' ), 'active' => cz_is_solutions_context() ),
		array( 'label' => 'Innovation', 'url' => cz_page_url( 'innovation' ), 'active' => is_page( 'innovation' ) ),
		array( 'label' => 'CloudX', 'url' => cz_page_url( 'cloudx' ), 'active' => is_page( 'cloudx' ) ),
		array( 'label' => 'News', 'url' => cz_page_url( 'news' ), 'active' => is_page( 'news' ) || is_singular( 'cz_news' ) ),
		array( 'label' => 'Contact', 'url' => cz_page_url( 'contact' ), 'active' => is_page( 'contact' ) ),
	);
}

function cz_nav_fallback() {
	echo '<ul class="nav-links">';
	foreach ( cz_nav_links() as $link ) {
		printf(
			'<li><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $link['url'] ),
			$link['active'] ? ' class="active"' : '',
			esc_html( $link['label'] )
		);
	}
	echo '</ul>';
}

/**
 * Mobile slide-out menu fallback. The mobile-nav CSS targets
 * `.nav-mobile-menu > a` (flat direct children, no <li> wrapper), matching
 * the markup ported from index.html, so this can't reuse cz_nav_fallback()'s
 * <ul><li> structure.
 */
function cz_mobile_nav_fallback() {
	foreach ( cz_nav_links() as $link ) {
		printf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( $link['url'] ),
			$link['active'] ? ' class="active"' : '',
			esc_html( $link['label'] )
		);
	}
}

/**
 * Renders a 'primary' menu item as a flat <a> with no <li> wrapper, for the
 * mobile slide-out menu (see cz_mobile_nav_fallback() docblock above).
 */
class CZ_Mobile_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$active  = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );

		$output .= sprintf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( $item->url ),
			$active ? ' class="active"' : '',
			esc_html( $item->title )
		);
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Returns the permalink for a WP Page by slug, falling back to a
 * best-guess front-end URL if the page hasn't been created yet
 * (e.g. before the content import script has run).
 */
function cz_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $slug . '/' );
}

/**
 * "Solutions" nav item should stay highlighted on the catalog page
 * and on any individual product detail page.
 */
function cz_is_solutions_context() {
	return is_page( 'solutions' ) || is_singular( 'cz_product' );
}
