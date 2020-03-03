<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
//require 'PHPMailer/PHPMailerAutoload.php';

class SendMail
{

    public $mail;

    /*public function __construct()
    {
		//$this->mail = new PHPMailer; 
		//$this->mail->isSMTP(); 
		// $this->mail->SMTPDebug = 2; 
		$this->mail->Debugoutput = 'html'; 
		$this->mail->Host = 'smtp.gmail.com'; 
		$this->mail->Port = 587; 
		$this->mail->SMTPSecure = 'tls'; 
		$this->mail->SMTPAuth = true; 
		$this->mail->Username = "ajay.genextwebs@gmail.com"; 
		$this->mail->Password = "ser_12345";
		$this->mail->CharSet = 'UTF-8';
        $this->mail->isHTML(true);
    }*/

    /*public function sendTo($toEmail, $recipientName, $subject, $msg)
    {
        $this->mail->setFrom($this->mail->Username,'Ajay');
        $this->mail->addAddress($toEmail, $recipientName);
        $this->mail->isHTML(true); 
        $this->mail->Subject = $subject;
        $this->mail->Body = $msg;
        if (!$this->mail->send()) {
            log_message('error', 'Mailer Error: ' . $this->mail->ErrorInfo);
            return false;
        }
        $this->mail->clearAllRecipients();
        return true;
    }*/

    public function sendTo($toEmail, $recipientName, $subject, $msg){
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom('project165.system@gmail.com', "PMS");
        $email->setSubject($subject);
        $email->addTo($toEmail,$recipientName);
        $email->addContent("text/html", $msg);
        $sendgrid = new \SendGrid('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
            ');
        try {
            $response = $sendgrid->send($email);
           /* print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";*/
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

}
