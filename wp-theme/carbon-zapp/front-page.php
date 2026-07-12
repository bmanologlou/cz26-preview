<?php
/**
 * Front page template — ported verbatim from index.html.
 *
 * Sections, in source order: hero (with server-rendered "Next Appearance"
 * event card), problem, cz-grid, cloudx, why. The dead/empty "news" section
 * marker present in index.html is intentionally not ported (see SCHEMA.md).
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
<section class="hero">
  <!-- Hero image background -->
  <div class="hero-video-bg" style="background-image:url('<?php echo esc_url( CZ_THEME_URI . '/assets/images/hero-home.webp' ); ?>');background-size:cover;background-position:65% center;"></div>

  <div class="hero-bg"></div>

<div class="hero-content-wrap">

  <div class="hero-content">
    <div class="hero-eyebrow">Engineering Forward Mobility</div>
    <h1 class="hero-title">
      INNOVATION<br>DRIVEN
    </h1>
    <p class="hero-sub">
      35 years of precision injection service equipment. Trusted by OEM partners and specialists in 98 countries.
    </p>
    <div class="hero-ctas">
      <a href="<?php echo esc_url( cz_page_url( 'solutions' ) ); ?>" class="btn-primary">Discover the XSeries</a>
    </div>
  </div>

  <div class="hero-scroll">
    <div class="scroll-line"></div>
    SCROLL
  </div>

  <?php
  /*
   * UPCOMING EVENT CARD — server-rendered replacement for the original
   * fetch('news.json') + client-side filter/countdown.
   *
   * Contract for assets/js/hero-events.js (no hero-events.js existed yet at
   * the time this template was written, so this defines the convention —
   * match it exactly):
   *   - Container: #hero-event-card (only printed when there is at least
   *     one upcoming event; omitted entirely otherwise).
   *   - One <a class="hero-event-body hero-event-slide"> per event, in
   *     ascending event_start order. The first slide additionally carries
   *     class "is-active" and is the only one visible on load (others get
   *     inline style="display:none" so the card degrades gracefully to a
   *     static single-event card with JS disabled).
   *   - Each slide carries data-event-start="Ymd" and data-event-end="Ymd"
   *     (ACF date_picker return format) for the JS to compute the
   *     "hero-event-countdown" text and the "hero-event-label" state
   *     (Now On / Recent Event / Next Appearance) — mirroring the
   *     daysUntil()/labelEl logic from the original index.html rotator.
   *   - Dots: #hero-event-dots contains one <button class="dot"
   *     data-slide-index="n"> per event, first one class="dot active".
   *     JS should toggle "is-active"/"active" and the inline display style
   *     together when rotating, and wire click-to-go + swipe as before.
   */
  $cz_events = cz_get_upcoming_events( 5 );
  if ( ! empty( $cz_events ) ) :
  ?>
  <!-- UPCOMING EVENT CARD -->
  <div class="hero-event" id="hero-event-card">
    <div class="hero-event-label" id="hero-event-label">Next Appearance</div>

    <?php foreach ( $cz_events as $cz_event_index => $cz_event ) :
      $cz_event_start  = get_field( 'event_start', $cz_event->ID );
      $cz_event_end    = get_field( 'event_end', $cz_event->ID );
      $cz_event_dates  = get_field( 'event_date_display', $cz_event->ID );
      $cz_event_venue  = get_field( 'event_location', $cz_event->ID );
      $cz_event_is_first = ( 0 === $cz_event_index );
    ?>
    <a class="hero-event-body hero-event-slide<?php echo $cz_event_is_first ? ' is-active' : ''; ?>"
       href="<?php echo esc_url( get_permalink( $cz_event ) ); ?>"
       data-event-start="<?php echo esc_attr( $cz_event_start ); ?>"
       data-event-end="<?php echo esc_attr( $cz_event_end ? $cz_event_end : $cz_event_start ); ?>"
       <?php echo $cz_event_is_first ? '' : 'style="display:none;"'; ?>>
      <div class="hero-event-date">
        <div class="hero-event-date-val"><?php echo esc_html( $cz_event_dates ); ?></div>
        <div class="hero-event-countdown"></div>
      </div>
      <div class="hero-event-name"><?php echo esc_html( get_the_title( $cz_event ) ); ?></div>
      <div class="hero-event-location">
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span><?php echo esc_html( $cz_event_venue ); ?></span>
      </div>
      <div class="hero-event-action"><span class="event-action-btn">View Event <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></span></div>
    </a>
    <?php endforeach; ?>

    <div class="hero-event-nav">
      <div class="hero-event-dots" id="hero-event-dots">
        <?php foreach ( $cz_events as $cz_event_index => $cz_event ) : ?>
          <button type="button" class="dot<?php echo ( 0 === $cz_event_index ) ? ' active' : ''; ?>" data-slide-index="<?php echo (int) $cz_event_index; ?>" aria-label="Show event <?php echo (int) $cz_event_index + 1; ?>"></button>
        <?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url( cz_page_url( 'news' ) . '?filter=events' ); ?>" class="hero-event-all">All Events</a>
    </div>
  </div>
  <?php endif; ?>

