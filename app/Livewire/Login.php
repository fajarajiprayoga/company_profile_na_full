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


class Login extends Component
{
    use WireToast;
    public LoginForm $loginForm;

    public function login(Request $request)
    {
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

            Mail::to($user->email)->send(new OtpMail($otp_code, $user->name));

            $this->redirectRoute('otp', ['email' => $this->loginForm->email]);

        }else {
            return redirect()->route('login')->with('failed', 'Login failed, pleas try again');
        }
    }

    public function render()
    {
        if(Auth::check()){
            $this->redirectRoute('home');
        }
        return view('livewire.login');
    }
}
