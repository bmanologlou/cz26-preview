/**
 * Carbon Zapp — product detail page hero image slider.
 *
 * Ported from the inline script driving #pdp-hero-slider /
 * .pdp-hero-slide.active in product-ltbrx.html. Only enqueued on
 * is_singular( 'cz_product' ) (see inc/enqueue.php); nav-scroll and
 * newsletter-drawer behaviour already live in assets/js/main.js (enqueued on
 * every page) so they are intentionally not duplicated here.
 *
 * Markup contract (single-cz_product.php):
 *   <div class="pdp-hero" id="pdp-hero-slider">
 *     <div class="pdp-hero-slide active" style="background-image:url('...');"></div>
 *     <div class="pdp-hero-slide" style="background-image:url('...');"></div>
 *     ... (2 slides on simple products, 4 on flagship products)
 *     <button class="pdp-hero-arrow pdp-hero-prev" id="hero-prev" aria-label="Previous">...</button>
 *     <button class="pdp-hero-arrow pdp-hero-next" id="hero-next" aria-label="Next">...</button>
 *   </div>
 * Works against however many .pdp-hero-slide elements are present; if there
 * is only one (or zero) it renders the single slide and never auto-rotates.
 */

( function () {
	'use strict';

	function initHeroSlider() {
		var slides = Array.prototype.slice.call( document.querySelectorAll( '.pdp-hero-slide' ) );
		if ( ! slides.length ) {
			return;
		}

		var prev = document.getElementById( 'hero-prev' );
		var next = document.getElementById( 'hero-next' );
		var current = 0;
		var sliderTimer = null;

		function showSlide( index ) {
			current = ( index + slides.length ) % slides.length;
			slides.forEach( function ( slide, i ) {
				slide.classList.toggle( 'active', i === current );
			} );
		}

		function restartSlider() {
			if ( sliderTimer ) {
				window.clearInterval( sliderTimer );
			}
			if ( slides.length > 1 ) {
				sliderTimer = window.setInterval( function () {
					showSlide( current + 1 );
				}, 5200 );
			}
		}

		if ( prev ) {
			prev.addEventListener( 'click', function () {
				showSlide( current - 1 );
				restartSlider();
			} );
		}

		if ( next ) {
			next.addEventListener( 'click', function () {
				showSlide( current + 1 );
				restartSlider();
			} );
		}

		showSlide( 0 );
		restartSlider();
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initHeroSlider );
	} else {
		initHeroSlider();
	}
} )();
