# Carbon Zapp WordPress Theme — Build Schema

This is the shared contract every template/file in this build must follow. Read this before
writing any theme file. Theme slug: `carbon-zapp`. Text domain: `carbon-zapp`. Theme root:
`wp-theme/carbon-zapp/`.

## Golden rule: fidelity, not reinterpretation

Copy exact text content, exact section order, and exact CSS class names from the source HTML
files in the repo root (one level up from `wp-theme/`). Do not invent new class names, rewrite
copy, or redesign sections. Where the source uses inline `style="..."` for one-off visual details
(bullet dots, mono labels, etc.), convert those to real CSS classes in `assets/css/theme.css`
using the same values, rather than carrying inline styles into PHP templates.

## Design tokens (assets/css/theme.css `:root`)

```css
:root{
  --black:#0a0a0a;
  --white:#f5f3ef;
  --grey:#ebebeb;
  --grey-mid:#e4e4e4;
  --carbon:#0a0a0a;
  --steel:#3e3e3d;
  --mid:#868685;
  --light:#dadadb;
  --accent:#ED1C24;
  --accent2:#146cf7;
  --text:#1a1a1a;
  --text-light:rgba(26,26,26,.5);
  --nav-h:68px;
}
```

Fonts: Gunterz (headings, self-hosted, `assets/fonts/`), Public Sans (body, self-hosted variable),
Switzer (nav links / stat values, self-hosted variable), DM Mono (eyebrows/labels, Google Fonts
CDN `https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,300;0,400;0,500;1,400&display=swap`).
Enqueue all via `wp_enqueue_style` on `wp_enqueue_scripts`, `@font-face` rules for self-hosted
fonts live in `theme.css`.

Drop the dead mega-menu CSS (`.mega`, `.nav-item .mega`, `.mega-col`, `.mega-links`) — it's unused
in the source site (flat nav only, no dropdown).

## Custom Post Types

### `cz_product`
- Labels: "Products" / "Product"
- `public: true`, `has_archive: false`, `show_in_rest: true`, `menu_icon: 'dashicons-admin-tools'`
- `rewrite: ['slug' => 'product']` → single URLs `/product/{slug}/`
- `supports: ['title']` (no native editor content — all fields are ACF; title = model name e.g. "LTBR-X")
- Template: `single-cz_product.php`
- Taxonomy: `cz_actuator` (non-hierarchical, tag-style), terms: CRDi (`crdi`), CRp (`crp`), EUi/EUP
  (`eui-eup`), HEUi (`heui`), Engine (`engine`), GDi Inj (`gdi-inj`), EFi (`efi`), GDi Pump
  (`gdi-pump`) — matches `data-act` values from `solutions.html`'s filter pills.

### `cz_news`
- Labels: "News & Events" / "Article"
- `public: true`, `has_archive: false`, `show_in_rest: true`, `menu_icon: 'dashicons-megaphone'`
- `rewrite: ['slug' => 'news']` → single URLs `/news/{slug}/`
- `supports: ['title', 'editor', 'excerpt', 'thumbnail']` (native `post_content` = article body,
  native excerpt = card teaser, native featured image = article/card image)
- Template: `single-cz_news.php`
- Taxonomy: `cz_news_category` (non-hierarchical), terms: Events (`events`), News (`news`),
  Innovation (`innovation`) — a post can have multiple (source data shows some articles tagged
  both `news` and `innovation`).

## ACF Field Groups (register in PHP via `acf_add_local_field_group` in `inc/acf-fields.php` — no
UI import needed, fields ship as code)

### Group: Product Fields — location: `cz_product`
| Field name | Type | Notes |
|---|---|---|
| `category_label` | text | eyebrow, e.g. "Large Engines Diesel Test Bench" |
| `tagline` | textarea | 1–2 line hero subtitle |
| `market` | select | choices: `specialists` : Specialists, `workshops` : Workshops |
| `authorized` | true_false | VDO/Continental authorized flag |
| `hero_slides` | repeater | sub-field `image` (image, return format: array) — 2–4 rows |
| `key_capabilities` | repeater | sub-field `text` (text) — bullet list, 4–5 rows |
| `intro_disclaimer` | textarea | optional, only some products (e.g. CTBR-X "more info being prepared") |
| `product_details_url` | url | external `carbonzapp.com/specialists/...` link |
| `brochure_pdf` | file | return format: array |
| `card_image` | image | thumbnail used on the Solutions catalog grid |
| `card_description` | text | one-line desc for the catalog card |
| `card_bg` | select | choices: `none` : None, `blue` : Blue (maps to `.bg-blue` modifier) |
| `sections` | flexible_content | see layouts below |

**`sections` layouts** (used for the optional rich body — Overview, Industry Applications, Testing
Capabilities, Hardware Engineering, Diagnostic Intelligence, Software & Connectivity, OEM
Ecosystem, Closing Statement — simple products like CTBR-X have zero rows, flagship products like
LTBR-X have ~7):

**Layout `content_block`** (covers Overview / Industry Applications / OEM Ecosystem / Closing
Statement / Software & Connectivity — all share the same eyebrow+heading+body+optional-list shape
in the source):
| Sub-field | Type |
|---|---|
| `eyebrow` | text |
| `heading` | text |
| `body` | wysiwyg (or textarea with `new_lines: wpautop`) |
| `list_style` | select: `none`, `dot`, `check` |
| `list_title` | text (optional, e.g. "Coverage includes") |
| `list_items` | repeater → sub-field `text` |
| `highlight_text` | text (optional callout line, e.g. "Complete Coverage. Complete Confidence...") |

