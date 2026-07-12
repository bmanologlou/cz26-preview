<?php
/**
 * Single template for the `cz_product` CPT — replaces the 18 static
 * product-{slug}.html files. Renders the ACF field schema documented in
 * wp-theme/SCHEMA.md / inc/acf-fields.php:
 *   hero_slides (repeater) → .pdp-hero slider
 *   category_label / tagline / key_capabilities / intro_disclaimer /
 *     product_details_url / brochure_pdf → .pdp-intro
 *   sections (flexible_content: content_block | cards_block) → body
 *
 * cards_block wrapper choice: eyebrow === "Testing Capabilities" renders
 * the .pdp-caps/.pdp-caps-grid/.pdp-cap (numbered) markup seen in
 * product-ltbrx.html; every other cards_block (Hardware Engineering,
 * Diagnostic Intelligence, or any future section) renders the
 * .pdp-adv/.pdp-adv-grid/.pdp-adv-card (coded) markup — matching the
 * source 1:1 for Testing Capabilities while consolidating the source's
 * own inconsistent wrapper class for Hardware Engineering (it used
 * .pdp-overview in the static HTML by copy-paste accident, even though
 * its card markup and CSS are identical to Diagnostic Intelligence's
 * .pdp-adv) onto the single .pdp-adv pattern the task brief specifies.
 *
 * Source: product-ctbrx.html (simple) + product-ltbrx.html (flagship).
 */

get_header();

$cz_details_url = get_field( 'product_details_url' );
$cz_brochure    = get_field( 'brochure_pdf' );
$cz_disclaimer  = get_field( 'intro_disclaimer' );
?>

<!-- HERO SLIDER -->
<div class="pdp-hero" id="pdp-hero-slider">
  <?php
  if ( have_rows( 'hero_slides' ) ) :
      $cz_slide_i = 0;
      while ( have_rows( 'hero_slides' ) ) :
          the_row();
          $cz_slide_i++;
          $cz_slide_img = get_sub_field( 'image' );
          if ( ! $cz_slide_img ) {
              continue;
          }
          ?>
  <div class="pdp-hero-slide<?php echo ( 1 === $cz_slide_i ) ? ' active' : ''; ?>" style="background-image:url('<?php echo esc_url( $cz_slide_img['url'] ); ?>');"></div>
          <?php
      endwhile;
  endif;
  ?>
  <button class="pdp-hero-arrow pdp-hero-prev" id="hero-prev" aria-label="Previous">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <button class="pdp-hero-arrow pdp-hero-next" id="hero-next" aria-label="Next">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>
</div>

<div class="pdp-body">

<!-- ══ INTRO ══ -->
<div class="pdp-intro">
  <div class="pdp-intro-inner">
    <div>
      <div class="pdp-intro-category"><?php the_field( 'category_label' ); ?></div>
      <div class="pdp-intro-name"><?php the_title(); ?></div>
      <p class="pdp-intro-tagline"><?php the_field( 'tagline' ); ?></p>
    </div>
    <div style="padding-top:40px;">
      <?php if ( have_rows( 'key_capabilities' ) ) : ?>
      <div class="pdp-highlights">
        <?php
        while ( have_rows( 'key_capabilities' ) ) :
            the_row();
            $cz_hl_text = get_sub_field( 'text' );
            if ( ! $cz_hl_text ) {
                continue;
            }
            ?>
        <div class="pdp-hl"><div class="pdp-hl-dot"></div><div class="pdp-hl-text"><?php echo esc_html( $cz_hl_text ); ?></div></div>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if ( $cz_disclaimer ) : ?>
  <div style="max-width:1440px;margin:0 auto;padding:0 80px;">
    <p style="max-width:760px;font-size:13px;font-weight:300;line-height:1.7;color:var(--text-light);opacity:.6;">
      <?php echo esc_html( $cz_disclaimer ); ?>
    </p>
  </div>
  <?php endif; ?>
  <div style="max-width:1440px;margin:0 auto;padding:40px 80px 56px;">
    <div class="pdp-intro-ctas">
      <?php if ( $cz_details_url ) : ?>
      <a href="<?php echo esc_url( $cz_details_url ); ?>" target="_blank" rel="noopener" class="btn-primary">View Product Details</a>
      <?php endif; ?>
      <?php if ( ! empty( $cz_brochure['url'] ) ) : ?>
      <a href="<?php echo esc_url( $cz_brochure['url'] ); ?>" target="_blank" class="btn-outline">Download Brochure</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
