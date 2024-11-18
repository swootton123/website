<?php
// Replace with your SMTP configuration
$smtpHost = "smtp.gmail.com"; // SMTP server
$smtpPort = 587; // TSS Port number
$smtpUsername = "your_email@example.com"; // SMTP email
$smtpPassword = "your_email_password"; // SMTP password

// Get form data
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Setup email headers and content
$to = $smtpUsername; // Your email address (recipient)
$subject = "New Contact Us Message from $name";
$body = <<<EOD
You have received a new message.

Contact Details:
Name: $name
Email: $email

Message:
$message
EOD;

$headers = "From: $email";

// SMTP settings using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUsername;
    $mail->Password   = $smtpPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $smtpPort;

    // Recipients
    $mail->setFrom($smtpUsername, 'DVO-AI Contact Form');
    $mail->addAddress($to);

    // Content
    $mail->isHTML(false); // Plain text format
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    echo "Thank you! Your message has been sent successfully.";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
