<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize subscription email
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    // 2. Fallback validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please provide a valid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // --- SMTP CONFIGURATION FOR MICROSOFT 365 ---
        $mail->isSMTP();                                      
        $mail->Host       = 'smtp.office365.com';             
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'noreply@carbonzapp.com';         
        $mail->Password   = 'Carb0nZapp2026!#';               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
        $mail->Port       = 587;                              

        // --- SENDER & RECIPIENT ---
        $mail->setFrom('noreply@carbonzapp.com', 'Carbon Zapp Portal'); 
        $mail->addAddress('newsletter@carbonzapp.com'); // Sending the subscriber data to the newsletter team

        $mail->addReplyTo($email);                 // Conveniently reply straight to subscriber if needed

        // --- EMAIL CONTENT ---
        $mail->isHTML(false); 
        $mail->Subject = "New Newsletter Subscriber Joined";
        
        $email_content = "Great news! A user has requested to join your audience loop via the web portal:\n\n";
        $email_content .= "Subscriber Email: $email\n";
        $email_content .= "Timestamp: " . date("Y-m-d H:i:s") . "\n";

        $mail->Body = $email_content;

        $mail->send();
        
        http_response_code(200);
        echo "Thank you for subscribing to the Carbon Zapp Newsletter";
        
    } catch (Exception $e) {
        http_response_code(500);
        echo "Could not save subscription at this moment.";
    }

} else {
    http_response_code(403);
    echo "Method not allowed.";
}
?>