// ══ FLEXIBLE CONTENT: sections (content_block | cards_block) ══
if ( have_rows( 'sections' ) ) :
    while ( have_rows( 'sections' ) ) :
        the_row();
        $cz_layout = get_row_layout();
        ?>

<hr class="pdp-sec-divider">

        <?php if ( 'content_block' === $cz_layout ) :
            $cz_eyebrow   = get_sub_field( 'eyebrow' );
            $cz_heading   = get_sub_field( 'heading' );
            $cz_body      = get_sub_field( 'body' );
            $cz_list_style = get_sub_field( 'list_style' );
            $cz_list_title = get_sub_field( 'list_title' );
            $cz_highlight  = get_sub_field( 'highlight_text' );
            $cz_is_soft    = ( 0 === strcasecmp( trim( (string) $cz_eyebrow ), 'Software & Connectivity' ) );
            $cz_wrap_class  = $cz_is_soft ? 'pdp-soft' : 'pdp-overview';
            $cz_inner_class = $cz_is_soft ? 'pdp-soft-inner' : 'pdp-overview-inner';
            $cz_body_class  = $cz_is_soft ? 'pdp-soft-body' : 'pdp-overview-body';
            ?>
<div class="<?php echo esc_attr( $cz_wrap_class ); ?>"<?php echo $cz_eyebrow ? ' id="' . esc_attr( sanitize_title( $cz_eyebrow ) ) . '"' : ''; ?>>
  <div class="<?php echo esc_attr( $cz_inner_class ); ?>">
    <div>
      <?php if ( $cz_eyebrow ) : ?><div class="pdp-sec-eyebrow"><?php echo esc_html( $cz_eyebrow ); ?></div><?php endif; ?>
      <?php if ( $cz_heading ) : ?><h2 class="pdp-sec-title"><?php echo esc_html( $cz_heading ); ?></h2><?php endif; ?>
    </div>
    <div>
      <?php if ( $cz_body ) : ?>
      <div class="<?php echo esc_attr( $cz_body_class ); ?>"><?php echo $cz_body; // phpcs:ignore -- wysiwyg field, already-sanitized HTML. ?></div>
      <?php endif; ?>

      <?php if ( 'none' !== $cz_list_style && have_rows( 'list_items' ) ) : ?>
      <div class="pdp-list-wrap">
        <?php if ( $cz_list_title ) : ?><div class="pdp-list-title"><?php echo esc_html( $cz_list_title ); ?></div><?php endif; ?>
        <div class="pdp-list pdp-list-<?php echo esc_attr( $cz_list_style ? $cz_list_style : 'dot' ); ?>">
          <?php
          while ( have_rows( 'list_items' ) ) :
              the_row();
              $cz_item_text = get_sub_field( 'text' );
              if ( ! $cz_item_text ) {
                  continue;
              }
              ?>
          <div class="pdp-list-item"><span class="pdp-list-<?php echo ( 'check' === $cz_list_style ) ? 'check' : 'dot'; ?>"></span><?php echo esc_html( $cz_item_text ); ?></div>
          <?php endwhile; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if ( $cz_highlight ) : ?>
      <div class="pdp-highlight"><?php echo esc_html( $cz_highlight ); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>

        <?php elseif ( 'cards_block' === $cz_layout ) :
            $cz_eyebrow = get_sub_field( 'eyebrow' );
            $cz_heading = get_sub_field( 'heading' );
            $cz_intro   = get_sub_field( 'intro' );
            $cz_is_caps = ( 0 === strcasecmp( trim( (string) $cz_eyebrow ), 'Testing Capabilities' ) );
            ?>

            <?php if ( $cz_is_caps ) : ?>
