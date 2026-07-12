<?php
/**
 * Product custom post type + Actuator Tags taxonomy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_register_product_cpt() {
	register_post_type( 'cz_product', array(
		'labels' => array(
			'name'               => __( 'Products', 'carbon-zapp' ),
			'singular_name'      => __( 'Product', 'carbon-zapp' ),
			'add_new_item'       => __( 'Add New Product', 'carbon-zapp' ),
			'edit_item'          => __( 'Edit Product', 'carbon-zapp' ),
			'all_items'          => __( 'All Products', 'carbon-zapp' ),
			'search_items'       => __( 'Search Products', 'carbon-zapp' ),
			'not_found'          => __( 'No products found', 'carbon-zapp' ),
		),
		'public'        => true,
		'has_archive'   => false,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-admin-tools',
		'menu_position' => 5,
		'rewrite'       => array( 'slug' => 'product', 'with_front' => false ),
		'supports'      => array( 'title' ),
	) );

	register_taxonomy( 'cz_actuator', 'cz_product', array(
		'labels' => array(
			'name'          => __( 'Actuator Tags', 'carbon-zapp' ),
			'singular_name' => __( 'Actuator Tag', 'carbon-zapp' ),
		),
		'hierarchical'      => false,
		'public'            => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'actuator' ),
	) );
}
add_action( 'init', 'cz_register_product_cpt' );

/**
 * Seed the default actuator terms (from solutions.html's filter pills).
 * Safe to call multiple times; term_exists guards against duplicates.
 */
function cz_seed_actuator_terms() {
	$terms = array(
		'crdi'     => 'CRDi',
		'crp'      => 'CRp',
		'eui-eup'  => 'EUi/EUP',
		'heui'     => 'HEUi',
		'engine'   => 'Engine',
		'gdi-inj'  => 'GDi Inj',
		'efi'      => 'EFi',
		'gdi-pump' => 'GDi Pump',
	);
	foreach ( $terms as $slug => $label ) {
		if ( ! term_exists( $slug, 'cz_actuator' ) ) {
			wp_insert_term( $label, 'cz_actuator', array( 'slug' => $slug ) );
		}
	}
}
