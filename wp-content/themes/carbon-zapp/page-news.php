<?php
/**
 * Template: News & Events listing (page slug "news").
 * Ported from cznews.html — filter bar, dynamic hero copy, news list.
 *
 * All published cz_news posts are rendered server-side (newest first) as
 * .news-row elements carrying a single data-cat (see
 * cz_news_primary_category() in inc/cpt-news.php for how that's chosen
 * when a post has multiple categories). The ?filter= URL param pre-selects
 * a filter-btn and pre-hides non-matching rows server-side so the page
 * lands already filtered with no flash of unfiltered content; from there
 * assets/js/news-filter.js takes over show/hide + live count + hero copy
 * swapping without a reload.
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Same copy as the source's titleMap (cznews.html inline script) — swapped
// per active filter for both the hero and (via news-filter.js) on click.
$cz_news_title_map = array(
	'all'        => array(
		'eyebrow' => 'Latest Updates',
		'title'   => 'News &amp; Events',
	),
	'events'     => array(
		'eyebrow' => 'Upcoming &amp; Past',
		'title'   => 'Events Calendar',
	),
	'news'       => array(
		'eyebrow' => 'Press &amp; Updates',
		'title'   => 'Latest News',
	),
	'innovation' => array(
		'eyebrow' => 'R&amp;D &amp; Technology',
		'title'   => 'CZ Innovations',
	),
);

$cz_news_cat_labels = cz_news_category_labels();

$cz_active_filter = isset( $_GET['filter'] ) ? sanitize_key( wp_unslash( $_GET['filter'] ) ) : 'all';
if ( ! isset( $cz_news_title_map[ $cz_active_filter ] ) ) {
	$cz_active_filter = 'all';
}

$cz_news_query = new WP_Query( array(
	'post_type'      => 'cz_news',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
) );

$cz_news_rows = array();

if ( $cz_news_query->have_posts() ) {
	while ( $cz_news_query->have_posts() ) {
		$cz_news_query->the_post();

		$cz_primary_cat = cz_news_primary_category( get_the_ID() );

		$cz_news_rows[] = array(
			'permalink' => get_permalink(),
			'title'     => get_the_title(),
			'date'      => get_the_date( 'd M Y' ),
			'primary'   => $cz_primary_cat,
			'thumb'     => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
		);
	}
	wp_reset_postdata();
}

$cz_visible_count = 0;
foreach ( $cz_news_rows as $cz_row ) {
	if ( 'all' === $cz_active_filter || $cz_row['primary'] === $cz_active_filter ) {
		$cz_visible_count++;
	}
}
?>

<!-- STICKY FILTER BAR -->
<div class="filter-bar">
	<div class="filter-bar-row">
		<div class="filter-group">
			<button class="filter-btn<?php echo 'all' === $cz_active_filter ? ' active' : ''; ?>" data-cat="all">All</button>
			<div class="filter-sep"></div>
			<button class="filter-btn<?php echo 'events' === $cz_active_filter ? ' active' : ''; ?>" data-cat="events">Events</button>
			<div class="filter-sep"></div>
			<button class="filter-btn<?php echo 'news' === $cz_active_filter ? ' active' : ''; ?>" data-cat="news">News</button>
			<div class="filter-sep"></div>
			<button class="filter-btn<?php echo 'innovation' === $cz_active_filter ? ' active' : ''; ?>" data-cat="innovation">Innovation</button>
		</div>
		<div class="filter-count" id="news-count"><?php echo esc_html( $cz_visible_count . ' article' . ( 1 !== $cz_visible_count ? 's' : '' ) ); ?></div>
	</div>
</div>

<!-- NEWS HEADER -->
<div class="news-hero-wrap">
	<div class="news-hero">
		<div class="news-hero-left">
			<div class="news-hero-eyebrow" id="news-eyebrow"><?php echo $cz_news_title_map[ $cz_active_filter ]['eyebrow']; // phpcs:ignore -- trusted static copy, contains &amp; entities ?></div>
			<h1 class="news-hero-title" id="news-title"><?php echo $cz_news_title_map[ $cz_active_filter ]['title']; // phpcs:ignore -- trusted static copy, contains &amp; entities ?></h1>
			<p class="news-hero-desc">Stay up to date with the latest product releases, industry events, and technology innovations from Carbon Zapp.</p>
		</div>
		<div class="news-hero-right">
			<img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/cz_hero_news_b.webp' ); ?>" alt="News &amp; Events" class="news-hero-image">
		</div>
	</div>
</div>

<!-- NEWS LIST -->
<div class="news-list">
	<div class="news-list-inner" id="news-list">
		<?php foreach ( $cz_news_rows as $cz_row ) :
			$cz_label   = isset( $cz_news_cat_labels[ $cz_row['primary'] ] ) ? $cz_news_cat_labels[ $cz_row['primary'] ] : $cz_row['primary'];
			$cz_matches = ( 'all' === $cz_active_filter || $cz_row['primary'] === $cz_active_filter );
			?>
			<a href="<?php echo esc_url( $cz_row['permalink'] ); ?>" class="news-row<?php echo $cz_matches ? '' : ' hidden'; ?>" data-cat="<?php echo esc_attr( $cz_row['primary'] ); ?>" data-preview="<?php echo esc_url( $cz_row['thumb'] ); ?>">
				<div class="news-cat" data-filter="<?php echo esc_attr( $cz_row['primary'] ); ?>"><?php echo esc_html( $cz_label ); ?></div>
				<div class="news-date"><?php echo esc_html( $cz_row['date'] ); ?></div>
				<div class="news-headline"><?php echo esc_html( $cz_row['title'] ); ?></div>
				<div class="news-arrow-box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></div>
			</a>
		<?php endforeach; ?>
	</div>
</div>

<?php get_footer(); ?>
