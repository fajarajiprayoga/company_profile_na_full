<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        $galleries = \App\Models\Gallery::where('show', 1)->get();
        $instagram_username = Footer::get()->first()['instagram_username'];
        return view('livewire.gallery', [
            'galleries' => $galleries,
            'instagram_username' => $instagram_username
        ]);
    }
}
