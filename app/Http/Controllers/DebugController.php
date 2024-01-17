<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class DebugController extends Controller
{
    public function tesmail()
    {
        require base_path("vendor/autoload.php");

        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = 'ssl://mail.mekararmadajaya.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAutoTLS = false;
        $mail->Port = 465;
        $mail->Username = 'official1_admin@mekararmadajaya.com';
        $mail->Password = "adm@RM4D4";

        //Recipients
        $senderEmail = 'official1_admin@mekararmadajaya.com';
        $senderName = 'Debug SMTP Mail';
        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress('fajar.prayoga@students.amikom.ac.id', 'Faja Aji Prayoga');
        //Content
		$mail->isHTML(true);
		$mail->Subject = 'Kode OTP E-Katalog';
		$mail->Body = "<h1>Tes SMPT Email</h1>";

        if($mail->send()){
            echo "Email was send";
        }else{
            $msg = 'Mailer Error: ' . $mail->ErrorInfo;
            echo $msg;
        }   
    }
}
