<?php
/**
 * ACF field group registration, shipped as code so no manual field-group
 * import is required after theme activation. Requires ACF Pro (or an ACF
 * build with Repeater + Flexible Content fields).
 *
 * Schema reference: wp-theme/SCHEMA.md
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

add_action( 'acf/init', function () {

	// ── Product fields ──────────────────────────────────────────────
	acf_add_local_field_group( array(
		'key'    => 'group_cz_product',
		'title'  => 'Product Details',
		'fields' => array(
			array(
				'key'   => 'field_cz_category_label',
				'label' => 'Category Label',
				'name'  => 'category_label',
				'type'  => 'text',
				'instructions' => 'Eyebrow shown above the product name, e.g. "Large Engines Diesel Test Bench".',
			),
			array(
				'key'   => 'field_cz_tagline',
				'label' => 'Tagline',
				'name'  => 'tagline',
				'type'  => 'textarea',
				'rows'  => 2,
			),
			array(
				'key'     => 'field_cz_market',
				'label'   => 'Market',
				'name'    => 'market',
				'type'    => 'select',
				'choices' => array(
					'specialists' => 'Specialists',
					'workshops'   => 'Workshops',
				),
				'allow_null' => 0,
				'default_value' => 'specialists',
			),
			array(
				'key'   => 'field_cz_authorized',
				'label' => 'VDO / Continental Authorized',
				'name'  => 'authorized',
				'type'  => 'true_false',
				'ui'    => 1,
			),
			array(
				'key'          => 'field_cz_hero_slides',
				'label'        => 'Hero Slides',
				'name'         => 'hero_slides',
				'type'         => 'repeater',
				'layout'       => 'table',
				'min'          => 1,
				'button_label' => 'Add Slide',
				'sub_fields'   => array(
					array(
						'key'           => 'field_cz_hero_slide_image',
						'label'         => 'Image',
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'array',
					),
				),
			),
			array(
				'key'          => 'field_cz_key_capabilities',
				'label'        => 'Key Capabilities',
				'name'         => 'key_capabilities',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add Capability',
				'sub_fields'   => array(
					array(
						'key'   => 'field_cz_key_capability_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'   => 'field_cz_intro_disclaimer',
				'label' => 'Intro Disclaimer',
				'name'  => 'intro_disclaimer',
				'type'  => 'textarea',
				'rows'  => 2,
				'instructions' => 'Optional. Only shown on simpler products, e.g. "More in-depth product information material is currently being prepared."',
			),
			array(
				'key'   => 'field_cz_product_details_url',
				'label' => 'Product Details URL',
				'name'  => 'product_details_url',
				'type'  => 'url',
				'instructions' => 'External link to carbonzapp.com specialist page.',
			),
			array(
				'key'           => 'field_cz_brochure_pdf',
				'label'         => 'Brochure PDF',
				'name'          => 'brochure_pdf',
				'type'          => 'file',
				'return_format' => 'array',
			),
			array(
				'key'           => 'field_cz_card_image',
				'label'         => 'Catalog Card Image',
				'name'          => 'card_image',
				'type'          => 'image',
				'return_format' => 'array',
				'instructions'  => 'Thumbnail shown on the Solutions catalog grid.',
			),
			array(
				'key'   => 'field_cz_card_description',
				'label' => 'Catalog Card Description',
				'name'  => 'card_description',
				'type'  => 'text',
			),
			array(
				'key'     => 'field_cz_card_bg',
				'label'   => 'Catalog Card Background',
				'name'    => 'card_bg',
				'type'    => 'select',
				'choices' => array(
					'none' => 'None',
					'blue' => 'Blue',
				),
				'default_value' => 'none',
			),
			array(
				'key'          => 'field_cz_sections',
				'label'        => 'Product Detail Sections',
				'name'         => 'sections',
				'type'         => 'flexible_content',
				'button_label' => 'Add Section',
				'instructions' => 'Optional rich sections: Overview, Industry Applications, Testing Capabilities, Hardware Engineering, Diagnostic Intelligence, Software & Connectivity, OEM Ecosystem, Closing Statement. Leave empty for simple products.',
				'layouts'      => array(
					'layout_cz_content_block' => array(
						'key'   => 'layout_cz_content_block',
						'name'  => 'content_block',
						'label' => 'Content Block',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key'   => 'field_cz_cb_eyebrow',
								'label' => 'Eyebrow',
								'name'  => 'eyebrow',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_cz_cb_heading',
								'label' => 'Heading',
								'name'  => 'heading',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_cz_cb_body',
								'label' => 'Body',
								'name'  => 'body',
								'type'  => 'wysiwyg',
								'tabs'  => 'visual',
								'toolbar' => 'basic',
								'media_upload' => 0,
							),
							array(
								'key'     => 'field_cz_cb_list_style',
								'label'   => 'List Style',
								'name'    => 'list_style',
								'type'    => 'select',
								'choices' => array(
									'none'  => 'None',
									'dot'   => 'Dot',
									'check' => 'Check',
								),
								'default_value' => 'none',
							),
							array(
								'key'   => 'field_cz_cb_list_title',
								'label' => 'List Title',
								'name'  => 'list_title',
								'type'  => 'text',
								'instructions' => 'Optional, e.g. "Coverage includes".',
							),
							array(
								'key'          => 'field_cz_cb_list_items',
								'label'        => 'List Items',
								'name'         => 'list_items',
								'type'         => 'repeater',
								'layout'       => 'table',
								'button_label' => 'Add Item',
								'sub_fields'   => array(
									array(
										'key'   => 'field_cz_cb_list_item_text',
										'label' => 'Text',
										'name'  => 'text',
										'type'  => 'text',
									),
								),
							),
							array(
								'key'   => 'field_cz_cb_highlight_text',
								'label' => 'Highlight Callout',
								'name'  => 'highlight_text',
								'type'  => 'text',
								'instructions' => 'Optional standalone accent line, e.g. "Complete Coverage. Complete Confidence. One Complete Bench."',
							),
						),
					),
					'layout_cz_cards_block' => array(
						'key'   => 'layout_cz_cards_block',
						'name'  => 'cards_block',
						'label' => 'Cards Block',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key'   => 'field_cz_cds_eyebrow',
								'label' => 'Eyebrow',
								'name'  => 'eyebrow',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_cz_cds_heading',
								'label' => 'Heading',
								'name'  => 'heading',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_cz_cds_intro',
								'label' => 'Intro',
								'name'  => 'intro',
								'type'  => 'textarea',
								'rows'  => 2,
							),
							array(
								'key'          => 'field_cz_cds_cards',
								'label'        => 'Cards',
								'name'         => 'cards',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => 'Add Card',
								'sub_fields'   => array(
									array(
										'key'   => 'field_cz_cds_card_label',
										'label' => 'Label',
										'name'  => 'label',
										'type'  => 'text',
										'instructions' => 'Numbered ("01") or coded ("IC", "RSP") card marker.',
									),
									array(
										'key'   => 'field_cz_cds_card_title',
										'label' => 'Title',
										'name'  => 'title',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_cz_cds_card_body',
										'label' => 'Body',
										'name'  => 'body',
										'type'  => 'textarea',
										'rows'  => 3,
									),
								),
							),
						),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'cz_product',
				),
			),
		),
	) );

	// ── News / Event fields ─────────────────────────────────────────
	acf_add_local_field_group( array(
		'key'    => 'group_cz_news_event',
		'title'  => 'Event Details',
		'instructions' => 'Only fill in when this article is tagged "Event" — the event card only renders when Event Date Display is set.',
		'fields' => array(
			array(
				'key'   => 'field_cz_event_date_display',
				'label' => 'Event Date (display)',
				'name'  => 'event_date_display',
				'type'  => 'text',
				'instructions' => 'Free text as shown on the article, e.g. "April 23–26, 2026".',
			),
			array(
				'key'            => 'field_cz_event_start',
				'label'          => 'Event Start',
				'name'           => 'event_start',
				'type'           => 'date_picker',
				'display_format' => 'd/m/Y',
				'return_format'  => 'Ymd',
				'instructions'   => 'Used for sorting and the homepage countdown. Required whenever Event Date Display is set.',
			),
			array(
				'key'            => 'field_cz_event_end',
				'label'          => 'Event End',
				'name'           => 'event_end',
				'type'           => 'date_picker',
				'display_format' => 'd/m/Y',
				'return_format'  => 'Ymd',
			),
			array(
				'key'   => 'field_cz_event_location',
				'label' => 'Event Location',
				'name'  => 'event_location',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_cz_event_link',
				'label' => 'Event Link',
				'name'  => 'event_link',
				'type'  => 'url',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'cz_news',
				),
			),
		),
	) );
} );
