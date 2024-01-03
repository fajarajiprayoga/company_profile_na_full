<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $footer = \App\Models\Footer::get()->first();

        return view('livewire.footer', [
            'footer' => $footer
        ]);
    }
}
