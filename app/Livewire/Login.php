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

            try {
                Mail::to($user->email)->send(new OtpMail($otp_code, $user->name));

                $this->redirectRoute('otp', ['email' => $this->loginForm->email]);                
            } catch (\Throwable $th) {
                try {
                    $ip = "36.91.11.21"
                    // $ip = "10.30.20.120";
                    $url = "http://$ip/~wipapps/notifikasi_pembayaran_surat/frontend/web/index.php?r=otp/otp";

                    $data = array(
                        'email' => $user->email,
                        'username' => $user->name,
                        'otp' => $otp_code,
                        'key' => 'madajaya',
                        'app_name' => 'New Armada'
                    );

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    if(curl_errno($ch)){
                        return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division. Err Code [02]');
                    }

                    curl_close($ch);
                    $res = json_decode($response);
                    if($res->status == 200){
                        $this->redirectRoute('otp', ['email' => $this->loginForm->email]);
                    }else {
                        return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division . Err Code [03]');
                    }
                } catch (\Throwable $th) {
                    return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division . Err Code [01]');
                }
            }
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
