<?php
/**
 * News & Events custom post type + category taxonomy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_register_news_cpt() {
	register_post_type( 'cz_news', array(
		'labels' => array(
			'name'               => __( 'News & Events', 'carbon-zapp' ),
			'singular_name'      => __( 'Article', 'carbon-zapp' ),
			'add_new_item'       => __( 'Add New Article', 'carbon-zapp' ),
			'edit_item'          => __( 'Edit Article', 'carbon-zapp' ),
			'all_items'          => __( 'All Articles', 'carbon-zapp' ),
			'search_items'       => __( 'Search Articles', 'carbon-zapp' ),
			'not_found'          => __( 'No articles found', 'carbon-zapp' ),
		),
		'public'        => true,
		'has_archive'   => false,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-megaphone',
		'menu_position' => 6,
		'rewrite'       => array( 'slug' => 'news', 'with_front' => false ),
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	) );

	register_taxonomy( 'cz_news_category', 'cz_news', array(
		'labels' => array(
			'name'          => __( 'News Categories', 'carbon-zapp' ),
			'singular_name' => __( 'News Category', 'carbon-zapp' ),
		),
		'hierarchical'      => false,
		'public'            => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'news-category' ),
	) );
}
add_action( 'init', 'cz_register_news_cpt' );

/**
 * Seed the 3 default categories used by the source site's filter bar.
 */
function cz_seed_news_category_terms() {
	$terms = array(
		'events'     => 'Event',
		'news'       => 'News',
		'innovation' => 'Innovation',
	);
	foreach ( $terms as $slug => $label ) {
		if ( ! term_exists( $slug, 'cz_news_category' ) ) {
			wp_insert_term( $label, 'cz_news_category', array( 'slug' => $slug ) );
		}
	}
}

/**
 * Human-readable labels for cz_news_category terms, matching the source
 * site's catLabels map (cznews.html inline script / generate-news.py).
 */
function cz_news_category_labels() {
	return array(
		'events'     => 'Event',
		'news'       => 'News',
		'innovation' => 'Innovation',
	);
}

/**
 * "Primary" category slug for a cz_news post — mirrors the source site's
 * `a.categories[0]` (news.json array order) used to pick a single data-cat
 * per row on the news listing filter bar. WP's get_the_terms() does not
 * preserve wp_set_object_terms() insertion order (it's queried back
 * sorted), so instead of trusting term order we replicate the source
 * data's actual precedence: every dual-tagged article in news.json /
 * news-seed.php lists categories as events-only, or ['news','innovation']
 * (news always first) — so a fixed events > news > innovation priority
 * reproduces the original result for every existing article.
 */
function cz_news_primary_category( $post_id ) {
	$priority = array( 'events', 'news', 'innovation' );

	$terms = get_the_terms( $post_id, 'cz_news_category' );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return '';
	}

	$slugs = wp_list_pluck( $terms, 'slug' );

	foreach ( $priority as $slug ) {
		if ( in_array( $slug, $slugs, true ) ) {
			return $slug;
		}
	}

	return $slugs[0];
}

/**
 * Events for the homepage hero card — replaces the original news.json
 * fetch + client-side filter/sort with a server-side WP_Query.
 *
 * Mirrors the source site's behaviour: it never leaves the card empty just
 * because nothing is upcoming. Current/future events are preferred (soonest
 * first); if there are fewer than $limit of those, the remaining slots are
 * filled with the most recent past events (newest first) so the card falls
 * back to showing "Recent Event" instead of disappearing — same as
 * carbonzapp.com, which always renders the top of its unsorted events list
 * regardless of date and lets the label (Now On / Recent Event / Next
 * Appearance) communicate whether it's past or future.
 */
function cz_get_upcoming_events( $limit = 5 ) {
	$today = current_time( 'Ymd' );

	$all_events = get_posts( array(
		'post_type'      => 'cz_news',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'cz_news_category',
				'field'    => 'slug',
				'terms'    => 'events',
			),
		),
	) );

	$upcoming = array();
	$past     = array();

	foreach ( $all_events as $event ) {
		$start = get_field( 'event_start', $event->ID );
		if ( ! $start ) {
			continue;
		}
		$end = get_field( 'event_end', $event->ID );
		$end = $end ? $end : $start;

		$row = array( 'post' => $event, 'start' => $start );

		if ( $end >= $today ) {
			$upcoming[] = $row;
		} else {
			$past[] = $row;
		}
	}

	usort( $upcoming, function ( $a, $b ) {
		return strcmp( $a['start'], $b['start'] );
	} );
	usort( $past, function ( $a, $b ) {
		return strcmp( $b['start'], $a['start'] );
	} );

	$ordered = array_merge( wp_list_pluck( $upcoming, 'post' ), wp_list_pluck( $past, 'post' ) );

	return array_slice( $ordered, 0, $limit );
}
