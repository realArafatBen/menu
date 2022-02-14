<?php 
// Include phpmailer file ----------------------
require_once 'PHPMailer/PHPMailerAutoload.php';
require_once 'PHPMailer/class.phpmailer.php';


function sendEmail($toEm, $emSubj, $bodyContent){
	# Connect to SMTP Server 
	$mail = new PHPMailer;
	$mail->isSMTP();                            		// Set mailer to use SMTP
	$mail->Host = 'mail.jubileesys.com';             	// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     		// Enable SMTP authentication
	$mail->Username = 'info@jubileesys.com';  // SMTP username
	$mail->Password = 'WeDon'tKnow1'; 					// SMTP password
	$mail->SMTPSecure = 'ssl';                  		// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                          		// TCP port to connect to
	
	# Configur Mail Paramenter
	$mail->setFrom('info@jubileesys.com', 'Jubilee Systems');	
	$mail->addAddress($toEm);   						// Add a recipient	
	$mail->isHTML(true);  								// Set email format to HTML	
	$mail->Subject = $emSubj;
	$mail->Body    = $bodyContent;
	
	if(!$mail->send()) {
		//echo ' Without Email.';
		//echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'With Email.';
	}

}

?>