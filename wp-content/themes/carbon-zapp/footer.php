<?php
/**
 * The footer for our theme.
 *
 * This is the WP-required template entry point. The actual footer markup
 * lives in template-parts/footer-cta.php, template-parts/footer.php and
 * template-parts/newsletter-drawer.php (ported from _footer-cta.html,
 * _footer.html and _newsletter-drawer.html).
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
get_template_part( 'template-parts/footer-cta' );
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/newsletter-drawer' );
?>

<?php wp_footer(); ?>
</body>
</html>
