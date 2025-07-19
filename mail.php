<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$title = "New message";
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$subject = "New Message";
$body = "Name: $name\nEmail: $email\nMessage:\n$message";

$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;

  $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
  $mail->Username   = 'example@chrisbowers.xyz';                     //SMTP username
  $mail->Password   = 'none';                               //SMTP password
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->setFrom('example@chrisbowers.xyz', $title);
  $mail->addAddress('example@chrisbowers.xyz');
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  $mail->send();
  http_response_code(200);
  echo "Message sent successfully!";
} catch (Exception $e) {
  http_response_code(500);
  echo "Failed to send the message. Try again";
}
