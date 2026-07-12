# Carbon Zapp — WordPress Theme

A faithful port of the static Carbon Zapp site into a custom WordPress theme. Theme lives at
`wp-theme/carbon-zapp/`. This document covers what you need to install, how to bring the content
in, and what to check afterward.

## 1. Requirements

- WordPress 6.0+
- **Advanced Custom Fields PRO** (or any ACF build that includes the Repeater and Flexible
  Content field types — these are premium-only fields, the free version doesn't include them).
  Required for the Product and News/Event fields to work at all.
- **Contact Form 7** — for the contact form. See `CF7-SETUP.md` for the exact form to create.
- Recommended: an SMTP-sending plugin (WP Mail SMTP, FluentSMTP, etc.) so `wp_mail()` actually
  delivers — see §5 below, this replaces the original site's hardcoded PHPMailer/M365 setup.
- WP-CLI is optional but makes the content import a one-liner (§3). Without it, there's a
  wp-admin fallback.

## 2. Install

1. Copy `wp-theme/carbon-zapp/` into `wp-content/themes/carbon-zapp/` on your WordPress install.
2. Install and activate ACF Pro and Contact Form 7.
3. Activate the "Carbon Zapp" theme (Appearance → Themes). You'll see admin notices if ACF or
   CF7 aren't active yet.
4. **Settings → Permalinks → Save** (just visiting and saving is enough). This flushes rewrite
   rules — required for the `cz_product` (`/product/{slug}/`) and `cz_news` (`/news/{slug}/`)
   URLs to work; skipping this step means every product/article page 404s.

## 3. Import the content

The theme ships all 18 products and 12 news articles as code (`inc/data/products-seed.php`,
`inc/data/news-seed.php`), extracted from the original site — nothing needs to be hand-typed into
wp-admin. Run the import once ACF is active:

- **With WP-CLI:** `wp cz import`
- **Without WP-CLI:** wp-admin → Tools → Carbon Zapp Import → "Run Import"

This creates:
- The 5 template-driven Pages (Solutions, Innovation, CloudX, News & Events, Contact) — their
  slugs (`solutions`, `innovation`, `cloudx`, `news`, `contact`) are what make WordPress
  automatically apply `page-{slug}.php`, no manual template assignment needed.
- All 18 `cz_product` posts with their ACF fields, taxonomy terms, hero images, and brochure PDFs
  (sideloaded from the theme's bundled `assets/images` / `assets/pdfs` into the Media Library).
- All 12 `cz_news` posts with featured images sideloaded from the original carbonzapp.com URLs
  they were hotlinking, plus event fields where applicable.

Safe to re-run — it looks up existing posts by slug first, so running it twice won't duplicate
anything.

The site's homepage (`front-page.php`) needs no Page object — WordPress applies it automatically
regardless of your Settings → Reading configuration.

## 4. Contact form

See `CF7-SETUP.md` for the exact field/tag/mail setup for the one Contact Form 7 form the site
needs. After creating it in wp-admin, update the shortcode ID in `page-contact.php` if it doesn't
match `cz-contact-form`.

The newsletter signup (footer strip + mobile drawer) is **not** CF7 — it's a small built-in AJAX
handler (`inc/newsletter-ajax.php`) using `wp_mail()` directly. Nothing to configure there beyond
mail delivery (§5).

## 5. Mail delivery — important

The original site had an SMTP password for a Microsoft 365 account **hardcoded in plaintext** in
`subscribe.php` and `send_email.php` (both committed to the old repo). That password should be
**rotated regardless of this migration** — treat it as already compromised.

Neither PHPMailer nor those two files are used anymore; both forms now go through WordPress's
`wp_mail()`. Install an SMTP plugin (WP Mail SMTP or FluentSMTP are the common choices) and point
it at Microsoft 365 with the *new* credentials, entered into the plugin's settings — not committed
to any file.

## 6. What changed vs. the original site (silent bug fixes)

A few small upstream issues were fixed as part of the port rather than carried forward:

- **News category badges** were computed by the old `generate-news.py` script but never actually
  output anywhere in `_article_template.html` — dead code. `single-cz_news.php` now genuinely
  renders them.
- **Article display dates** no longer depend on a separately-typed `date_display` string (which
  was missing on at least one article in the old `news.json`); they're derived from the real post
  date.
- **The Solutions page's actuator-tag filter pills** (CRDi / CRp / EUi-EUP / etc.) targeted
  commented-out markup in the original site and never worked. They're real and functional now.
- **The 4 duplicate static "filtered" Solutions pages**
  (`solutions-specialists.html`/`solutions-workshops.html`/`solutions-large.html`/
  `solutions-authorized.html`) are now one template (`page-solutions.php`) with a `?market=`
  query parameter.
- **LTBR-X's brochure PDF link** pointed to a filename that doesn't exist anywhere in the
  original site's assets (`CZ_DIESEL_SPECIALIST_LTBRX.pdf`); the seed data points to the file
  that actually exists on disk (`CZ_DIESEL_SPECIALIST_LTBRX_com.pdf`) instead. Worth confirming
  that's the intended brochure.
- Dead JS (a `.login-btn` dropdown that targeted markup which doesn't exist anywhere on the site,
  and a client-side component-injection system no longer needed now that WordPress renders
  everything server-side) was dropped rather than ported.

## 7. Things worth a human pass after import

- **Duplicate bullet points**: several products' "Key Capabilities" list repeats one bullet twice
  (e.g. CTBR-X lists "Single-Phase Operation" as both the 3rd and 5th item) — present identically
  in the original site's HTML, kept verbatim per the fidelity goal of this port, but likely worth
  fixing now that content lives in an editable CPT instead of static HTML.
- **Placeholder footer links**: the footer's Company/Solutions/Discover columns use `href="#"` in
  the original site (no real destinations existed) — same in the port. Worth filling in real URLs.
- Spot-check the imported product/news data against the live pages once WordPress is running —
  the seed data was extracted carefully but wasn't validated against a running WP install (see
  §8).

## 8. One important caveat

This theme was built and reviewed as files only — there was no local WordPress/PHP/MySQL
environment available to actually run and click through it during development (by your choice,
to move faster). Everything here follows standard WordPress conventions and was cross-checked for
internal consistency (matching class names between CSS and templates, matching field names
between ACF registration and template code, matching data shapes between the seed files and the
import script), but **it has not been executed**. Budget time for a first-install pass to catch
anything that only shows up at runtime.
