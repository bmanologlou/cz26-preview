<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ensure these paths correctly point to where you uploaded your PHPMailer source files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize incoming fields
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $country = strip_tags(trim($_POST["country"]));
    $company = strip_tags(trim($_POST["company"]));
    $phone   = strip_tags(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // 2. Validate required fields
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill in all required fields (*) with a valid email address.";
        exit;
    }

    // 3. Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // --- SMTP CONFIGURATION FOR MICROSOFT 365 ---
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host       = 'smtp.office365.com';             // M365 SMTP Server
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'noreply@carbonzapp.com';         // Authenticated Sender Username
        $mail->Password   = 'Carb0nZapp2026!#';               // Authenticated Sender Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Required encryption for port 587
        $mail->Port       = 587;                              // TCP port to connect to

        // --- SENDER & RECIPIENT ---
        // Microsoft 365 forces the "From" address to match the authenticated account (noreply)
        $mail->setFrom('noreply@carbonzapp.com', 'Carbon Zapp Contact Form'); 
        
        // This is where the contact form details are sent
        $mail->addAddress('sales@carbonzapp.com');
        
        // When your sales team clicks "Reply", it automatically drafts to the prospect's email
        $mail->addReplyTo($email, $name); 

        // --- EMAIL CONTENT ---
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = "New Website Operation Inquiry from $name";
        
        // Construct cleanly formatted email body
        $email_content = "You have received a new contact form submission:\n\n";
        $email_content .= "Full Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Country: " . (!empty($country) ? $country : "Not Provided") . "\n";
        $email_content .= "Company: " . (!empty($company) ? $company : "Not Provided") . "\n";
        $email_content .= "Phone: " . (!empty($phone) ? $phone : "Not Provided") . "\n\n";
        $email_content .= "Message/Operational Needs:\n$message\n";

        $mail->Body = $email_content;

        // 4. Send the email
        $mail->send();
        
        http_response_code(200);
        echo "Thank you! Your message has been sent successfully.";
        
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission. Method not allowed.";
}
?>