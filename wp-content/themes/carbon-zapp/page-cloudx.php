<?php
/**
 * Template Name: CloudX
 *
 * Ported verbatim from cloudx.html. Fully static content — no CPT/ACF
 * queries needed. Applies automatically to the "cloudx" Page via
 * WordPress's page-{slug}.php template hierarchy; the Template Name header
 * also makes it selectable manually in the editor as a fallback.
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="page-hero-wrap">
  <div class="page-hero">
    <div class="page-hero-left">
      <div class="page-hero-eyebrow">IoT Cloud Computing Platform</div>
      <h1 class="page-hero-title">CloudX<br>Ecosystem</h1>
      <p class="page-hero-desc">Cloud-powered connectivity and intelligent platform integration for modern injection service operations.</p>
    </div>
    <div class="page-hero-right" style="overflow:hidden;"><img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/cz_hero_cloudx.webp' ); ?>" alt="CloudX Ecosystem" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;"></div>
  </div>
</div>

<!-- INTRO -->
<div class="cx-section">
  <div class="cx-eyebrow">Connected Intelligence</div>
  <h2 class="cx-title">Connected Intelligence for Modern Injection Service</h2>
  <p class="cx-body">CloudX is Carbon Zapp's cloud-based IoT platform, developed to connect machines, software and service operations into one intelligent ecosystem. Designed around the new generation of Carbon Zapp equipment, CloudX enables workshops and specialists to work with greater flexibility, connectivity and long-term efficiency.</p>
  <p class="cx-body">Integrated directly with AZO software and Carbon Zapp systems, CloudX provides access to live database updates, remote diagnostics, machine monitoring and connected service management through a secure online environment. The platform is built to support both everyday workshop operations and the evolving demands of modern Diesel and Gasoline injection technologies.</p>
</div>

<hr class="cx-divider">

<!-- KEY CAPABILITIES -->
<div class="cx-section">
  <div class="cx-eyebrow">Key Capabilities</div>
  <h2 class="cx-title">What CloudX Delivers</h2>
  <div class="cx-caps-grid">
    <div class="cx-cap"><div class="cx-cap-dot"></div>Live online database and software updates</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Remote machine operation and status monitoring</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Cloud-based machine backup and diagnostics</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Multiple machine management support</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Instant feature activation and expandability</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Smart maintenance notifications and service reminders</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Remote troubleshooting directly from Carbon Zapp</div>
    <div class="cx-cap"><div class="cx-cap-dot"></div>Industry 4.0 ready IoT infrastructure</div>
  </div>
  <p class="cx-body" style="margin-top:40px;">CloudX helps transform each Carbon Zapp platform into a continuously evolving system — improving connectivity, reducing downtime and simplifying support, updates and future scalability for workshops worldwide.</p>
</div>

<hr class="cx-divider">

<!-- VIDEO -->
<div class="cx-video-wrap">
  <div class="cx-video-inner">
    <iframe src="https://www.youtube-nocookie.com/embed/h2DoHXDhj40?rel=0&modestbranding=1" title="CloudX Ecosystem — Carbon Zapp" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
  </div>
</div>

<hr class="cx-divider">

<!-- CLOSING -->
<div class="cx-closing">
  <div>
    <div class="cx-eyebrow">Next Generation</div>
    <h2 class="cx-title">Designed for the Next Generation of Workshops</h2>
  </div>
  <div>
    <p class="cx-body">From standalone benches to advanced specialist platforms, CloudX creates a connected environment where machines, diagnostics and data work together seamlessly. Whether operating a single workstation or managing multiple systems, users benefit from centralized access, continuous updates and smarter operational control.</p>
    <p class="cx-body">Powered by innovation and built for the future of automotive injection service, CloudX extends the capabilities of Carbon Zapp equipment beyond the machine itself.</p>
    <div class="cx-login-wrap">
      <a href="https://cloudx.carbonzapp.com/client" target="_blank" rel="noopener" class="btn-cx-login">Login to CloudX →</a>
    </div>
  </div>
</div>

<hr class="cx-divider">

<!-- PROMO GRID -->
<div class="sol-editorial">
  <div class="sol-editorial-label">Explore More</div>
  <div class="sol-editorial-grid">
    <a href="<?php echo esc_url( cz_page_url( 'solutions' ) ); ?>" class="ed-card" style="background:linear-gradient(160deg,#0d1f3c 0%,#0a1628 60%,#0f0f14 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Product Range</div><div class="ed-card-title">XSeries Platforms</div><div class="ed-card-sub">Find the right bench for your workshop or specialist operation.</div><div class="ed-card-cta">Explore Solutions →</div></div>
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

<?php
get_footer();
