<?php
/**
 * One-time content importer. Creates the 18 Product posts and 12 News
 * posts (plus their taxonomy terms and ACF field values) from the seed
 * data files in inc/data/, so the theme ships with real content instead
 * of requiring 30 posts to be hand-entered through wp-admin.
 *
 * Run it either:
 *   wp cz import                          (WP-CLI, recommended)
 *   Tools → Carbon Zapp Import → Run Import   (wp-admin button, for hosts without WP-CLI)
 *
 * Safe to re-run: looks up posts by title before inserting, so it won't
 * create duplicates on a second run.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once CZ_THEME_DIR . '/inc/data/products-seed.php';
require_once CZ_THEME_DIR . '/inc/data/news-seed.php';

function cz_import_all_content() {
	if ( ! function_exists( 'update_field' ) ) {
		return new WP_Error( 'cz_import_no_acf', 'ACF must be active before running the import.' );
	}

	cz_seed_actuator_terms();
	cz_seed_news_category_terms();

	$results = array(
		'pages'    => cz_import_pages(),
		'products' => cz_import_products(),
		'news'     => cz_import_news(),
	);

	return $results;
}

/**
 * The 5 template-driven Pages (page-{slug}.php templates apply
 * automatically to a Page whose post_name matches the slug).
 */
function cz_import_pages() {
	$pages = array(
		'solutions'  => 'Solutions',
		'innovation' => 'Innovation',
		'cloudx'     => 'CloudX',
		'news'       => 'News & Events',
		'contact'    => 'Contact',
	);

	$created = array();
	foreach ( $pages as $slug => $title ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$created[ $slug ] = $existing->ID;
			continue;
		}
		$id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_status' => 'publish',
		) );
		$created[ $slug ] = $id;
	}
	return $created;
}

function cz_import_products() {
	$seed    = cz_products_seed();
	$created = array();

	foreach ( $seed as $slug => $data ) {
		$existing = get_page_by_path( $slug, OBJECT, 'cz_product' );
		if ( $existing ) {
			$post_id = $existing->ID;
		} else {
			$post_id = wp_insert_post( array(
				'post_type'   => 'cz_product',
				'post_title'  => $data['title'],
				'post_name'   => $slug,
				'post_status' => 'publish',
			) );
		}

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		if ( ! empty( $data['actuator_tags'] ) ) {
			wp_set_object_terms( $post_id, $data['actuator_tags'], 'cz_actuator' );
		}

		update_field( 'category_label', $data['category_label'] ?? '', $post_id );
		update_field( 'tagline', $data['tagline'] ?? '', $post_id );
		update_field( 'market', $data['market'] ?? 'specialists', $post_id );
		update_field( 'authorized', ! empty( $data['authorized'] ), $post_id );
		update_field( 'intro_disclaimer', $data['intro_disclaimer'] ?? '', $post_id );
		update_field( 'product_details_url', $data['product_details_url'] ?? '', $post_id );
		update_field( 'card_description', $data['card_description'] ?? '', $post_id );
		update_field( 'card_bg', $data['card_bg'] ?? 'none', $post_id );

		if ( ! empty( $data['hero_slides'] ) ) {
			$rows = array();
			foreach ( $data['hero_slides'] as $rel_path ) {
				$att_id = cz_import_theme_asset_as_attachment( $rel_path, $post_id );
				if ( $att_id ) {
					$rows[] = array( 'image' => $att_id );
				}
			}
			update_field( 'hero_slides', $rows, $post_id );
		}

		if ( ! empty( $data['key_capabilities'] ) ) {
			$rows = array_map( function ( $text ) {
				return array( 'text' => $text );
			}, $data['key_capabilities'] );
			update_field( 'key_capabilities', $rows, $post_id );
		}

		if ( ! empty( $data['brochure_pdf'] ) ) {
			$att_id = cz_import_theme_asset_as_attachment( $data['brochure_pdf'], $post_id );
			if ( $att_id ) {
				update_field( 'brochure_pdf', $att_id, $post_id );
			}
		}

		if ( ! empty( $data['card_image'] ) ) {
			$att_id = cz_import_theme_asset_as_attachment( $data['card_image'], $post_id );
			if ( $att_id ) {
				update_field( 'card_image', $att_id, $post_id );
				set_post_thumbnail( $post_id, $att_id );
			}
		}

		if ( ! empty( $data['sections'] ) ) {
			update_field( 'sections', cz_prepare_sections_for_acf( $data['sections'] ), $post_id );
		}

		$created[ $slug ] = $post_id;
	}

	return $created;
}

/**
 * Flattens our seed-array section shape into what ACF's flexible content
 * update_field() expects (each row needs 'acf_fc_layout' set to the
 * layout name).
 */
function cz_prepare_sections_for_acf( $sections ) {
	$rows = array();
	foreach ( $sections as $section ) {
		$type = $section['type'];
		unset( $section['type'] );
		$section['acf_fc_layout'] = $type;

		if ( $type === 'content_block' && ! empty( $section['list_items'] ) ) {
			$section['list_items'] = array_map( function ( $text ) {
				return array( 'text' => $text );
			}, $section['list_items'] );
		}
		if ( $type === 'cards_block' && ! empty( $section['cards'] ) ) {
			// already in [label,title,body] shape, matches sub_field names directly
		}

		$rows[] = $section;
	}
	return $rows;
}

