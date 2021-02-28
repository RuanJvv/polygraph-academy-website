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

	$to_email = "deon@polygraphacademy.co.za"; //Recipient email, Replace with own email here
	
	//Sanitize input data using PHP filter_var().
    $name	= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $id	= filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $maritial	= filter_var($_POST["maritial"], FILTER_SANITIZE_STRING);
    $convictions	= filter_var($_POST["convictions"], FILTER_SANITIZE_STRING);
    $dependants	= filter_var($_POST["dependants"], FILTER_SANITIZE_STRING);
    $email	= filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $address	= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $postal	= filter_var($_POST["postal"], FILTER_SANITIZE_STRING);
    $disabilities	= filter_var($_POST["disabilities"], FILTER_SANITIZE_STRING);
    $companyname	= filter_var($_POST["companyname"], FILTER_SANITIZE_STRING);
    $employment	= filter_var($_POST["employment"], FILTER_SANITIZE_STRING);
    $position	= filter_var($_POST["position"], FILTER_SANITIZE_STRING);
    $field	= filter_var($_POST["field"], FILTER_SANITIZE_STRING);
    $payer	= filter_var($_POST["payer"], FILTER_SANITIZE_STRING);
    $companyaddress	= filter_var($_POST["companyaddress"], FILTER_SANITIZE_STRING);
    $qualification	= filter_var($_POST["qualification"], FILTER_SANITIZE_STRING);
    $experience	= filter_var($_POST["experience"], FILTER_SANITIZE_STRING);
    $message	= filter_var($_POST["message"], FILTER_SANITIZE_STRING);

	//email body
	$message_body = 
	"Full Name and Surname: ".$name
	."<br/>ID Number : ".$id
	."<br/>Maritial Status : ".$maritial
	."<br/>Criminal Convictions : ".$convictions
    ."<br/>Dependants : ".$dependants
    ."<br/>Email Address : ".$email
    ."<br/>Cell Number : ".$cell
    ."<br/>Residental Address : ".$address
    ."<br/>Postal Address : ".$postal
    ."<br/>Disabilities : ".$disabilities
    ."<br/>Company Name : ".$companyname
    ."<br/>Current Position : ".$position
    ."<br/>Current Field Of Employment : ".$field
    ."<br/>Company Payer Details : ".$payer
    ."<br/>Company Address : ".$companyaddress
    ."<br/>Highest Qualification : ".$qualification
    ."<br/>Experience : ".$experience
    ."<br/>Message : ".$message
	;
	

	$mail->IsSMTP();
	$mail->SMTPDebug = 2;                                       // Enable verbose debug output                                          // Set mailer to use SMTP
    $mail->Host       = 'mail.polygraphacademy.co.za'; 				// Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'website@polygraphacademy.co.za';               // SMTP username
    $mail->Password   = 'WebsiteEmails';                     // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

	$mail->addReplyTo($email, $firstName);
    $mail->setFrom('website@polygraphacademy.co.za', 'Website Registration Form');
	$mail->addAddress('info@polygraphacademy.co.za', 'Polygraph Academy');     // Add a recipient
	 	

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