**Layout `cards_block`** (covers Testing Capabilities / Hardware Engineering / Diagnostic
Intelligence — numbered or coded card grids):
| Sub-field | Type |
|---|---|
| `eyebrow` | text |
| `heading` | text |
| `intro` | textarea (optional) |
| `cards` | repeater → sub-fields `label` (text, e.g. "01" or "IC"), `title` (text), `body` (textarea) |

### Group: Event Fields — location: `cz_news`
| Field name | Type | Notes |
|---|---|---|
| `event_date_display` | text | free-text as shown, e.g. "April 23–26, 2026" (source data is inconsistently formatted; keep verbatim for display) |
| `event_start` | date_picker | storage `Ymd`, used for sorting/countdown — required whenever `event_date_display` is set |
| `event_end` | date_picker | storage `Ymd`, optional |
| `event_location` | text | |
| `event_link` | url | optional, external exhibition site |

Show this group only for posts tagged `cz_news_category = events` (ACF conditional logic on
taxonomy isn't native — just always register the group on `cz_news` and instruct the template to
render the event card only when `event_date_display` is non-empty).

## Reference source → destination map

| Source file(s) | Destination |
|---|---|
| `_nav.html` | `template-parts/header.php` |
| `_footer.html` | `template-parts/footer.php` |
| `_footer-cta.html` | `template-parts/footer-cta.php` |
| `_newsletter-drawer.html` | `template-parts/newsletter-drawer.php` |
| `components.js` | `assets/js/main.js` (adapt: nav active-state via `is_page()`/`is_front_page()` PHP checks instead of JS pathname matching; drop dead `.login-btn` dropdown code; keep scroll class toggle + newsletter drawer open/close) |
| `index.html` | `front-page.php` |
| `solutions.html` + `solutions-specialists.html` + `solutions-workshops.html` + `solutions-large.html` + `solutions-authorized.html` | `page-solutions.php` (one template, `market`/`authorized` filtering via `$_GET` query var instead of 4 duplicate static files) |
| `innovation.html` | `page-innovation.php` |
| `cloudx.html` | `page-cloudx.php` |
| `cznews.html` | `page-news.php` |
| `contact.html` | `page-contact.php` |
| `product-{slug}.html` (18 canonical files, see list below) | `single-cz_product.php` + `inc/data/products-seed.php` |
| `_article_template.html` + `news.json` | `single-cz_news.php` + `inc/data/news-seed.php` |
| `shared.css` + `responsive-style.css` + `mobile-nav.css` + inline `<style>` blocks | `assets/css/theme.css` |

**Canonical 18 product files** (ignore `*-backup*`, `*-old`, `*-v2` variants):
`product-ctbrx.html`, `product-dgfrx.html`, `product-dsrx.html`, `product-epx.html`,
`product-esx.html`, `product-etbrx.html`, `product-fst.html`, `product-gdrx.html`,
`product-gdu4rx.html`, `product-gs4.html`, `product-gs8.html`, `product-gtb4rx.html`,
`product-htbrx.html`, `product-itb1rx.html`, `product-itb4rx.html`, `product-ltbrx.html`,
`product-mtbrx.html`, `product-ptbrx.html`.

## WordPress Pages the import script must create

| Slug | Title | Template used automatically (page-{slug}.php) |
|---|---|---|
| (site front page — no Page object needed, `front-page.php` applies automatically) | | |
| `solutions` | Solutions | `page-solutions.php` |
| `innovation` | Innovation | `page-innovation.php` |
| `cloudx` | CloudX | `page-cloudx.php` |
| `news` | News & Events | `page-news.php` |
| `contact` | Contact | `page-contact.php` |

## Forms (Contact Form 7)

Two CF7 forms, referenced by shortcode. Do not port PHPMailer — CF7 handles mail via `wp_mail()`.
1. **Contact form** — fields: `name`* (text), `email`* (email), `country` (text), `company`
   (text), `phone` (tel), `message`* (textarea). Mail to: `sales@carbonzapp.com`, Reply-To: `[email]`.
2. **Newsletter form** — single field: `email`* (email). Mail to: `newsletter@carbonzapp.com`,
   Reply-To: `[email]`. Used in 3 places (footer strip, mobile drawer, any inline CTA) — same CF7
   form ID reused via `[contact-form-7 id="..." title="Newsletter"]` in each location; consolidate
   the 3 separate front-end JS implementations in the source into one shared handler in
   `assets/js/main.js`.

Document the exact CF7 form template text (Step 9 task) so the user can paste it into the plugin
after install — CF7 forms can't be created by static theme files alone (they're stored as a CPT
in the DB), so this ships as setup documentation + optionally a PHP snippet using
`wpcf7_contact_form::save()` in the import script for full automation.

## Navigation

`register_nav_menus(['primary' => 'Primary Navigation'])`. `wp_nav_menu` with a `fallback_cb` that
prints the hardcoded default link set (Home / Solutions / Innovation / CloudX / News / Contact,
plus the Store/Login `nav-actions` buttons) so the header works before the user configures a menu
in wp-admin. Active state via `is_front_page()`, `is_page('solutions')` (with a special case: any
`cz_product` single or the 4 old filtered-market views should also mark Solutions active), etc. —
no client-side pathname matching needed since PHP already knows the current page.

## Known upstream bugs to fix silently during the port (mentioned for changelog awareness, not
extra scope)

- News category badges (`ARTICLE_CATS` equivalent) were computed but never rendered in the
  original article template — wire them up for real in `single-cz_news.php` using
  `cz_news_category` terms.
- `date_display` fallback: derive display date from the real `post_date` (via
  `get_the_date('j M Y')`) instead of requiring a separately-typed display string.
- Dead `.login-btn`/`.login-dropdown` JS in `components.js` — do not port, markup doesn't exist.
- Dead actuator-filter JS on `solutions.html` (targets commented-out markup) — the WP version's
  filter pills should be real and functional against `cz_actuator` terms.