<div class="pdp-caps"<?php echo $cz_eyebrow ? ' id="' . esc_attr( sanitize_title( $cz_eyebrow ) ) . '"' : ''; ?>>
  <div class="pdp-sec">
    <?php if ( $cz_eyebrow ) : ?><div class="pdp-sec-eyebrow"><?php echo esc_html( $cz_eyebrow ); ?></div><?php endif; ?>
    <?php if ( $cz_heading ) : ?><h2 class="pdp-sec-title"><?php echo esc_html( $cz_heading ); ?></h2><?php endif; ?>
    <?php if ( $cz_intro ) : ?><p class="pdp-overview-text" style="max-width:640px;margin-top:16px;"><?php echo esc_html( $cz_intro ); ?></p><?php endif; ?>
    <div class="pdp-caps-grid">
      <?php
      if ( have_rows( 'cards' ) ) :
          while ( have_rows( 'cards' ) ) :
              the_row();
              ?>
      <div class="pdp-cap">
        <div class="pdp-cap-num"><?php echo esc_html( get_sub_field( 'label' ) ); ?></div>
        <div class="pdp-cap-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></div>
        <div class="pdp-cap-body"><?php echo esc_html( get_sub_field( 'body' ) ); ?></div>
      </div>
              <?php
          endwhile;
      endif;
      ?>
    </div>
  </div>
</div>
            <?php else : ?>
<div class="pdp-adv"<?php echo $cz_eyebrow ? ' id="' . esc_attr( sanitize_title( $cz_eyebrow ) ) . '"' : ''; ?>>
  <div class="pdp-overview-inner">
    <?php if ( $cz_eyebrow ) : ?><div class="pdp-sec-eyebrow"><?php echo esc_html( $cz_eyebrow ); ?></div><?php endif; ?>
    <?php if ( $cz_heading ) : ?><h2 class="pdp-sec-title"><?php echo esc_html( $cz_heading ); ?></h2><?php endif; ?>
    <?php if ( $cz_intro ) : ?><p class="pdp-overview-text" style="max-width:640px;margin-bottom:48px;"><?php echo esc_html( $cz_intro ); ?></p><?php endif; ?>
    <div class="pdp-adv-grid">
      <?php
      if ( have_rows( 'cards' ) ) :
          while ( have_rows( 'cards' ) ) :
              the_row();
              ?>
      <div class="pdp-adv-card">
        <div class="pdp-adv-code"><?php echo esc_html( get_sub_field( 'label' ) ); ?></div>
        <div class="pdp-adv-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></div>
        <div class="pdp-adv-body"><?php echo esc_html( get_sub_field( 'body' ) ); ?></div>
      </div>
              <?php
          endwhile;
      endif;
      ?>
    </div>
  </div>
</div>
            <?php endif; ?>

        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

</div><!-- /pdp-body -->

<div class="sol-editorial">
  <div class="sol-editorial-label">Explore More</div>
  <div class="sol-editorial-grid">
    <a href="<?php echo esc_url( cz_page_url( 'cloudx' ) ); ?>" class="ed-card" style="background:linear-gradient(160deg,#520d10 0%,#2a0608 60%,#0f0808 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/><path d="M6 7h2M6 10h6M6 13h4"/><rect x="14" y="7" width="4" height="6" rx="1"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Digital Platform</div><div class="ed-card-title">CloudX Ecosystem</div><div class="ed-card-sub">Connect your bench. Monitor remotely. Update automatically.</div><div class="ed-card-cta">Explore CloudX →</div></div>
    </a>
    <a href="https://www.youtube.com/@CarbonZapp" target="_blank" rel="noopener" class="ed-card" style="background:linear-gradient(160deg,#1a1a1a 0%,#111 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Video Series</div><div class="ed-card-title">Watch CZExperts</div><div class="ed-card-sub">Expert skills, shared knowledge. Setup, calibration, advanced ops.</div><div class="ed-card-cta">Watch Now →</div></div>
    </a>
    <a href="<?php echo esc_url( cz_page_url( 'innovation' ) ); ?>" class="ed-card" style="background:linear-gradient(160deg,#0a1628 0%,#0d1f3c 60%,#0f0f14 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Innovation &amp; R&amp;D</div><div class="ed-card-title">Innovation Driven</div><div class="ed-card-sub">35 years of continuous development. See what's coming next.</div><div class="ed-card-cta">Explore Innovation →</div></div>
    </a>
  </div>
</div>

<?php get_footer(); ?>
