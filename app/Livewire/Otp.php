<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\User;
use App\Livewire\Forms\OtpForm;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Otp extends Component
{
    public $email; //Get Parameter URL
    public $user; //Get user data by $email
    public OtpForm $otpForm;
    public $isLoading = false;

    public function mount(){
        $this->user = User::where('email', Crypt::decrypt($this->email))->first();
        if(Auth::check() || Carbon::now() > Carbon::parse($this->user->otp_expired)){
            $this->redirectRoute('login');
        }
    }

    public function otp(){
        if($this->user->otp == $this->otpForm->otp && Carbon::now() < Carbon::parse($this->user->otp_expired) == true){
            Auth::login($this->user);
            if(Auth::check()){
                session()->flash('login-success', 'Login success');
                $this->redirectRoute('home');
            }
        }else {
            session()->flash('otp-failed', 'Verification failed, please try again');
            $this->redirectRoute('otp', ['email' => $this->email]);
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
        return view('livewire.otp');
    }
}