function cz_import_news() {
	$seed    = cz_news_seed();
	$created = array();

	foreach ( $seed as $slug => $data ) {
		$existing = get_page_by_path( $slug, OBJECT, 'cz_news' );
		if ( $existing ) {
			$post_id = $existing->ID;
		} else {
			$content = implode( "\n\n", array_map( 'wp_kses_post', $data['body'] ) );

			// Seed dates are Y-m-d, defaulting to 09:00. An entry may instead
			// give a full Y-m-d H:i:s to break a same-day tie in the news
			// listing's post_date DESC order.
			$post_date = strlen( $data['date'] ) > 10 ? $data['date'] : $data['date'] . ' 09:00:00';

			$post_id = wp_insert_post( array(
				'post_type'    => 'cz_news',
				'post_title'   => $data['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_date'    => $post_date,
				'post_excerpt' => $data['excerpt'] ?? '',
				'post_content' => wpautop( $content ),
			) );
		}

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		if ( ! empty( $data['categories'] ) ) {
			wp_set_object_terms( $post_id, $data['categories'], 'cz_news_category' );
		}

		if ( ! empty( $data['image'] ) && ! has_post_thumbnail( $post_id ) ) {
			// Older entries hotlink a carbonzapp.com URL and get sideloaded;
			// newer ones ship the artwork in the theme's own /assets/.
			$att_id = preg_match( '#^https?://#i', $data['image'] )
				? cz_sideload_external_image( $data['image'], $post_id, $data['title'] )
				: cz_import_theme_asset_as_attachment( $data['image'], $post_id );
			if ( $att_id ) {
				set_post_thumbnail( $post_id, $att_id );
			}
		}

		if ( ! empty( $data['event'] ) ) {
			$event = $data['event'];
			update_field( 'event_date_display', $event['date_display'] ?? '', $post_id );
			update_field( 'event_start', $event['start'] ?? '', $post_id );
			update_field( 'event_end', $event['end'] ?? '', $post_id );
			update_field( 'event_location', $event['location'] ?? '', $post_id );
			update_field( 'event_link', $event['link'] ?? '', $post_id );
		}

		$created[ $slug ] = $post_id;
	}

	return $created;
}

/**
 * Copies a file bundled under the theme's /assets/ directory into the
 * Media Library and returns the new attachment ID (or an existing one
 * with a matching title, on re-run).
 */
function cz_import_theme_asset_as_attachment( $relative_path, $parent_post_id = 0 ) {
	$file_path = CZ_THEME_DIR . '/assets/' . ltrim( $relative_path, '/' );
	if ( ! file_exists( $file_path ) ) {
		return 0;
	}

	$filename = basename( $file_path );
	$existing = get_posts( array(
		'post_type'      => 'attachment',
		'title'          => $filename,
		'posts_per_page' => 1,
		'fields'         => 'ids',
	) );
	if ( $existing ) {
		return $existing[0];
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$upload = wp_upload_bits( $filename, null, file_get_contents( $file_path ) );
	if ( $upload['error'] ) {
		return 0;
	}

	$filetype   = wp_check_filetype( $upload['file'], null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => $filename,
		'post_status'    => 'inherit',
	);
	$att_id = wp_insert_attachment( $attachment, $upload['file'], $parent_post_id );
	if ( ! is_wp_error( $att_id ) ) {
		$att_data = wp_generate_attachment_metadata( $att_id, $upload['file'] );
		wp_update_attachment_metadata( $att_id, $att_data );
	}
	return $att_id;
}

/**
 * Sideloads a remote image (news.json's articles currently hotlink
 * carbonzapp.com production images) into the Media Library.
 */
function cz_sideload_external_image( $url, $parent_post_id, $desc = '' ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$att_id = media_sideload_image( $url, $parent_post_id, $desc, 'id' );
	return is_wp_error( $att_id ) ? 0 : $att_id;
}

/**
 * WP-CLI: wp cz import
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'cz import', function () {
		$result = cz_import_all_content();
		if ( is_wp_error( $result ) ) {
			WP_CLI::error( $result->get_error_message() );
			return;
		}
		WP_CLI::success( sprintf(
			'Imported %d pages, %d products, %d news articles.',
			count( $result['pages'] ),
			count( $result['products'] ),
			count( $result['news'] )
		) );
	} );
}

/**
 * wp-admin fallback for hosts without WP-CLI: Tools → Carbon Zapp Import.
 */
add_action( 'admin_menu', function () {
	add_management_page(
		'Carbon Zapp Import',
		'Carbon Zapp Import',
		'manage_options',
		'cz-import',
		'cz_render_import_page'
	);
} );

function cz_render_import_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$ran = false;
	$result = null;
	if ( isset( $_POST['cz_run_import'] ) && check_admin_referer( 'cz_run_import' ) ) {
		$result = cz_import_all_content();
		$ran = true;
	}

	echo '<div class="wrap"><h1>Carbon Zapp Import</h1>';
	echo '<p>Creates the Solutions/Innovation/CloudX/News/Contact pages, all 18 products, and all 12 news articles from the bundled seed data. Safe to run more than once.</p>';

	if ( $ran ) {
		if ( is_wp_error( $result ) ) {
			printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html( $result->get_error_message() ) );
		} else {
			printf(
				'<div class="notice notice-success"><p>Imported %d pages, %d products, %d news articles.</p></div>',
				count( $result['pages'] ), count( $result['products'] ), count( $result['news'] )
			);
		}
	}

	echo '<form method="post">';
	wp_nonce_field( 'cz_run_import' );
	echo '<input type="hidden" name="cz_run_import" value="1">';
	submit_button( 'Run Import' );
	echo '</form></div>';
}
