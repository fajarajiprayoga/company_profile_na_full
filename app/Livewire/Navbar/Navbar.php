<?php

namespace App\Livewire\Navbar;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $transparent;
    public function render()
    {
        return view('livewire.navbar.navbar', [
            'transparent' => $this->transparent
        ]);
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('home');
    }
}
