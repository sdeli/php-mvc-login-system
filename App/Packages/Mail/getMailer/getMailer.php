<?php
namespace App\Packages\Mail\getMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config as Config;

trait getMailer 
{
    public static function getMailer($to, $name, $subject, $text, $html) {
        $mailer = new PHPMailer(true);

        //$mailer->SMTPDebug = 2;                                 // Enable verbose debug output
        $mailer->isSMTP();                                      // Set mailer to use SMTP
        $mailer->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
        $mailer->SMTPAuth = true;                               // Enable SMTP authentication
        $mailer->Username = Config::EMAIL_ADDR_USER_NAME;                 // SMTP username
        $mailer->Password = Config::EMAIL_ADDR_PASSWORD;                           // SMTP password
        $mailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        //$mailer->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mailer->setFrom(Config::EMAIL_ADDR_FROM, Config::EMAILERS_NAME);
        $mailer->addAddress($to, $name);     // Add a recipient
        //$mailer->addAddress('ellen@example.com');               // Name is optional
        //$mailer->addReplyTo('info@example.com', 'Information');
        //$mailer->addCC('cc@example.com');
        //$mailer->addBCC('bcc@example.com');
    
        //Attachments
        //$mailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mailer->isHTML(true);                                  // Set email format to HTML
        $mailer->Subject = $subject;
        $mailer->Body    = $html;
        $mailer->AltBody = $text;

        return $mailer;
    }
}