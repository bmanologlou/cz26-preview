/**
 * Drag-and-drop reordering for the Products (cz_product) admin list table.
 * Requires jquery-ui-sortable; localized data comes from czProductOrder
 * (inc/product-order.php cz_product_order_admin_assets()).
 */
( function ( $ ) {
	'use strict';

	$( function () {
		var $list = $( '#the-list' );
		if ( ! $list.length || typeof czProductOrder === 'undefined' ) {
			return;
		}

		var saving = false;

		$list.sortable( {
			items: 'tr',
			handle: '.cz-sort-handle',
			axis: 'y',
			cursor: 'move',
			opacity: 0.7,
			helper: function ( e, tr ) {
				tr.children().each( function () {
					$( this ).width( $( this ).width() );
				} );
				return tr;
			},
			start: function ( e, ui ) {
				ui.item.addClass( 'cz-order-dragging' );
			},
			stop: function ( e, ui ) {
				ui.item.removeClass( 'cz-order-dragging' );
			},
			update: function () {
				if ( saving ) {
					return;
				}
				saving = true;

				var ids = $list.children( 'tr' ).map( function () {
					return $( this ).find( '.cz-sort-handle' ).data( 'id' );
				} ).get();

				$.post( czProductOrder.ajaxUrl, {
					action: 'cz_reorder_products',
					nonce: czProductOrder.nonce,
					order: ids,
				} ).always( function () {
					saving = false;
				} );
			},
		} );
	} );
} )( jQuery );
