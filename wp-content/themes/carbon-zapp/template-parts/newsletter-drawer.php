<?php
/**
 * Mobile/global newsletter drawer.
 *
 * Ported from _newsletter-drawer.html. The source drove this entirely with
 * inline onclick/oninput handlers and inline style="..." attributes; those
 * are dropped here in favour of stable IDs/classes wired up in
 * assets/js/main.js (open/close, live-validate the email field to
 * enable/disable submit, and post via the shared cz_newsletter_signup AJAX
 * handler). The overlay/panel show-hide animation and desktop hide
 * (min-width:481px) live in assets/css/responsive-style.css; the
 * .nl-drawer-* content typography (eyebrow/title/input/submit/agree/thanks)
 * lives in theme.css.
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
