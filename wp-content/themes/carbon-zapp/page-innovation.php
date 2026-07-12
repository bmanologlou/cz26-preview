<?php
/**
 * Template Name: Innovation
 *
 * Ported verbatim from innovation.html. Fully static content — no CPT/ACF
 * queries needed. Applies automatically to the "innovation" Page via
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

<!-- PAGE HERO -->
<div class="page-hero-wrap" style="margin-top:var(--nav-h);">
  <div class="page-hero">
    <div class="page-hero-left">
      <div class="page-hero-eyebrow">Engineering the Future</div>
      <h1 class="page-hero-title">Innovation<br>Driven</h1>
      <p class="page-hero-desc">Advancing automotive injection service through engineering, intelligent technologies and continuously evolving solutions designed for the next generation of workshops and specialists.</p>
    </div>
    <div class="page-hero-right" style="overflow:hidden;"><img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/cz_hero_innovation.webp' ); ?>" alt="Innovation" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;"></div>
  </div>
</div>

<hr class="cx-divider">

<!-- INTRO -->
<div class="cx-section">
  <div class="cx-eyebrow">Innovation Driven</div>
  <h2 class="cx-title">Building the Future of Automotive Injection Service</h2>
  <p class="cx-body">Innovation has always been at the core of Carbon Zapp's philosophy. Through continuous research, advanced engineering and real-world industry expertise, Carbon Zapp develops technologies that redefine performance, diagnostics and service capabilities across Diesel and Gasoline injection systems.</p>
  <p class="cx-body">With more than 35 years of experience and a strong focus on research and development, the company continuously evolves its platforms, software and technologies to meet the increasing complexity of modern fuel systems and future mobility demands.</p>
  <div style="margin-top:32px;">
    <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_GLOBAL_REPR.pdf' ); ?>" target="_blank" rel="noopener" class="innov-link">View Our Global Network</a>
  </div>
</div>

<hr class="cx-divider">

<!-- TECHNOLOGY DEVELOPMENT -->
<div class="cx-section">
  <div class="cx-eyebrow">Technology Development</div>
  <h2 class="cx-title">Innovation Through Engineering</h2>
  <p class="cx-body">Carbon Zapp combines hardware development, intelligent software and connected technologies into a complete ecosystem of automotive injection service solutions. From advanced testing platforms and coding technologies to CloudX connectivity and AZO software integration, every system is designed to deliver precision, flexibility and long-term scalability.</p>
  <p class="cx-body">The company's development philosophy focuses on creating practical innovations that improve diagnostics, simplify operation and support workshops in adapting to constantly evolving vehicle technologies.</p>

  <!-- STATS GRID -->
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.06);border-radius:4px;overflow:hidden;margin-top:48px;margin-bottom:56px;">
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">35+</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Years of Innovation</div>
    </div>
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">98+</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Countries Global Network</div>
    </div>
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">40%</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Annual R&D Investment</div>
    </div>
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">10K+</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Hours of Product Testing Annually</div>
    </div>
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">1K+</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Hours of Training & Seminars</div>
    </div>
    <div style="padding:20px 20px;background:transparent;">
      <div style="font-family:'Gunterz',sans-serif;font-size:26px;line-height:1;color:rgba(245,243,239,.7);margin-bottom:4px;">16K+</div>
      <div style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:rgba(245,243,239,.35);">Products Produced</div>
    </div>
  </div>
</div>

<!-- VIDEO -->
<div class="cx-video-wrap">
  <div class="cx-video-inner">
    <iframe src="https://www.youtube-nocookie.com/embed/sAKAsurtyHY?rel=0&modestbranding=1" title="Carbon Zapp Innovation" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
  </div>
</div>

<hr class="cx-divider">

<!-- CERTIFIED ENGINEERING -->
<div class="cx-section">
  <div class="cx-eyebrow">Certified Engineering</div>
  <h2 class="cx-title">Certified Quality and OEM-Trusted Technology</h2>
  <p class="cx-body">Carbon Zapp develops its technologies under internationally recognized quality standards while continuously investing in advanced manufacturing, testing procedures and connected diagnostic systems.</p>
  <p class="cx-body">The company's platforms are trusted by specialists and professional service environments worldwide, while selected systems and technologies include authorized solutions for Continental / VDO applications across modern Diesel injection systems.</p>
  <div style="display:flex;flex-direction:column;gap:12px;margin-top:32px;">
    <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CERT_CARBON_ZAPP_9001_2025_EN.pdf' ); ?>" target="_blank" rel="noopener" class="innov-link">View ISO 9001 Certification</a>
    <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/Authorization - Carbon Zapp Cooperation - DRSP authorizing DP 2019_09.pdf' ); ?>" target="_blank" rel="noopener" class="innov-link">View VDO / Continental Authorisation</a>
  </div>
</div>

<hr class="cx-divider">

<!-- CONNECTED ECOSYSTEM -->
<div class="cx-section">
  <div class="cx-eyebrow">Connected Ecosystem</div>
  <h2 class="cx-title">Connected Technologies with Future-Ready Solutions</h2>
  <p class="cx-body">Carbon Zapp continuously develops advanced technologies designed around modern Diesel, Gasoline, Heavy-Duty and Marine applications. Through intelligent diagnostics, cloud connectivity, electronic measurement systems and continuous software evolution, the company creates future-ready platforms that support workshops worldwide.</p>
  <p class="cx-body">Powered by CloudX and AZO software technologies, Carbon Zapp systems are designed to evolve together with the industry.</p>
</div>

<hr class="cx-divider">

<!-- CLOSING -->
<div class="cx-section">
  <div class="cx-eyebrow">Forward Thinking</div>
  <h2 class="cx-title">Engineering Forward Mobility Solutions</h2>
  <p class="cx-body">Innovation is not only about developing new technologies. It is about creating smarter, more efficient and more connected ways to support the future of mobility, diagnostics and automotive service worldwide.</p>
  <div style="margin-top:28px;">
    <a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_Product_Catalog.pdf' ); ?>" target="_blank" rel="noopener" class="innov-btn-outline">Download Product Catalog</a>
  </div>
</div>

<hr class="cx-divider">

<!-- PROMO GRID -->
<div class="sol-editorial">
  <div class="sol-editorial-label">Explore More</div>
  <div class="sol-editorial-grid">
    <a href="<?php echo esc_url( cz_page_url( 'solutions' ) ); ?>" class="ed-card" style="background:linear-gradient(160deg,#0d1f3c 0%,#0a1628 60%,#0f0f14 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Product Range</div><div class="ed-card-title">XSeries Platforms</div><div class="ed-card-sub">Find the right bench for your workshop or specialist operation.</div><div class="ed-card-cta">Explore Solutions →</div></div>
    </a>
    <a href="<?php echo esc_url( cz_page_url( 'cloudx' ) ); ?>" class="ed-card" style="background:linear-gradient(160deg,#520d10 0%,#2a0608 60%,#0f0808 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Digital Platform</div><div class="ed-card-title">CloudX Ecosystem</div><div class="ed-card-sub">Connect your bench. Monitor remotely. Update automatically.</div><div class="ed-card-cta">Explore CloudX →</div></div>
    </a>
    <a href="https://www.youtube.com/@CarbonZapp" target="_blank" rel="noopener" class="ed-card" style="background:linear-gradient(160deg,#1a1a1a 0%,#111 100%);">
      <div class="ed-card-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg></div>
      <div class="ed-card-content"><div class="ed-card-eyebrow">Video Series</div><div class="ed-card-title">Watch CZExperts</div><div class="ed-card-sub">Expert skills, shared knowledge. Setup, calibration, advanced ops.</div><div class="ed-card-cta">Watch Now →</div></div>
    </a>
  </div>
</div>

<?php
get_footer();
