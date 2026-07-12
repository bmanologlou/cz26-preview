<?php
/**
 * Template Name: Contact
 *
 * Ported from contact.html — contact-hero, contact-network and
 * contact-form-section. The hero/network sections are static and ported
 * verbatim (including source inline styles, per the section's static-copy
 * scope). The raw <form id="custom-contact-form" action="send_email.php">
 * is replaced with a Contact Form 7 shortcode — CF7 handles mail via
 * wp_mail() instead of the source's PHPMailer/send_email.php.
 *
 * See wp-theme/CF7-SETUP.md for the exact form to create in wp-admin
 * (update the shortcode id="" below to match whatever ID CF7 assigns on
 * save) and wp-theme/carbon-zapp/assets/css/cf7-overrides.css for the
 * styling that reproduces the source form's look on top of CF7's default
 * markup.
 *
 * @package Carbon_Zapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="contact-hero" style="max-width:1440px;margin:0 auto;padding:12px 80px 0;margin-top:var(--nav-h);">
	<div class="contact-hero-card" style="border-radius:4px;overflow:hidden;background:#000;display:grid;grid-template-columns:2fr 3fr;height:460px;">
		<div class="contact-hero-copy" style="padding:80px 48px 48px;display:flex;flex-direction:column;justify-content:flex-start;background:#000;">
			<div style="font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.22em;text-transform:uppercase;color:#ED1C24;margin-bottom:12px;">Global Connection</div>
			<h1 style="font-family:'Gunterz',sans-serif;font-size:38px;line-height:1.05;color:#f5f3ef;margin-bottom:16px;">Let's <span style="color:#ED1C24;">Connect</span></h1>
			<p style="font-size:14px;font-weight:200;line-height:1.65;color:rgba(245,243,239,.5);max-width:380px;">We are constantly growing our global network. Connect with us and learn how we can support your vision and fulfil your market's needs.</p>
		</div>
		<div class="contact-hero-media" style="overflow:hidden;">
			<img src="<?php echo esc_url( CZ_THEME_URI . '/assets/images/cz_hero_contact.webp' ); ?>" alt="Carbon Zapp Global Network" style="width:100%;height:100%;object-fit:cover;object-position:right center;display:block;">
		</div>
	</div>
</div>

<!-- GLOBAL NETWORK + CONTACT INFO -->
<div class="contact-network" style="max-width:1440px;margin:0 auto;padding:96px 80px;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start;">
	<div>
		<div style="font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:#ED1C24;margin-bottom:12px;">Carbon Zapp Global Network</div>
		<h2 style="font-family:'Gunterz',sans-serif;font-size:36px;line-height:1.05;color:#f5f3ef;margin-bottom:24px;">5 Continents.<br>98+ Countries</h2>
		<p style="font-size:15px;font-weight:300;line-height:1.75;color:rgba(245,243,239,.6);margin-bottom:16px;">Carbon Zapp is an independently owned company with entities in Greece and Germany, and a vast network and presence in all 5 continents and over 98 countries worldwide.</p>
		<p style="font-size:15px;font-weight:300;line-height:1.75;color:rgba(245,243,239,.6);margin-bottom:32px;">With a logistics centre in Athens, Greece, Carbon Zapp can effectively export its products globally in all 5 continents and over 98 countries worldwide.</p>
		<a href="<?php echo esc_url( CZ_THEME_URI . '/assets/pdfs/CZ_GLOBAL_REPR.pdf' ); ?>" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:8px;font-family:'Public Sans',sans-serif;font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#ED1C24;text-decoration:none;border:1px solid rgba(237,28,36,.4);padding:10px 20px;">Contact Our Global Network</a>
	</div>
	<div>
		<div style="padding:28px 0;border-bottom:1px solid rgba(255,255,255,.06);">
			<div style="font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:rgba(245,243,239,.3);margin-bottom:10px;">Sales Enquiries</div>
			<p style="font-size:13px;color:rgba(245,243,239,.45);line-height:1.6;margin-bottom:8px;">For product information, pricing, and distribution opportunities.</p>
			<a href="mailto:sales@carbonzapp.com" style="display:block;font-size:14px;color:rgba(245,243,239,.7);text-decoration:none;margin-bottom:4px;">sales@carbonzapp.com</a>
		</div>
		<div style="padding:28px 0;">
			<div style="font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:rgba(245,243,239,.3);margin-bottom:10px;">General</div>
			<p style="font-size:13px;color:rgba(245,243,239,.45);line-height:1.6;margin-bottom:8px;">For press, partnerships, and other enquiries.</p>
			<a href="mailto:info@carbonzapp.com" style="display:block;font-size:14px;color:rgba(245,243,239,.7);text-decoration:none;margin-bottom:4px;">info@carbonzapp.com</a>
			<a href="tel:+302109856110" style="display:block;font-size:14px;color:rgba(245,243,239,.7);text-decoration:none;margin-bottom:8px;">+30 210 985 6110</a>
			<p style="font-size:13px;color:rgba(245,243,239,.45);line-height:1.6;">Mon&ndash;Fri, 08:00&ndash;16:00 (UTC+2)<br>Isiodou 18 (Industrial Park)<br>194 00 Koropi, Attica &mdash; Greece</p>
		</div>
	</div>
</div>

<!-- CONTACT FORM -->
<div class="contact-form-section" style="background:#000;border-top:1px solid rgba(255,255,255,.06);">
	<div class="contact-form-inner" style="max-width:1440px;margin:0 auto;padding:96px 80px;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start;">
		<div>
			<h2 style="font-family:'Gunterz',sans-serif;font-size:36px;line-height:1.05;color:#f5f3ef;margin-bottom:16px;">Contact Us</h2>
			<p style="font-size:14px;font-weight:300;line-height:1.7;color:rgba(245,243,239,.5);">Fill in the form and a member of the Carbon Zapp team will get back to you shortly.</p>
		</div>
		<div class="cz-cf7-contact-wrap">
			<?php echo do_shortcode( '[contact-form-7 id="6" title="Contact"]' ); ?>
		</div>
	</div>
</div>

<?php
get_footer();
