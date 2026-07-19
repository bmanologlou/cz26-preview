<?php
/**
 * Drag-and-drop ordering for the Products (cz_product) admin list table.
 *
 * Front-end product queries already sort by menu_order (see page-solutions.php),
 * this just makes menu_order editable from wp-admin via a sortable list.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Only offer drag-and-drop on the plain, unsearched/unfiltered/default-sorted
 * list — dragging while searching or sorted by another column would reorder
 * against a view that doesn't reflect the canonical menu_order sequence.
 */
function cz_product_order_is_default_view() {
	if ( ! empty( $_GET['s'] ) || ! empty( $_GET['orderby'] ) || ! empty( $_GET['cz_actuator'] ) ) {
		return false;
	}
	return true;
}

function cz_product_order_admin_assets( $hook ) {
	if ( 'edit.php' !== $hook || 'cz_product' !== ( $_GET['post_type'] ?? '' ) ) {
		return;
	}
	if ( ! cz_product_order_is_default_view() ) {
		return;
	}

	wp_enqueue_script(
		'cz-product-order',
		CZ_THEME_URI . '/assets/js/admin-product-order.js',
		array( 'jquery', 'jquery-ui-sortable' ),
		CZ_THEME_VERSION,
		true
	);

	wp_localize_script( 'cz-product-order', 'czProductOrder', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'cz_reorder_products' ),
	) );

	wp_add_inline_style( 'common', '
		.column-cz_order { width: 26px; padding-right: 0; }
		.cz-sort-handle { cursor: move; color: #a7aaad; }
		.cz-sort-handle:hover { color: #3c434a; }
		#the-list tr.cz-order-dragging { background: #f0f6fc; }
	' );
}
add_action( 'admin_enqueue_scripts', 'cz_product_order_admin_assets' );

/**
 * Drag-handle column, shown leftmost on the default view only.
 */
function cz_product_order_column( $columns ) {
	if ( ! cz_product_order_is_default_view() ) {
		return $columns;
	}
	$new = array( 'cz_order' => '' );
	return array_merge( $new, $columns );
}
add_filter( 'manage_cz_product_posts_columns', 'cz_product_order_column' );

function cz_product_order_column_content( $column, $post_id ) {
	if ( 'cz_order' === $column ) {
		echo '<span class="cz-sort-handle dashicons dashicons-menu" data-id="' . esc_attr( $post_id ) . '" title="' . esc_attr__( 'Drag to reorder', 'carbon-zapp' ) . '"></span>';
	}
}
add_action( 'manage_cz_product_posts_custom_column', 'cz_product_order_column_content', 10, 2 );

/**
 * Default the list table to menu_order so the drag order is visible.
 */
function cz_product_order_default_sort( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( 'cz_product' !== $query->get( 'post_type' ) ) {
		return;
	}
	if ( ! cz_product_order_is_default_view() ) {
		return;
	}
	$query->set( 'orderby', 'menu_order' );
	$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'cz_product_order_default_sort' );

/**
 * AJAX: persist a new drag order.
 *
 * Only the IDs visible on the current page are posted. To keep ordering
 * consistent across pagination, the full catalog is fetched in its existing
 * canonical order, the posted IDs are spliced out, and reinserted (in their
 * new order) at the position of the first item that moved.
 */
function cz_product_order_save() {
	check_ajax_referer( 'cz_reorder_products', 'nonce' );

	if ( ! current_user_can( 'edit_others_posts' ) ) {
		wp_send_json_error( array( 'message' => __( 'Permission denied.', 'carbon-zapp' ) ), 403 );
	}

	$moved_ids = isset( $_POST['order'] ) ? array_map( 'absint', (array) $_POST['order'] ) : array();
	if ( empty( $moved_ids ) ) {
		wp_send_json_error( array( 'message' => __( 'Nothing to save.', 'carbon-zapp' ) ), 400 );
	}

	$all_ids = get_posts( array(
		'post_type'      => 'cz_product',
		'post_status'    => array( 'publish', 'draft', 'pending', 'private', 'future' ),
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'fields'         => 'ids',
	) );

	$insert_at = null;
	$remaining = array();
	foreach ( $all_ids as $index => $id ) {
		if ( in_array( $id, $moved_ids, true ) ) {
			if ( null === $insert_at ) {
				$insert_at = count( $remaining );
			}
			continue;
		}
		$remaining[] = $id;
	}
	if ( null === $insert_at ) {
		$insert_at = count( $remaining );
	}

	array_splice( $remaining, $insert_at, 0, $moved_ids );

	foreach ( $remaining as $index => $id ) {
		wp_update_post( array( 'ID' => $id, 'menu_order' => $index ) );
	}

	wp_send_json_success();
}
add_action( 'wp_ajax_cz_reorder_products', 'cz_product_order_save' );
