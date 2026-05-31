<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Clean and sanitize the form inputs
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // 2. Set your configuration variables
    $recipient = "your-email@example.com"; // <-- CHANGE TO YOUR EMAIL
    $subject   = "New Contact Form Submission from $name";

    // 3. Validate that the data isn't empty
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit
        http_response_code(400);
        echo "Please complete the form and provide a valid email address.";
        exit;
    }

    // 4. Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. Build the email headers
    // Using the recipient email as "From" avoids spoofing triggers on your server, 
    // while "Reply-To" ensures you reply directly to the user.
    $headers = "From: $recipient\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. Send the email
    if (mail($recipient, $subject, $email_content, $headers)) {
        // Set a 200 (success) response code
        http_response_code(200);
        echo "Thank you! Your message has been sent successfully.";
    } else {
        // Set a 500 (internal server error) response code
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>