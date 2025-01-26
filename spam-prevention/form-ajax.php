<?php

function handle_custom_contact_form_submission() {
    // Verify the honeypot field
    if (!empty($_POST['honeypot'])) {
        wp_send_json_error('Spam detected.');
        exit;
    }

    // Verify the form token
    if (!isset($_POST['form_token']) || !wp_verify_nonce($_POST['form_token'], 'custom_contact_form')) {
        wp_send_json_error('Invalid form submission.');
        exit;
    }

    // Validate required fields
    if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['message'])) {
        wp_send_json_error('Required fields are missing.');
        exit;
    }

    // Sanitize and validate inputs
    $full_name = sanitize_text_field($_POST['full_name']);
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone_number']);
    $message = sanitize_textarea_field($_POST['message']);

    if (!is_email($email)) {
        wp_send_json_error('Invalid email address.');
        exit;
    }

    if (strlen($full_name) > 100 || strlen($company) > 100 || strlen($message) > 500) {
        wp_send_json_error('Field length exceeded.');
        exit;
    }

    // Email details
    $to = 'info@weblifter.com.au'; // Replace with your email
    $subject = 'New Contact Form Submission';
    $body = "You have received a new message from your website:\n\n";
    $body .= "Full Name: $full_name\n";
    $body .= "Company: $company\n";
    $body .= "Email: $email\n";
    $body .= "Phone Number: $phone_number\n";
    $body .= "Message:\n$message\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    // Send the email
    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success('Your message has been sent successfully.');
    } else {
        wp_send_json_error('Failed to send your message.');
    }
}
add_action('wp_ajax_submit_contact_form', 'handle_custom_contact_form_submission');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_custom_contact_form_submission');