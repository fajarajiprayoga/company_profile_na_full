<?php

namespace App\Livewire\Footer;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $footer = \App\Models\Footer::get()->first();

        return view('livewire.footer.footer', [
            'footer' => $footer
        ]);
    }
}
