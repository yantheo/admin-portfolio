<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "library/PHPMailer-master/src/Exception.php";
require "library/PHPMailer-master/src/PHPMailer.php";
require "library/PHPMailer-master/src/SMTP.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === "POST"){
  if (empty($_POST['email'])) {
    $errors[] = 'Email is empty';
  } else {
    $email = $_POST['email'];
    // validating the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email';
    }
  }
  if (empty($_POST['subject'])) {
    $errors[] = 'subject is empty';
  } else {
    $subject = $_POST['subject'];
  }
  if (empty($_POST['message'])) {
    $errors[] = 'Message is empty';
  } else {
    $message = $_POST['message'];
  }
  if (empty($errors)){
	$mail = new PHPMailer(true);
	$mail->CharSet    = 'UTF-8';
	$mail->Encoding   = 'base64';
	try{
		$mail->isSMTP();
		$mail->SMTPDebug = 2; 
		$mail->Host = "smtp.yanicktheodose.site";
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = "contact@yanicktheodose.site";
		$mail->Password = "Monaco1986";
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
		$mail->setFrom('contact@yanicktheodose.site');
		$mail->addAddress('yanick.theodose@gmail.com');
		$mail->isHTML(true);
		//Message 
		$mail->Subject =  $subject . " from " . $email;
		$mail->Body = $message;
		$mail->send();
		echo 'Message has been sent';
	}catch (Exception $e){
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";	
	}
	}
}


