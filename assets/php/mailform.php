<?php

// Modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require './vendor/autoload.php';
require './transport.php';

$sender_name = $_POST['name'];
$sender_email = $_POST['email'];
$sender_message = $_POST['message'];

// Instantiate a new PHPMailer 
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->Host = $aws_host;
$mail->SMTPAuth = true;
$mail->Username = $aws_ses_user;
$mail->Password = $aws_ses_pw;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('ellen@cactus.works', 'Ellen');

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress('ellen@cactus.works', 'Ellen');

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The subject line of the email
$mail->Subject = "[hiellen/cactus.works] " . $sender_name . " says hello";

// The HTML-formatted body of the email
$body = "<h1>New message from " . $sender_name . "</h1>";
$body .= $sender_email . "\n";
$body .= "<p>" . $sender_message . "</p>";

$mail->Body = $body;

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a 
// line break.
$mail->AltBody = "New message from " . $sender_name . "\r\n" . $sender_message . "\r\n";

if(!$mail->send()) {
    echo 'Email not sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message successfully sent!';
    $mail->clearAddresses();
    
    // Second Copy
    $mail->addAddress($sender_email, $sender_name);
    $mail->Subject = "Your message to Ellen";
    // The HTML-formatted body of the email
    $body = '<h1 style="color:#e51041;font-family: Futura, Franklin Gothic Medium,Trebuchet MS,serif;">Thank you for reaching out!</h1>';
    $body .= '<p style="font-family:Futura, Franklin Gothic Medium,Trebuchet MS,serif;font-size:14px;">Below is a copy of your sent message:</p>';
    $body .= '<p style="font-family:Palatino Linotype, Palatino, serif;font-size:14px;border-left:#e51041 solid 10px;padding-left:15px;color:#666666;">' . $sender_message . '</p>';
    $body .= '<p style="font-family:Futura, Franklin Gothic Medium,Trebuchet MS,serif;font-size:14px;">I will try to respond to your email as quickly as possible but please be patient and allow five business days for a reply.</p>';
    $body .= '<p style="font-family:Futura, Franklin Gothic Medium,Trebuchet MS,serif;font-size:14px;">All the best,<br>Ellen Manuszak</p>';
    $body .= '<p style="font-family:Futura, Franklin Gothic Medium,Trebuchet MS,serif;font-size:12px;">You are receiving this email because you submitted the contact form on hiellen.com/cactus.works.</p>';
    
    $mail->Body = $body;
    
    $mail->send();

}

