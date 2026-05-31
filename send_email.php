<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize all incoming fields
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $country = strip_tags(trim($_POST["country"]));
    $company = strip_tags(trim($_POST["company"]));
    $phone   = strip_tags(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // 2. CONFIGURATION: Set your destination email address here
    $recipient = "sales@carbonzapp.com"; 
    $subject   = "New Website Operation Inquiry from $name";

    // 3. Validation check for required fields
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill in all required fields (*) with a valid email address.";
        exit;
    }

    // 4. Construct cleanly formatted email body
    $email_content = "You have received a new contact form submission:\n\n";
    $email_content .= "Full Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Country: " . (!empty($country) ? $country : "Not Provided") . "\n";
    $email_content .= "Company: " . (!empty($company) ? $company : "Not Provided") . "\n";
    $email_content .= "Phone: " . (!empty($phone) ? $phone : "Not Provided") . "\n\n";
    $email_content .= "Message/Operational Needs:\n$message\n";

    // 5. Anti-spam email headers 
    // Sending "From" your domain's server email stops it from getting blocked.
    // "Reply-To" ensures hitting reply goes straight to the sender's input email.
    $headers = "From: $recipient\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. Attempt execution
    if (mail($recipient, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent successfully.";
    } else {
        http_response_code(500);
        echo "Server error: Could not send email. Please try again later.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission. Method not allowed.";
}
?>