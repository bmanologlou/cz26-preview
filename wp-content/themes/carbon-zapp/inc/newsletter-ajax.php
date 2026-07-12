<?php
/**
 * Newsletter subscribe handler. Replaces the original subscribe.php +
 * hardcoded PHPMailer/M365 SMTP credentials with wp_mail() (configure an
 * SMTP plugin such as WP Mail SMTP for real delivery — see wp-theme/README.md).
 *
 * Consolidates the 3 separate newsletter UIs in the source site (footer
 * strip, mobile drawer, per-page inline handlers) onto this single endpoint.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_handle_newsletter_signup() {
	check_ajax_referer( 'cz_newsletter', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ), 400 );
	}

	$to      = apply_filters( 'cz_newsletter_recipient', 'newsletter@carbonzapp.com' );
	$subject = 'New Newsletter Subscriber';
	$body    = sprintf(
		"New newsletter subscription.\n\nEmail: %s\nDate: %s",
		$email,
		current_time( 'mysql' )
	);
	$headers = array( 'Reply-To: ' . $email );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( ! $sent ) {
		wp_send_json_error( array( 'message' => 'Something went wrong. Please try again later.' ), 500 );
	}

	wp_send_json_success( array( 'message' => 'Thanks for subscribing.' ) );
}
add_action( 'wp_ajax_cz_newsletter_signup', 'cz_handle_newsletter_signup' );
add_action( 'wp_ajax_nopriv_cz_newsletter_signup', 'cz_handle_newsletter_signup' );
