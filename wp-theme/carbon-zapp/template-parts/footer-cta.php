<?php
/**
 * Footer CTA band ("Ready to move forward?").
 *
 * Ported from _footer-cta.html.
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="footer-cta">
  <div class="footer-cta-inner">
    <div>
      <h2 class="footer-cta-title">READY TO <br> MOVE <span>FORWARD?</span></h2>
      <p class="footer-cta-sub">Find the right system for your operation or connect with an authorized representative in your region.</p>
    </div>
    <div class="footer-cta-actions">
      <a href="<?php echo esc_url( cz_page_url( 'solutions' ) ); ?>" class="btn-primary">Explore Solutions</a>
      <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_GLOBAL_REPR.pdf' ); ?>" target="_blank" rel="noopener" class="link-arrow">Find a Distributor →</a>
    </div>
  </div>
</section>
