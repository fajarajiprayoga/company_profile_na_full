<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\InstagramPost as ModelsInstagramPost;
use Livewire\Component;

class InstagramPost extends Component
{
    public function render()
    {
        $instagram_username = Footer::get()->first()['instagram_username'];
        $instagram_post = ModelsInstagramPost::get();

        return view('livewire.instagram-post', [
            'instagram_username' => $instagram_username,
            'instagram_post' => $instagram_post
        ]);
    }
}
