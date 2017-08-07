<?php

// Modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require './vendor/autoload.php';
require './transport.php';

// Instantiate a new PHPMailer 
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// If you're using Amazon SES in a Region other than US West (Oregon), 
// replace email-smtp.us-east-1.amazonaws.com with the Amazon SES SMTP  
// endpoint in the appropriate Region.
$mail->Host = 'email-smtp.us-east-1.amazonaws.com';

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = $aws_ses_user;

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = $aws_ses_pw;

// Enable SSL encryption
$mail->SMTPSecure = 'ssl';

// The port you will connect to on the Amazon SES SMTP endpoint.
$mail->Port = 465;

// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
$mail->setFrom('ellen.manuszak@gmail.com', 'Ellen');

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress('ellen.manuszak@gmail.com', 'Ellen');

$sender_name = $_POST['name'];
$sender_email = $_POST['email'];
$sender_message = $_POST['message'];

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The subject line of the email
$mail->Subject = $sender_name . ' says hello from hiellen.com';

// The HTML-formatted body of the email
$body = "<h1>New message from " . $sender_name . "</h1>";
$body .= $sender_email . "\n";
$body .= "<p>" . $sender_message . "</p>";


$mail->Body = $body;

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a 
// line break.
$mail->AltBody = "Email Test\r\nThis email was sent through the 
Amazon SES SMTP interface using the PHPMailer class.";

if(!$mail->send()) {
    echo 'Email not sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message successfully sent!';
}