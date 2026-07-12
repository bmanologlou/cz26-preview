/**
 * Carbon Zapp — homepage "Next Appearance" event card rotation + countdown
 * + mobile repositioning.
 *
 * Ported from index.html's inline events-rotator script. Only enqueued on
 * is_front_page() (see inc/enqueue.php). Front-page.php already
 * server-renders every upcoming event as a fully-formed slide (name, venue,
 * dates, link are all real markup, not client-templated) — this script only
 * handles rotation between slides and the two pieces of state that are
 * inherently "live" (change with the current date/time): the countdown text
 * and the "Next Appearance"/"Now On"/"Recent Event" label. It also moves the
 * card out of the hero and into a plain block right below it at small-mobile
 * widths (same behaviour and ≤480px breakpoint as the source site — see
 * assets/css/responsive-style.css's `#after-hero-event` rules), since the
 * absolutely-positioned overlay card doesn't have room over the hero image
 * on narrow screens.
 *
 * Markup/data-attribute contract (matches what front-page.php already
 * outputs — keep the two in sync if either changes):
 *
 *   <div class="hero-event" id="hero-event-card">   (omitted entirely when there are no upcoming events)
 *     <div class="hero-event-label" id="hero-event-label">Next Appearance</div>
 *
 *     <a class="hero-event-body hero-event-slide is-active"
 *        href="{permalink}"
 *        data-event-start="20260601"   (ACF event_start, Ymd)
 *        data-event-end="20260605">    (ACF event_end, Ymd — falls back to event_start when empty)
 *       <div class="hero-event-date">
 *         <div class="hero-event-date-val">{event_date_display}</div>
 *         <div class="hero-event-countdown"></div>  <!-- left empty server-side; this script fills it in -->
 *       </div>
 *       <div class="hero-event-name">{title}</div>
 *       <div class="hero-event-location"><svg>...</svg><span>{event_location}</span></div>
 *       <div class="hero-event-action">...</div>
 *     </a>
 *     <!-- one .hero-event-slide per upcoming event (up to 5), ascending
 *          event_start order; only the first carries "is-active" and is
 *          visible, the rest carry inline style="display:none" -->
 *
 *     <div class="hero-event-nav">
 *       <div class="hero-event-dots" id="hero-event-dots">
 *         <button type="button" class="dot active" data-slide-index="0" aria-label="Show event 1"></button>
 *         <!-- one per slide, same order, first has class "active" -->
 *       </div>
 *       <a href="..." class="hero-event-all">All Events</a>
 *     </div>
 *   </div>
 *
 * On rotation this script toggles "is-active" + the inline display style on
 * .hero-event-slide together, and "active" on the matching .dot.
 */

