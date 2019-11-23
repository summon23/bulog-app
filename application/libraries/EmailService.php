<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {  
    public function sendMail($options = array())
    {
        $mail = new PHPMailer(true);
        // Passing `true` enables exceptions
		try {
            if (!array_key_exists('to', $options) ||
            !array_key_exists('name', $options) ||
            !array_key_exists('subject', $options) ||
            !array_key_exists('body', $options)) {
                // echo "ss";
                throw new Exception('Options Failure, Please check all options requirment');
            }
			//Server settings
			// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = MAIL_USERNAME;                 // SMTP username
			$mail->Password = MAIL_PASSWORD;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $systemAddress = MAIL_DEFAULTADDRESS;
            $systemName = MAIL_DEFAULTNAME;

            if (array_key_exists($options, 'from_address')){
                $systemAddress = $options['from_address'];
            }

            if (array_key_exists($options, 'from_name')){
                $systemName = $options['from_name'];
            }
			$mail->setFrom($systemAddress, $systemName);
			$mail->addAddress($options['to'], $options['name']);     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $options['subject'];
			$mail->Body    = $options['body'];
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
			// echo 'Message has been sent';
		} catch (Exception $e) {
            throw($e);
            // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            return $e;
		}
    }    

    /**
	 * MJML FILE HERE
	 */
}