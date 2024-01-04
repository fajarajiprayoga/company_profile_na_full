<?php

namespace App\Livewire\Navbar;

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
}
