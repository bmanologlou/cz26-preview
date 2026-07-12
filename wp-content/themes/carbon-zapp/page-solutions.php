<?php
/**
 * Template Name: Solutions
 *
 * Ports solutions.html + the 4 old duplicate market-filtered static pages
 * (solutions-specialists.html / solutions-workshops.html / solutions-large.html /
 * solutions-authorized.html) into one WP template. The `market` query var
 * (specialists|workshops|large|authorized) pre-filters the catalog grid
 * server-side; the actuator-tag pills filter client-side against `data-act`
 * (real & functional here — the original source's actuator-filter JS
 * targeted commented-out markup and never ran).
 *
 * Source: solutions.html — see wp-theme/SCHEMA.md.
 */

get_header();

$cz_valid_markets = array( 'specialists', 'workshops', 'large', 'authorized' );
$cz_market_filter = '';
if ( isset( $_GET['market'] ) && in_array( wp_unslash( $_GET['market'] ), $cz_valid_markets, true ) ) {
	$cz_market_filter = sanitize_key( wp_unslash( $_GET['market'] ) );
}

$cz_base_url = get_permalink();
?>

<div class="filter-bar">
  <div class="filter-bar-row">
    <div class="filter-group">
      <a href="<?php echo esc_url( $cz_base_url ); ?>" class="filter-btn<?php echo ( '' === $cz_market_filter ) ? ' active' : ''; ?>">All</a>
      <a href="<?php echo esc_url( add_query_arg( 'market', 'specialists', $cz_base_url ) ); ?>" class="filter-btn<?php echo ( 'specialists' === $cz_market_filter ) ? ' active' : ''; ?>">Specialists</a>
      <a href="<?php echo esc_url( add_query_arg( 'market', 'workshops', $cz_base_url ) ); ?>" class="filter-btn<?php echo ( 'workshops' === $cz_market_filter ) ? ' active' : ''; ?>">Workshops</a>
      <a href="<?php echo esc_url( add_query_arg( 'market', 'large', $cz_base_url ) ); ?>" class="filter-btn<?php echo ( 'large' === $cz_market_filter ) ? ' active' : ''; ?>">Large Engines</a>
      <a href="<?php echo esc_url( add_query_arg( 'market', 'authorized', $cz_base_url ) ); ?>" class="filter-btn<?php echo ( 'authorized' === $cz_market_filter ) ? ' active' : ''; ?>">Authorized</a>
    </div>
    <div class="act-pills" style="margin-left:10px">
      <button type="button" class="act-pill" data-act="crdi">CRDi</button>
      <button type="button" class="act-pill" data-act="crp">CRp</button>
      <button type="button" class="act-pill" data-act="eui-eup">EUi/EUP</button>
      <button type="button" class="act-pill" data-act="heui">HEUi</button>
      <button type="button" class="act-pill" data-act="engine">Engine</button>
    </div>
    <div class="filter-sep"></div>
    <div class="act-pills">
      <button type="button" class="act-pill" data-act="gdi-inj">GDi Inj</button>
      <button type="button" class="act-pill" data-act="efi">EFi</button>
      <button type="button" class="act-pill" data-act="gdi-pump">GDi Pump</button>
    </div>
    <div class="filter-sep"></div>
    <button type="button" class="act-pill" id="act-reset">Reset</button>
    <span class="filter-count" id="filter-count"></span>
  </div>
</div>

<div class="sol-hero-wrap">
<div class="sol-hero">
    <div class="sol-hero-left">
    <div class="sol-hero-eyebrow">Complete Injection Platform Range</div>
    <h1 class="sol-hero-title">BUILT FOR<br>EVERY <span class="hero-red">SYSTEM</span></h1>
    <p class="sol-hero-desc">From compact workshop units to advanced specialist diagnostic platforms supporting the full spectrum of Diesel and Gasoline injection technologies.</p>
    <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_Product_Catalog.pdf' ); ?>" target="_blank" rel="noopener" class="btn-primary">Download Product Catalog</a>
  </div>
  <div class="sol-hero-right">
    <img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/EO_CZ_Photo_Solutions_black_02n.webp' ); ?>" alt="XSeries" style="width:95%;object-fit:contain;object-position:bottom left;">
  </div>
