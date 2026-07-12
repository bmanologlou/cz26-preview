/**
 * Carbon Zapp — global site behaviour.
 *
 * Ported from components.js, adapted for WordPress:
 *  - setActiveNav() is dropped — the primary nav is server-rendered with
 *    active-state classes already computed (see inc/nav-menus.php
 *    cz_nav_fallback() / wp_nav_menu() active classes in template-parts/header.php).
 *  - The fetch()-based component-injection system (inject/loadComponents) is
 *    dropped — WP renders the nav/footer via get_template_part() server-side,
 *    no client-side includes needed.
 *  - initLoginDropdown() is dropped — dead code in the source, targets
 *    .login-btn/.login-dropdown markup that doesn't exist anywhere on the
 *    site.
 *  - The 3 separate inline newsletter handlers in the source (footer strip,
 *    mobile drawer, per-page inline scripts) are consolidated into one
 *    fetch()-based AJAX submit handler that POSTs to czAjax.url
 *    (admin-ajax.php, action=cz_newsletter_signup) using the nonce localized
 *    in inc/enqueue.php. It binds to any <form data-msg-target="..."> found
 *    on the page (currently: #nl-strip-form in template-parts/footer.php and
 *    #nl-drawer-form in template-parts/newsletter-drawer.php).
 *
 * Kept from the source: nav scroll class toggle (.scrolled past 80px, which
 * swaps the brandmark/logo SVG visibility via the nav.scrolled .cz-logo-svg /
 * .cz-brandmark-svg opacity rules in CSS) and the newsletter drawer
 * open/close UX (mobile button opens it, close button / overlay click /
 * Escape key close it).
 *
 * initMobileNav() replaces the inline onclick handlers the source used on
 * #nav-hamburger / .nav-mobile-menu links with delegated listeners, same
 * open/close/nl-drawer-guard behaviour.
 */

