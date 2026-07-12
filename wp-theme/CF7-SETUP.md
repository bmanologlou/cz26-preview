# Contact Form 7 setup

Theme files cannot create Contact Form 7 forms — CF7 forms are a custom post
type (`wpcf7_contact_form`) stored in the database, not shipped as code. After
installing and activating the **Contact Form 7** plugin, create the one form
below in wp-admin under **Contact > Add New**.

There is only **one** CF7 form on this site. The newsletter signup is **not**
a CF7 form — see "Newsletter signup" at the bottom of this document.

## Form 1 — "Contact"

Used by `wp-theme/carbon-zapp/page-contact.php`, which renders it via:

```php
[contact-form-7 id="cz-contact-form" title="Contact"]
```

CF7 assigns its own numeric/hash ID when you save the new form (the `id`
attribute on the shortcode CF7 shows you in wp-admin after saving may differ
from `cz-contact-form`). **After creating the form, open
`wp-theme/carbon-zapp/page-contact.php` and update the `id="cz-contact-form"`
attribute in the shortcode to whatever ID/shortcode CF7 actually generated**
(or, simpler: give the form the title "Contact" and just paste CF7's own
generated shortcode over the placeholder — either works, CF7 matches by
`id`, and title is only for display in the admin list).

### Form tab (paste into the "Form" editor tab)

The wrapper `<div>`/`<label>` markup below reproduces the source
`contact.html` field layout (two-column rows, uppercase mono labels) so that
`assets/css/cf7-overrides.css` can target it. Do not change the class names
or the field names (`name`, `email`, `country`, `company`, `phone`,
`message`) — the mail template and CSS both depend on them.

```html
<div class="cz-contact-form-row">
  <div class="cz-contact-form-field">
    <label class="cz-contact-form-label">Full Name *</label>
    [text* name placeholder "John Smith"]
  </div>
  <div class="cz-contact-form-field">
    <label class="cz-contact-form-label">Email Address *</label>
    [email* email placeholder "john@company.com"]
  </div>
</div>

<div class="cz-contact-form-row">
  <div class="cz-contact-form-field">
    <label class="cz-contact-form-label">Country</label>
    [text country placeholder "United Kingdom"]
  </div>
  <div class="cz-contact-form-field">
    <label class="cz-contact-form-label">Company</label>
    [text company placeholder "Company Name"]
  </div>
</div>

<div class="cz-contact-form-field">
  <label class="cz-contact-form-label">Phone Number</label>
  [tel phone placeholder "+44 ..."]
</div>

<div class="cz-contact-form-field">
  <label class="cz-contact-form-label">How can we help *</label>
  [textarea* message placeholder "Tell us about your operation and what you're looking for..."]
</div>

[submit "Submit"]
```

Field reference (matches `contact.html`'s `<form id="custom-contact-form">`
exactly — required fields carry the `*` CF7 marks and the source's
`required` attribute; optional fields have neither):

| Field | Type | CF7 tag | Required | Placeholder | Label text |
|---|---|---|---|---|---|
| name | text | `[text* name placeholder "John Smith"]` | yes | John Smith | Full Name * |
| email | email | `[email* email placeholder "john@company.com"]` | yes | john@company.com | Email Address * |
| country | text | `[text country placeholder "United Kingdom"]` | no | United Kingdom | Country |
| company | text | `[text company placeholder "Company Name"]` | no | Company Name | Company |
| phone | tel | `[tel phone placeholder "+44 ..."]` | no | +44 ... | Phone Number |
| message | textarea | `[textarea* message placeholder "Tell us about your operation and what you're looking for..."]` | yes | Tell us about your operation and what you're looking for... | How can we help * |

### Mail tab

Ported from `send_email.php`'s PHPMailer template (the original mailed
`sales@carbonzapp.com` from `noreply@carbonzapp.com`, plain text, with the
prospect's email as Reply-To so the sales team can hit "Reply" directly):

- **To:** `sales@carbonzapp.com`
- **From:** `Carbon Zapp Contact Form <noreply@carbonzapp.com>` (use whatever
  address your SMTP sender is authenticated as — see the SMTP note below;
  Microsoft 365 will reject a From address that doesn't match the
  authenticated account)
- **Subject:** `New Website Operation Inquiry from [name]`
- **Additional Headers:** `Reply-To: [email]`
- **Message body:**

  ```
  You have received a new contact form submission:

  Full Name: [name]
  Email: [email]
  Country: [country]
  Company: [company]
  Phone: [phone]

  Message/Operational Needs:
  [message]
  ```

  Note: the source PHP substituted "Not Provided" for blank optional fields
  (country/company/phone); CF7 mail tags just render empty when a field is
  blank. This is a cosmetic difference only — add a mail-tag conditional
  plugin (e.g. "CF7 Conditional Fields") later if you want to reproduce that
  exact fallback text, it is not required for the form to work correctly.

- Leave the "Message Body (HTML)" toggle **off** — the source sent
  plain-text mail (`$mail->isHTML(false)`), so leave CF7's Mail tab on plain
  text to match.

### Confirmation / on-screen messages

Set these under the "Messages" tab to match the tone of the source's
JS-driven `#form-response` div ("Thank you! Your message has been sent
successfully." / "Message could not be sent...") — exact wording is up to
you since CF7 renders its own inline success/error text, there's no
functional requirement to match the old copy verbatim.

## Newsletter signup — NOT a CF7 form

The three newsletter signup UIs on the source site (footer strip, mobile
drawer, and any inline CTA) are **not** ported to Contact Form 7. They are
already wired to a single custom AJAX endpoint implemented in
`wp-theme/carbon-zapp/inc/newsletter-ajax.php`:

- Action: `cz_newsletter_signup` (registered for both `wp_ajax_` and
  `wp_ajax_nopriv_`), nonce `cz_newsletter` (localized to the front end as
  `czAjax` in `inc/enqueue.php`).
- Mails `newsletter@carbonzapp.com` via `wp_mail()`, Reply-To the
  subscriber's address — the same recipient/reply-to convention as the
  source's `subscribe.php`.

There is nothing to create in wp-admin for this — do not build a second CF7
form for it. It's called out here only so it's clear why this document
describes just one CF7 form despite the source site having two separate
"forms" (contact + newsletter).

## Mail delivery / SMTP — security note

Both `send_email.php` and `subscribe.php` in the source repo have a live
Microsoft 365 SMTP password **hardcoded in plaintext and committed to the
repo**:

```php
$mail->Username = 'noreply@carbonzapp.com';
$mail->Password = 'Carb0nZapp2026!#';
```

**Rotate this password** (change it on the Microsoft 365 account) regardless
of whether/when the WordPress migration ships — it has been sitting in
version control and must be treated as compromised.

Neither `send_email.php`/PHPMailer nor this hardcoded credential is ported
to WordPress: CF7 and the newsletter AJAX handler both send through
`wp_mail()`, which by default uses PHP's `mail()` and will not reliably
deliver through Microsoft 365. For real delivery, install an SMTP plugin
(**WP Mail SMTP** or **FluentSMTP**) and point it at Microsoft 365
(`smtp.office365.com:587`, STARTTLS, the rotated `noreply@carbonzapp.com`
credentials). Store those credentials in the SMTP plugin's own settings (or
as `wp-config.php` constants / server environment variables if the plugin
supports that) — never commit mail credentials to a theme file or any other
file in this repo.