</div>
</div>

<div class="sol-catalog">
  <div class="sol-grid">
    <?php
    $cz_products = new WP_Query( array(
        'post_type'      => 'cz_product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
    ) );

    if ( $cz_products->have_posts() ) :
        while ( $cz_products->have_posts() ) :
            $cz_products->the_post();

            $cz_market         = get_field( 'market' );
            $cz_authorized     = get_field( 'authorized' );
            $cz_category_label = (string) get_field( 'category_label' );
            $cz_is_large       = ( false !== stripos( $cz_category_label, 'large' ) );
            $cz_card_image     = get_field( 'card_image' );
            $cz_card_desc      = get_field( 'card_description' );
            $cz_card_bg        = get_field( 'card_bg' );
            $cz_terms          = get_the_terms( get_the_ID(), 'cz_actuator' );
            $cz_act_slugs      = implode( ' ', wp_list_pluck( $cz_terms ? $cz_terms : array(), 'slug' ) );

            if ( 'specialists' === $cz_market_filter && 'specialists' !== $cz_market ) {
                continue;
            }
            if ( 'workshops' === $cz_market_filter && 'workshops' !== $cz_market ) {
                continue;
            }
            if ( 'large' === $cz_market_filter && ! $cz_is_large ) {
                continue;
            }
            if ( 'authorized' === $cz_market_filter && ! $cz_authorized ) {
                continue;
            }
            ?>
<a href="<?php the_permalink(); ?>" class="prod-card" data-market="<?php echo esc_attr( $cz_market ); ?>" data-act="<?php echo esc_attr( $cz_act_slugs ); ?>" data-authorized="<?php echo $cz_authorized ? 'true' : 'false'; ?>">
      <div class="prod-card-image<?php echo ( 'blue' === $cz_card_bg ) ? ' bg-blue' : ''; ?>"><?php if ( $cz_card_image ) : ?><img src="<?php echo esc_url( $cz_card_image['url'] ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?></div>
      <div class="prod-card-body">
        <div class="prod-card-name"><?php the_title(); ?></div>
        <div class="prod-card-desc"><?php echo esc_html( $cz_card_desc ); ?></div>
        <div class="prod-card-footer">
          <span class="prod-card-cta">Discover</span>
        </div>
      </div>
    </a>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</div>

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

<script>
document.addEventListener("DOMContentLoaded", function () {
  // ── Actuator-tag pill filtering (real & functional client-side filter
  //    against data-act, replacing the original solutions.html's dead JS
  //    which targeted commented-out markup) ──
  var cards   = document.querySelectorAll(".prod-card");
  var countEl = document.getElementById("filter-count");
  var activeActs = new Set();

  function applyFilters() {
    var n = 0;
    cards.forEach(function (card) {
      var cActs = (card.dataset.act || "").split(" ").filter(Boolean);
      var ok = activeActs.size === 0 || Array.prototype.some.call(Array.from(activeActs), function (a) {
        return cActs.indexOf(a) !== -1;
      });
      card.style.display = ok ? "" : "none";
      if (ok) { n++; }
    });
    if (countEl) {
      countEl.textContent = activeActs.size > 0 ? n + " Systems" : "";
    }
  }

  document.querySelectorAll(".act-pill:not(#act-reset)").forEach(function (pill) {
    pill.addEventListener("click", function () {
      var acts = pill.dataset.act.split(" ");
      var allActive = acts.every(function (a) { return activeActs.has(a); });
      if (allActive) {
        acts.forEach(function (a) { activeActs.delete(a); });
        pill.classList.remove("active");
      } else {
        acts.forEach(function (a) { activeActs.add(a); });
        pill.classList.add("active");
      }
      applyFilters();
    });
  });

  var resetBtn = document.getElementById("act-reset");
  if (resetBtn) {
    resetBtn.addEventListener("click", function () {
      activeActs.clear();
      document.querySelectorAll(".act-pill:not(#act-reset)").forEach(function (p) {
        p.classList.remove("active");
      });
      applyFilters();
    });
  }

  applyFilters();
});
</script>

<?php get_footer(); ?>
