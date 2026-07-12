<?php
/**
 * The main template file — WordPress's required fallback, used any time a
 * more specific template (front-page.php, page-{slug}.php, single-cz_*.php)
 * doesn't match the current request. Every real page in this site is
 * covered by one of those more specific templates; this exists so the
 * theme is valid and so anything unexpected (e.g. the default posts
 * archive, a search result, a 404) still renders inside the site's nav/
 * footer chrome instead of a blank or broken page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div style="max-width:1440px;margin:calc(var(--nav-h) + 64px) auto 96px;padding:0 80px;min-height:40vh;">

	<?php if ( have_posts() ) : ?>

		<?php if ( is_search() ) : ?>
			<h1 class="pdp-sec-title" style="margin-bottom:32px;">Search Results</h1>
		<?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
		<article <?php post_class( 'article-back' ); ?> style="margin-bottom:32px;">
			<h2><a href="<?php the_permalink(); ?>" style="color:var(--white);text-decoration:none;"><?php the_title(); ?></a></h2>
			<div style="color:rgba(245,243,239,.6);"><?php the_excerpt(); ?></div>
		</article>
			<?php
		endwhile;
		?>

		<?php the_posts_pagination(); ?>

	<?php else : ?>

		<h1 class="pdp-sec-title">Nothing found</h1>
		<p style="color:rgba(245,243,239,.6);">The page you're looking for doesn't exist.</p>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
