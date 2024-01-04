<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        $footer = Footer::first();
        $contacts = \App\Models\Contact::all();
        return view('livewire.contact', [
            'footer' => $footer,
            'contacts' => $contacts
        ]);
    }
}
