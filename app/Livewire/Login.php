<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\Validate; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Login extends Component
{
    use WireToast;
    public LoginForm $loginForm;
    public $isLoading = false;

    public function login(Request $request)
    {
        require base_path("vendor/autoload.php");

        $this->loginForm->validate(); 
        
        $checkAuth = Auth::attempt([
            'email' => $this->loginForm->email,
            'password' => $this->loginForm->password,
        ], $this->loginForm->remember);
        
        if($checkAuth == True){
            Auth::logout();
            $otp_code = mt_rand(100000,999999);
			$exp_otp_code = date('Y-m-d H:i:s', strtotime('+10 minutes')); //OTP 10 Minutes

            $user = User::where('email', $this->loginForm->email)->first();
            $user->otp = $otp_code;
            $user->otp_expired = $exp_otp_code;
            $user->update();

            // Mail::to($user->email)->send(new OtpMail($otp_code, $user->name));

            $mail = new PHPMailer();
				// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
				// $mail->isSMTP();
				// $mail->Host = 'sandbox.smtp.mailtrap.io';
				// $mail->SMTPAuth = true;
				// $mail->Port = 2525;
				// $mail->Username = '897bc8d1cb3468';
				// $mail->Password = '1cf6e3a2fd59b7';

				$mail->IsSMTP();
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
				$mail->Password = 'adm@RM4D4';

				//Recipients
				$senderEmail = 'official1_admin@mekararmadajaya.com';
				$senderName = 'Company Profile New Armada';
				$mail->setFrom($senderEmail, $senderName);
				$mail->addAddress($user->email, $user->name);

				//Content
				$mail->isHTML(true);
				$mail->Subject = 'Kode OTP E-Katalog';
				$mail->Body = "
					<div>
						<h3>Kode Verifikasi Login Company Profile New Armada</h3>
					</div>
					<div>
						<span>Halo $user[name],</span>
					</div>
					<div style='padding-top: 10px; padding-bottom: 10px;'>
						<span>Silahkan masukkan kode OTP ini untuk dapat melanjutkan menggunakan aplikasi New Armada.</span>
					</div>
					<div style='background-color: #e3e3e3; padding: 15px;'>
						<span>OTP</span>
						<h4>$otp_code</h4>
						<span>Kode ini berlaku selama 10 menit.<span>
					</div>
					<div style='padding-top: 10px; padding-bottom: 10px;'>
						<span>Jaga keamanan akun Anda dengan tidak membagikan kode OTP kepada siapapun.</span>
					</div>
					<span>Terimakasih.</span>
				";
				$mail->AltBody = 'OTP Company Profile New Armada = ' . $otp_code;
                if(!$mail->send()){
                    return redirect()->route('login')->with('failed', 'Login failed, pleas try again');        
                }else{
                    $this->redirectRoute('otp', ['email' => $this->loginForm->email]);
                }            
			    // $this->redirectRoute('otp', ['email' => $this->loginForm->email]);

        }else {
            return redirect()->route('login')->with('failed', 'Login failed, pleas try again');
        }
    }

    public function handleClick()
    {
        $this->isLoading = true;
    }

    public function render()
    {
        if(Auth::check()){
            $this->redirectRoute('home');
        }
        return view('livewire.login');
    }
}