</section>

<!-- ═══════════════════════════════ PROBLEM ═══════════════════════════════ -->
<section class="problem">
  <div class="problem-eyebrow-row">
    <div class="section-label">Our Purpose</div>
  </div>
  <div class="problem-inner">
    <h2 class="problem-title">
      ENGINEERING FORWARD<br>MOBILITY SOLUTIONS
    </h2>
    <div class="problem-body-col">
      <p class="problem-body">
        Modern fuel systems demand precision beyond conventional equipment. Carbon Zapp designs and manufactures a complete range of Diesel and Gasoline injection service solutions, supporting specialists, workshops and heavy-duty applications worldwide.
      </p>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════ CZ GRID ═══════════════════════════════ -->
<section style="background: var(--black); padding: 0;">
<div class="cz-grid">

  <!-- ROW 1: Full width horizontal -->
  <div class="card-horizontal cz-bg-black">
    <div class="card-text">
      <div class="cz-card-eyebrow">XSeries Platforms</div>
      <h2 class="cz-card-title large">Engineered at Every Scale</h2>
      <p class="cz-card-subtitle">from compact CRDi to large engine systems</p>
      <div class="cz-card-actions">
        <a href="<?php echo esc_url( cz_page_url( 'solutions' ) ); ?>" class="btn-primary">Explore the XSeries</a>
        <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_Product_Catalog.pdf' ); ?>" target="_blank" rel="noopener" class="btn-outline-dark">Download Catalog</a>
      </div>
    </div>
    <div class="card-image cz-card-img-xseries" style="background:#000;justify-content:flex-start;padding-left:40px;">
      <img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/EO_CZ_Photo_Solutions_black_02n.webp' ); ?>" alt="XSeries" class="xseries-img" style="width:95%;">
    </div>
  </div>

</div>
</section>


<!-- ═══════════════════════════════ CLOUDX ═══════════════════════════════ -->
<section class="cloudx">
  <div class="cloudx-inner">
    <div>
      <div class="section-label">Digital Platform</div>
      <h2 class="cloudx-title"><span>CLOUDX</span><br>ECOSYSTEM</h2>
      <p class="cloudx-desc">
        CloudX transforms every bench into a connected system.
        Automatic injector data updates, remote performance monitoring and instant access to factory support, all managed through a secure cloud environment built for professional service centers.
      </p>
      <div style="display:flex;gap:16px;flex-wrap:wrap;margin-top:40px;">
        <a href="<?php echo esc_url( cz_page_url( 'cloudx' ) ); ?>" class="btn-primary">Explore CloudX</a>
        <a href="https://cloudx.carbonzapp.com/client" target="_blank" rel="noopener" class="btn-login" style="display:inline-block;padding:14px 24px;">Login →</a>
      </div>
    </div>

    <div class="cloudx-dashboard">
      <div class="dashboard-bar">
        <div class="dot-r"></div>
        <div class="dot-y"></div>
        <div class="dot-g"></div>
        <div class="dashboard-url">cloudx.carbonzapp.com</div>
      </div>
      <div class="dashboard-body">
        <div class="db-row">
          <div class="db-card">
            <div class="db-card-label">MACHINES ONLINE</div>
            <div class="db-card-value accent">3</div>
          </div>
          <div class="db-card">
            <div class="db-card-label">TESTS TODAY</div>
            <div class="db-card-value">47</div>
          </div>
        </div>
        <div class="db-bar-container">
          <div class="db-bar-label">DATABASE VERSION</div>
          <div class="bar-track"><div class="bar-fill" style="width:87%"></div></div>
          <div class="bar-meta"><span>AZO v3.12</span><span>Up to date ✓</span></div>
        </div>
        <div style="height:12px;"></div>
        <div class="db-bar-container">
          <div class="db-bar-label">MTBR|X-001 — UPTIME</div>
          <div class="bar-track"><div class="bar-fill" style="width:94%;background:#27c93f"></div></div>
          <div class="bar-meta"><span>94%</span><span>Last 30 days</span></div>
        </div>
        <div style="height:12px;"></div>
        <div class="db-row">
          <div class="db-card">
            <div class="db-card-label">NEXT SERVICE</div>
            <div class="db-card-value" style="font-size:18px;">42 days</div>
          </div>
          <div class="db-card">
            <div class="db-card-label">PENDING UPDATES</div>
            <div class="db-card-value accent" style="font-size:18px;">2</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════ WHY CZ ═══════════════════════════════ -->
