/**
 * News & Events filter bar (page-news.php).
 *
 * Client-side show/hide-by-category + live count + hero copy swap,
 * operating purely on the server-rendered markup — no fetch/AJAX. Ported
 * from cznews.html's inline filter script, adapted so it filters existing
 * DOM rows (via .hidden) instead of re-rendering them from a news.json
 * array, since WordPress already server-renders every row with a single
 * primary data-cat.
 *
 * Contract:
 *   .filter-btn[data-cat]       — filter bar buttons ("all"/"events"/"news"/"innovation")
 *   .news-row[data-cat]         — one per cz_news post, .hidden toggles visibility
 *   .news-row .news-cat[data-filter] — clicking the category label also filters
 *   #news-count                 — live "N articles" label
 *   #news-eyebrow, #news-title  — hero copy, swapped per titleMap below
 *
 * The server has already pre-selected the active filter and pre-hidden
 * non-matching rows based on ?filter=, so this script only needs to react
 * to further clicks.
 */
( function () {
	'use strict';

	var countEl   = document.getElementById( 'news-count' );
	var titleEl   = document.getElementById( 'news-title' );
	var eyebrowEl = document.getElementById( 'news-eyebrow' );
	var rows      = document.querySelectorAll( '.news-row[data-cat]' );
	var buttons   = document.querySelectorAll( '.filter-btn[data-cat]' );

	if ( ! rows.length && ! buttons.length ) {
		return;
	}

	// Matches the titleMap in page-news.php exactly.
	var titleMap = {
		all:        { eyebrow: 'Latest Updates',       title: 'News &amp; Events' },
		events:     { eyebrow: 'Upcoming &amp; Past',  title: 'Events Calendar' },
		news:       { eyebrow: 'Press &amp; Updates',  title: 'Latest News' },
		innovation: { eyebrow: 'R&amp;D &amp; Technology', title: 'CZ Innovations' }
	};

	function applyFilter( cat ) {
		var count = 0;

		Array.prototype.forEach.call( rows, function ( row ) {
			var matches = cat === 'all' || row.getAttribute( 'data-cat' ) === cat;
			row.classList.toggle( 'hidden', ! matches );
			if ( matches ) {
				count++;
			}
		} );

		Array.prototype.forEach.call( buttons, function ( btn ) {
			btn.classList.toggle( 'active', btn.getAttribute( 'data-cat' ) === cat );
		} );

		if ( countEl ) {
			countEl.textContent = count + ' article' + ( 1 !== count ? 's' : '' );
		}

		if ( titleMap[ cat ] ) {
			if ( titleEl ) {
				titleEl.innerHTML = titleMap[ cat ].title;
			}
			if ( eyebrowEl ) {
				eyebrowEl.innerHTML = titleMap[ cat ].eyebrow;
			}
		}
	}

	Array.prototype.forEach.call( buttons, function ( btn ) {
		btn.addEventListener( 'click', function () {
			applyFilter( btn.getAttribute( 'data-cat' ) );
		} );
	} );

	// Clicking a row's category label filters to that category too,
	// matching the source site's behaviour.
	Array.prototype.forEach.call( rows, function ( row ) {
		var catEl = row.querySelector( '.news-cat[data-filter]' );
		if ( catEl ) {
			catEl.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				applyFilter( catEl.getAttribute( 'data-filter' ) );
			} );
		}
	} );
} )();