(function () {
	'use strict';

	var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	/* ── Nav scroll behaviour ── */
	function initNavScroll() {
		var nav = document.querySelector( 'nav' );
		if ( ! nav ) {
			return;
		}
		function onScroll() {
			nav.classList.toggle( 'scrolled', window.scrollY > 80 );
		}
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	/* ── Mobile nav (hamburger + slide-out menu) ── */
	function initMobileNav() {
		var hamburger = document.getElementById( 'nav-hamburger' );
		var menu = document.getElementById( 'nav-mobile-menu' );
		if ( ! hamburger || ! menu ) {
			return;
		}

		function closeMobileNav() {
			menu.classList.remove( 'open' );
			hamburger.classList.remove( 'open' );
			hamburger.setAttribute( 'aria-expanded', 'false' );
			document.body.classList.remove( 'nav-open' );
		}

		function toggleMobileNav() {
			// If the newsletter drawer is open, the hamburger's first tap
			// closes that instead of opening the nav (mirrors the source's
			// nl-drawer-open guard so the two overlays never stack).
			if ( document.body.classList.contains( 'nl-drawer-open' ) ) {
				document.body.classList.remove( 'nl-drawer-open' );
				document.documentElement.classList.remove( 'nl-drawer-open' );
				document.documentElement.style.overflow = '';
				return;
			}
			var open = menu.classList.toggle( 'open' );
			hamburger.classList.toggle( 'open', open );
			hamburger.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			document.body.classList.toggle( 'nav-open', open );
		}

		hamburger.addEventListener( 'click', toggleMobileNav );
		hamburger.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				toggleMobileNav();
			}
		} );

		menu.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', closeMobileNav );
		} );

		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) {
				closeMobileNav();
			}
		} );
	}

	/* ── Newsletter drawer open/close ── */
	function initNewsletterDrawer() {
		function openNewsletterDrawer() {
			document.body.classList.add( 'nl-drawer-open' );
			document.documentElement.classList.add( 'nl-drawer-open' );
			document.documentElement.style.overflow = 'hidden';
		}

		function closeNewsletterDrawer() {
			document.body.classList.remove( 'nl-drawer-open' );
			document.documentElement.classList.remove( 'nl-drawer-open' );
			document.documentElement.style.overflow = '';
		}

		var newsletterBtn = document.getElementById( 'nl-btn-mobile' );
		if ( newsletterBtn ) {
			newsletterBtn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				e.stopPropagation();
				openNewsletterDrawer();
			} );
		}

		var drawerClose = document.getElementById( 'nl-drawer-close' );
		if ( drawerClose ) {
			drawerClose.addEventListener( 'click', closeNewsletterDrawer );
		}

		var drawerOverlay = document.getElementById( 'nl-drawer-overlay' );
		if ( drawerOverlay ) {
			drawerOverlay.addEventListener( 'click', closeNewsletterDrawer );
		}

		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) {
				closeNewsletterDrawer();
			}
		} );

		/* Live-validate the drawer email field to enable/disable submit
		   (replaces the source's inline oninput handler). */
		var drawerEmail = document.getElementById( 'nl-email' );
		var drawerSubmit = document.getElementById( 'nl-sub-btn' );
		if ( drawerEmail && drawerSubmit ) {
			drawerEmail.addEventListener( 'input', function () {
				drawerSubmit.disabled = ! EMAIL_RE.test( drawerEmail.value );
			} );
		}
	}

	/* ── Newsletter AJAX submit (shared by every newsletter form) ── */
	function showMessage( el, text, isError ) {
		if ( ! el ) {
			return;
		}
		el.textContent = text;
		el.style.color = isError ? '#ED1C24' : 'rgba(245,243,239,.6)';
		el.style.display = 'block';
		el.style.opacity = '1';
		window.clearTimeout( el._czHideTimer );
		el._czHideTimer = window.setTimeout( function () {
			el.style.opacity = '0';
			window.setTimeout( function () {
				el.style.display = 'none';
				el.style.opacity = '1';
			}, 600 );
		}, 3000 );
	}

	function handleNewsletterSubmit( form ) {
		form.addEventListener( 'submit', function ( e ) {
			e.preventDefault();

			var emailInput = form.querySelector( 'input[type="email"]' );
			var submitBtn = form.querySelector( 'button[type="submit"], button:not([type])' );
			var msgEl = document.getElementById( form.getAttribute( 'data-msg-target' ) || '' );
			var email = emailInput ? emailInput.value.trim() : '';

			if ( ! EMAIL_RE.test( email ) ) {
				showMessage( msgEl, 'Please enter a valid email address.', true );
				return;
			}

			if ( typeof window.czAjax === 'undefined' ) {
				showMessage( msgEl, 'Something went wrong. Please try again later.', true );
				return;
			}

			var wasDisabled = submitBtn ? submitBtn.disabled : false;
			if ( submitBtn ) {
				submitBtn.disabled = true;
			}

			var body = new URLSearchParams();
			body.set( 'action', 'cz_newsletter_signup' );
			body.set( 'email', email );
			body.set( 'nonce', window.czAjax.nonce );

			fetch( window.czAjax.url, {
				method: 'POST',
				credentials: 'same-origin',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: body.toString(),
			} )
				.then( function ( r ) {
					return r.json().then( function ( json ) {
						return { ok: r.ok, json: json };
					} );
				} )
				.then( function ( result ) {
					var message = result.json && result.json.data && result.json.data.message
						? result.json.data.message
						: ( result.ok ? 'Thanks for subscribing.' : 'Something went wrong. Please try again later.' );

					if ( result.ok && result.json.success ) {
						showMessage( msgEl, message, false );
						if ( emailInput ) {
							emailInput.value = '';
						}
						if ( submitBtn ) {
							submitBtn.disabled = true;
						}
					} else {
						showMessage( msgEl, message, true );
						if ( submitBtn ) {
							submitBtn.disabled = wasDisabled;
						}
					}
				} )
				.catch( function () {
					showMessage( msgEl, 'An error occurred. Please try again.', true );
					if ( submitBtn ) {
						submitBtn.disabled = wasDisabled;
					}
				} );
		} );
	}

	function initNewsletterForms() {
		var forms = document.querySelectorAll( 'form[data-msg-target]' );
		forms.forEach( function ( form ) {
			handleNewsletterSubmit( form );
		} );
	}

	function init() {
		initNavScroll();
		initMobileNav();
		initNewsletterDrawer();
		initNewsletterForms();
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