<section class="why">
  <div class="why-inner">
    <div class="why-top">
      <div>
        <div class="section-label">Why Carbon Zapp</div>
        <h2 class="why-title">PROVEN BY<br>ENGINEERING</h2>
      </div>
      <p class="why-intro">
        Founded in 1989, Carbon Zapp develops and manufactures injection service equipment engineered for long-term performance and system-wide compatibility. Continuous validation, extensive product testing and a sustained reinvestment of over 40% of annual profit into R&D ensure that every platform remains relevant across evolving Diesel and Gasoline technologies. Trusted in 98 countries, our network is built on measurable engineering outcomes.
      </p>
    </div>

    <div class="stats-grid">

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Clock / timeline: years of innovation -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <circle cx="14" cy="14" r="11"/>
            <polyline points="14,7 14,14 18,17" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="14" cy="14" r="1.2" fill="currentColor"/>
          </svg>
        </div>
        <div class="stat-value">35<span class="plus">+</span></div>
        <div class="stat-label">Years of Innovation</div>
      </div>

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Globe: global network -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <circle cx="14" cy="14" r="11"/>
            <ellipse cx="14" cy="14" rx="5" ry="11"/>
            <line x1="3" y1="14" x2="25" y2="14"/>
            <line x1="5" y1="8.5" x2="23" y2="8.5"/>
            <line x1="5" y1="19.5" x2="23" y2="19.5"/>
          </svg>
        </div>
        <div class="stat-value">98<span class="plus">+</span></div>
        <div class="stat-label">Countries in Global Network</div>
      </div>

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Box / package: products produced -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <polyline points="2.5,8 14,14.5 25.5,8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.5 8l11.5 6.5L25.5 8 14 1.5 2.5 8z" stroke-linejoin="round"/>
            <line x1="14" y1="14.5" x2="14" y2="26.5"/>
            <path d="M25.5 8v12L14 26.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.5 8v12L14 26.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="stat-value">16K<span class="plus">+</span></div>
        <div class="stat-label">Products Produced</div>
      </div>

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Refresh arrow: reinvestment / R&D cycle -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M4 14a10 10 0 0 1 17-7.2" stroke-linecap="round"/>
            <path d="M24 14a10 10 0 0 1-17 7.2" stroke-linecap="round"/>
            <polyline points="18.5,4 21,6.8 18.5,9.5" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="9.5,24 7,21.2 9.5,18.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="stat-value">40<span class="plus">%</span></div>
        <div class="stat-label">Annual Profit Reinvested in R&amp;D</div>
      </div>

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Oscilloscope / pulse: testing hours -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <rect x="2" y="4" width="24" height="18" rx="2"/>
            <polyline points="4,16 7,16 9,9 11,20 13,13 15,16 18,16 20,10 22,16 24,16" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="stat-value">10K<span class="plus">+</span></div>
        <div class="stat-label">Hours of Product Testing Annually</div>
      </div>

      <div class="stat-box">
        <div class="stat-icon">
          <!-- Hard hat / safety helmet: training -->
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.3">
            <!-- dome -->
            <path d="M4 17C4 10.4 8.5 5 14 5s10 5.4 10 12" stroke-linecap="round"/>
            <!-- brim -->
            <path d="M1.5 17h25" stroke-linecap="round"/>
            <!-- inner suspension band -->
            <path d="M7 17c0-3.9 3.1-7 7-7s7 3.1 7 7" stroke-width="1" opacity="0.5"/>
            <!-- chin strap left -->
            <path d="M4 17l1.5 4" stroke-linecap="round" stroke-width="1"/>
            <!-- chin strap right -->
            <path d="M24 17l-1.5 4" stroke-linecap="round" stroke-width="1"/>
            <!-- strap connector -->
            <line x1="5.5" y1="21" x2="22.5" y2="21" stroke-linecap="round" stroke-width="1"/>
          </svg>
        </div>
        <div class="stat-value">1K<span class="plus">+</span></div>
        <div class="stat-label">Training Hours Per Year</div>
      </div>

    </div>

    <div class="why-awards">
      <div class="award-label">ISO 9001:2021 Certified · Continental/VDO Authorized · ADS Member · WIMA Member · OEM Partner</div>
    </div>
  </div>
</section>

<?php
get_footer();
