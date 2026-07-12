<?php
/**
 * Generic Page template — used for any WP Page that isn't one of the 5
 * template-driven pages (page-solutions.php, page-innovation.php,
 * page-cloudx.php, page-news.php, page-contact.php), e.g. a Privacy
 * Policy or Terms page the site owner adds later through wp-admin.
 * Renders the editor content inside the same nav/footer chrome and a
 * simple hero-style title band matching the site's page-hero pattern.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="page-hero-wrap">
	<div class="page-hero">
		<div class="page-hero-eyebrow">Carbon Zapp</div>
		<h1 class="page-hero-title"><?php the_title(); ?></h1>
	</div>
</div>

<div style="max-width:1024px;margin:0 auto;padding:48px 80px 96px;color:rgba(245,243,239,.8);font-size:16px;line-height:1.75;">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
