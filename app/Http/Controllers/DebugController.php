<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class DebugController extends Controller
{
    public function underconstruction(){
        return view('under_construction');
    }
    public function tesmail()
    {
        require base_path("vendor/autoload.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = 'ssl://mail.newarmada.co.id';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAutoTLS = false;
        $mail->Port = 465;
        $mail->Username = 'official1_admin@newarmada.co.id';
        $mail->Password = "adm@RM4D4";

        //Recipients
        $senderEmail = 'official1_admin@newarmada.co.id';
        $senderName = 'Debug SMTP Mail';
        $mail->setFrom($senderEmail, $senderName);
        
        $recipients = [
            [
                'email' => 'fajar.aji.prayoga@newarmada.co.id',
                'name' => 'Fajar Aji Prayoga'
            ],
            [
                'email' => 'itmekararmadajaya@gmail.com',
                'name' => 'Fajar Aji Prayoga'
            ],
        ];
        
        foreach($recipients as $recipient){
            $mail->addAddress($recipient['email'], $recipient['name']);
        }
        
        //Content
		$mail->isHTML(true);
		$mail->Subject = 'Debug SMPT Mail';
		$mail->Body = "<h1>Tes SMPT Email</h1>";

        if($mail->send()){
            echo "Email was send";
        }else{
            $msg = 'Mailer Error: ' . $mail->ErrorInfo;
            echo $msg;
        }   
    }
    public function tesmaillaravel(){
        Mail::to('fajar.prayoga@students.amikom.ac.id')->send(new OtpMail('1234', 'Fajar'));
    }
}