( function () {
	'use strict';

	function parseYmd( str ) {
		if ( ! str || str.length < 8 ) {
			return null;
		}
		return {
			y: parseInt( str.slice( 0, 4 ), 10 ),
			m: parseInt( str.slice( 4, 6 ), 10 ) - 1,
			d: parseInt( str.slice( 6, 8 ), 10 ),
		};
	}

	function startEndDates( startStr, endStr ) {
		var s = parseYmd( startStr );
		if ( ! s ) {
			return null;
		}
		var e = parseYmd( endStr ) || s;
		return {
			start: new Date( s.y, s.m, s.d, 0, 0, 0 ),
			end: new Date( e.y, e.m, e.d, 23, 59, 59 ),
		};
	}

	function daysUntil( startStr, endStr ) {
		var range = startEndDates( startStr, endStr );
		if ( ! range ) {
			return '';
		}
		var now = new Date();
		if ( now >= range.start && now <= range.end ) {
			return 'On now';
		}
		var diff = Math.ceil( ( range.start - now ) / ( 1000 * 60 * 60 * 24 ) );
		if ( diff === 0 ) {
			return 'Today';
		}
		if ( diff > 0 && diff <= 60 ) {
			return diff + ' days';
		}
		if ( diff > 60 ) {
			return '~' + Math.round( diff / 30 ) + ' months';
		}
		return '';
	}

	function labelFor( startStr, endStr ) {
		var range = startEndDates( startStr, endStr );
		if ( ! range ) {
			return 'Next Appearance';
		}
		var now = new Date();
		if ( now >= range.start && now <= range.end ) {
			return 'Now On';
		}
		if ( now > range.end ) {
			return 'Recent Event';
		}
		return 'Next Appearance';
	}

	function initHeroEvents() {
		var card = document.getElementById( 'hero-event-card' );
		if ( ! card ) {
			return;
		}

		var slides = Array.prototype.slice.call( card.querySelectorAll( '.hero-event-slide' ) );
		if ( ! slides.length ) {
			return;
		}

		var dotsContainer = document.getElementById( 'hero-event-dots' );
		var dots = dotsContainer ? Array.prototype.slice.call( dotsContainer.querySelectorAll( '.dot' ) ) : [];
		var labelEl = document.getElementById( 'hero-event-label' );

		var current = 0;
		slides.forEach( function ( slide, i ) {
			if ( slide.classList.contains( 'is-active' ) ) {
				current = i;
			}
		} );

		var timer = null;

		function updateLiveState( idx ) {
			var slide = slides[ idx ];
			var start = slide.getAttribute( 'data-event-start' );
			var end = slide.getAttribute( 'data-event-end' );
			var countdownEl = slide.querySelector( '.hero-event-countdown' );
			if ( countdownEl ) {
				countdownEl.textContent = daysUntil( start, end );
			}
			if ( labelEl ) {
				labelEl.textContent = labelFor( start, end );
			}
		}

		function showSlide( idx ) {
			current = ( idx + slides.length ) % slides.length;
			slides.forEach( function ( slide, i ) {
				var active = i === current;
				slide.classList.toggle( 'is-active', active );
				slide.style.display = active ? '' : 'none';
			} );
			dots.forEach( function ( dot, i ) {
				dot.classList.toggle( 'active', i === current );
			} );
			updateLiveState( current );
		}

		function next() {
			showSlide( current + 1 );
		}

		function prev() {
			showSlide( current - 1 );
		}

		function resetTimer() {
			if ( timer ) {
				window.clearInterval( timer );
			}
			if ( slides.length > 1 ) {
				timer = window.setInterval( next, 4500 );
			}
		}

		dots.forEach( function ( dot, i ) {
			dot.addEventListener( 'click', function () {
				showSlide( i );
				resetTimer();
			} );
		} );

		/* Swipe support, mirrors the source's touch handling. */
		var touchStartX = 0;
		var touchStartY = 0;
		card.addEventListener( 'touchstart', function ( e ) {
			touchStartX = e.changedTouches[ 0 ].clientX;
			touchStartY = e.changedTouches[ 0 ].clientY;
		}, { passive: true } );
		card.addEventListener( 'touchend', function ( e ) {
			var dx = e.changedTouches[ 0 ].clientX - touchStartX;
			var dy = e.changedTouches[ 0 ].clientY - touchStartY;
			if ( Math.abs( dx ) > Math.abs( dy ) && Math.abs( dx ) > 40 ) {
				if ( dx < 0 ) {
					next();
				} else {
					prev();
				}
				resetTimer();
			}
		}, { passive: true } );

		/* Paint the live countdown/label for the server-selected active
		   slide (normally index 0), then start rotating. */
		showSlide( current );
		resetTimer();
	}

	function moveEventPanel() {
		var panel = document.getElementById( 'hero-event-card' );
		var hero = document.querySelector( '.hero' );
		if ( ! panel || ! hero ) {
			return;
		}
		var afterHero = document.getElementById( 'after-hero-event' );

		if ( window.innerWidth <= 480 ) {
			if ( ! afterHero ) {
				var wrap = document.createElement( 'div' );
				wrap.id = 'after-hero-event';
				hero.parentNode.insertBefore( wrap, hero.nextSibling );
				wrap.appendChild( panel );
			}
		} else if ( afterHero && panel.parentNode === afterHero ) {
			hero.appendChild( panel );
			afterHero.parentNode.removeChild( afterHero );
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initHeroEvents );
	} else {
		initHeroEvents();
	}

	moveEventPanel();
	window.addEventListener( 'resize', moveEventPanel );
} )();
