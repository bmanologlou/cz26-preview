<?php
/**
 * Template: single cz_news article.
 * Ported from _article_template.html's <article> markup (article-hero /
 * article-image / article-body / article-event-info / article-back).
 *
 * Fixes 2 upstream bugs silently (see SCHEMA.md "Known upstream bugs"):
 *  - ARTICLE_CATS was computed in generate-news.py but the placeholder
 *    string never actually appeared in _article_template.html, so category
 *    badges were dead code and never rendered anywhere. Wired up for real
 *    here as .article-cat badges in the article-hero, using the same
 *    label map (events => "Event", news => "News", innovation =>
 *    "Innovation") generate-news.py used.
 *  - The source required a separately-typed date_display string per
 *    article. Here the display date is always derived from the real
 *    post_date via get_the_date(), no separate field needed.
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$cz_cat_labels = cz_news_category_labels();
	$cz_terms      = get_the_terms( get_the_ID(), 'cz_news_category' );

	$cz_event_date_display = get_field( 'event_date_display' );
	$cz_event_location     = get_field( 'event_location' );
	$cz_event_link         = get_field( 'event_link' );
	?>

	<article>
		<div class="article-wrap">

			<div class="article-hero">
				<div class="article-meta"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></div>
				<h1 class="article-title"><?php the_title(); ?></h1>
				<?php if ( $cz_terms && ! is_wp_error( $cz_terms ) && ! empty( $cz_terms ) ) : ?>
					<div class="article-cats">
						<?php foreach ( $cz_terms as $cz_term ) :
							$cz_label = isset( $cz_cat_labels[ $cz_term->slug ] ) ? $cz_cat_labels[ $cz_term->slug ] : $cz_term->name;
							?>
							<span class="article-cat"><?php echo esc_html( $cz_label ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="article-image">
					<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
				</div>
			<?php endif; ?>

			<div class="article-body">
				<?php the_content(); ?>
			</div>

			<?php if ( ! empty( $cz_event_date_display ) ) : ?>
				<div class="article-event-info">
					<div class="event-card">
						<div class="event-field">
							<label>Date</label>
							<span><?php echo esc_html( $cz_event_date_display ); ?></span>
						</div>
						<div class="event-field">
							<label>Location</label>
							<span><?php echo esc_html( $cz_event_location ); ?></span>
						</div>
						<?php if ( ! empty( $cz_event_link ) ) : ?>
							<div class="event-link">
								<a href="<?php echo esc_url( $cz_event_link ); ?>" target="_blank" rel="noopener">Visit Exhibition Website</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="article-back">
				<a href="<?php echo esc_url( cz_page_url( 'news' ) ); ?>">← Back to News &amp; Events</a>
			</div>

		</div>
	</article>

	<?php
endwhile;

get_footer();
