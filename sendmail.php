<?php
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//phpinfo();
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
if($_POST)
{
	$mail = new PHPMailer(true);
// Instantiation and passing `true` enables exceptions

	//include('Pear Mail/mail.php');

	$to_email = "info@offroadcycles.co.za"; //Recipient email, Replace with own email here
	
	//Sanitize input data using PHP filter_var().
	$firstName		= filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
	$email		= filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$phoneNumber		= filter_var($_POST["phoneNumber"], FILTER_SANITIZE_STRING);
	$message		= filter_var($_POST["message"], FILTER_SANITIZE_STRING);
	$product = filter_var($_POST["product"], FILTER_SANITIZE_STRING);

	//email body
	$message_body = 
	"First Name: ".$firstName
	."<br/>Phone Number : ".$phoneNumber
	."<br/>Email : ".$email
	."<br/>Product : ".$product
	."<br/>Message : ".$message
	;
	

	$mail->IsSMTP();
	$mail->SMTPDebug = 2;                                       // Enable verbose debug output                                          // Set mailer to use SMTP
    $mail->Host       = 'mail.offroadcycles.co.za'; 				// Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'website@offroadcycles.co.za';               // SMTP username
    $mail->Password   = 'WebsiteEmails';                     // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

	$mail->addReplyTo($email, $firstName);
    $mail->setFrom('website@offroadcycles.co.za', 'Website Contact Form');
	$mail->addAddress('info@offroadcycles.co.za', 'Off Road Cycles');     // Add a recipient
	$mail->addAddress('emailtertiusbergh@gmail.com', 'Test'); 
	 	

    //$mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');
   $mail->isHTML(true);                                  // Set email format to HTML
   $mail->Subject = 'Website Contact Form';
   $mail->Body    = $message_body;
   $mail->AltBody = ' ';

   $send_mail = $mail->send();

	
if(!$send_mail)
	{
		//If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
		$output = json_encode(array('type'=>'error', 'text' => '<p>Could not send mail! Please check your PHP mail configuration.</p>'));
		die($output);
	 }else{
	 	$output = json_encode(array('type'=>'message', 'text' => '<div class="alert alert-success" role="alert">
	 	Hi '.$user_name .', Thank you very much for your message,we will contact you soon.</div>'));
	 	die($output);
	 }
}
?>