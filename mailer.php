<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once "lib/swiftmailer/lib/swift_required.php";

$sender_name = $_POST['name'];
$sender_email = $_POST['email'];
$sender_website = $_POST['website'];
$sender_message = $_POST['message'];

$subject = $sender_name . ' says hello from hiellen.com';
$from = array($sender_email => $sender_name);
$to = array(
 'ellen.manuszak@gmail.com'  => 'Ellen Manuszak'
);

$text = "Sender Website: " . $sender_website . "\n";
$text .= "Message: " . $sender_message . "\n";

$html = "<em>Sender Website".$sender_website."</em><br/>";
$html .= "<em>Sender Message".$sender_message."</em>";

$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
$transport->setUsername('ellen.manuszak@gmail.com');
$transport->setPassword('dtp9aqtnpKdbKsUJLYrbVw');
$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
$message->addPart($text, 'text/plain');

if ($recipients = $swift->send($message, $failures))
{
 echo 'Message successfully sent!';
} else {
 echo "There was an error:\n";
 print_r($failures);
}

?>