<?php
/**
 * Mobile/global newsletter drawer.
 *
 * Ported from _newsletter-drawer.html. The source drove this entirely with
 * inline onclick/oninput handlers and inline style="..." attributes; those
 * are dropped here in favour of stable IDs/classes wired up in
 * assets/js/main.js (open/close, live-validate the email field to
 * enable/disable submit, and post via the shared cz_newsletter_signup AJAX
 * handler). The overlay/panel show-hide animation itself is already handled
 * by the existing #nl-drawer-overlay / #nl-drawer-panel / body.nl-drawer-open
 * rules in assets/css/responsive-style.css — no change needed there.
 *
 * The theme.css author still needs to add rules for the classes below
 * (values carried over 1:1 from the source's inline styles):
 *   .nl-drawer-eyebrow   { font-family:'DM Mono',monospace; font-size:10px; letter-spacing:.12em; text-transform:uppercase; color:#ED1C24; margin-bottom:8px; }
 *   .nl-drawer-title     { font-family:'Gunterz',sans-serif; font-size:22px; line-height:1.1; color:#f5f3ef; margin:0 0 20px; }
 *   .nl-drawer-input     { background:transparent; border:none; border-bottom:1px solid rgba(255,255,255,.2); color:#f5f3ef; font-family:'Public Sans',sans-serif; font-size:14px; padding:8px 0; outline:none; width:100%; box-sizing:border-box; }
 *   .nl-drawer-submit    { background:#ED1C24; color:#fff; border:none; font-family:'Public Sans',sans-serif; font-size:11px; font-weight:600; letter-spacing:.08em; text-transform:uppercase; padding:14px; cursor:pointer; margin-top:12px; width:100%; box-sizing:border-box; opacity:1; transition:opacity .2s; }
 *   .nl-drawer-submit:disabled { opacity:.35; cursor:not-allowed; }
 *   .nl-drawer-agree-row { display:flex; align-items:flex-start; gap:10px; margin-top:12px; cursor:pointer; }
 *   .nl-drawer-agree-checkbox { width:14px; height:14px; cursor:pointer; flex-shrink:0; margin-top:2px; appearance:none; -webkit-appearance:none; border:1px solid rgba(255,255,255,.3); background:transparent; border-radius:2px; }
 *   .nl-drawer-agree-checkbox:checked { background:#ED1C24; border-color:#ED1C24; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 10 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4l3 3 5-6' stroke='white' stroke-width='1.5'/%3E%3C/svg%3E"); background-size:10px; background-repeat:no-repeat; background-position:center; }
 *   .nl-drawer-agree-text { font-size:11px; color:rgba(245,243,239,.4); line-height:1.5; }
 *   .nl-drawer-thanks    { display:none; font-family:'Public Sans',sans-serif; font-size:12px; color:rgba(245,243,239,.6); text-align:center; padding:12px 0; transition:opacity .6s; }
 *   .nl-drawer-thanks.is-visible { display:block; }
 *   .nl-drawer-thanks.is-error  { color:#ED1C24; }
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="nl-drawer-overlay"></div>
<div id="nl-drawer-panel">
  <button id="nl-drawer-close" type="button" aria-label="Close newsletter">×</button>

  <div class="nl-drawer-eyebrow">Newsletter</div>
  <h3 class="nl-drawer-title">Stay in the loop<br>with Carbon Zapp</h3>

  <form id="nl-drawer-form" data-msg-target="nl-thanks" novalidate>
    <input type="email" id="nl-email" class="nl-drawer-input" placeholder="Your email address" required>
    <button type="submit" id="nl-sub-btn" class="nl-drawer-submit" disabled>Subscribe</button>
    <label class="nl-drawer-agree-row">
      <input type="checkbox" id="nl-agree" class="nl-drawer-agree-checkbox">
      <span class="nl-drawer-agree-text">I agree to receive updates from Carbon Zapp</span>
    </label>
  </form>

  <div id="nl-thanks" class="nl-drawer-thanks">Thank you for subscribing to the Carbon Zapp Newsletter</div>
</div>
