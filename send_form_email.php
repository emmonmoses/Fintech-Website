<?php
if(isset($_POST['emails'])) {  // Changed the post to the name of the submit button
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "rnjega@ciafrica.com";
    $email_subject = "EBIRR NOTIFICATION";
	$email_from = "support@krcsdro.com";        //Send to an already registered Email ID
	$mail_msg = "";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||        
        !isset($_POST['telephone']) ||
        !isset($_POST['message']) ||
        !isset($_POST['subject'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // required
    $telephone = $_POST['telephone']; // not required
    $subject = $_POST['subject']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
  $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$message)) {
    $error_message .= 'The message you entered does not appear to be valid.<br />';
  }
 
  if(strlen($telephone) < 2) {
    $error_message .= 'The number you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
  $email_message = "Form details below.\n\n";
 
     
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }
 
     
 
  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Subject: ".clean_string($subject)."\n";
  $email_message .= "Email: ".clean_string($email)."\n";
  $email_message .= "Telephone: ".clean_string($telephone)."\n";
  $email_message .= "Message: ".clean_string($message)."\n";
    
    $msg = "<div style=\"color:black\">".$email_message."</div>";
 
    $headers  = "MIME-Version: 1.0\r\n";        //Changed the headers
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	

	$headers .= "From:".$email_from. "\r\n" .
	"Cc: rnjega@ciafrica.com";
	if(mail($email_to,$email_subject,$msg,$headers)){
		$mail_msg = 'Sent Successfully.';
	}
	else{
		$mail_msg = 'Error Sending.';
	}
 
    echo "Msg : ".$mail_msg;
}


  //<!-- include your own success html here -->

 

?>