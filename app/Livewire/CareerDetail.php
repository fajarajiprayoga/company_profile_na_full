<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\Footer;
use Illuminate\Support\Str;

class CareerDetail extends Component
{
    public $title;
    public function mount($title){
        $this->title = str_replace('-', ' ', $title);
    }
    public function render()
    {
        $footer = Footer::first();
        $job = Job::where('title', $this->title)->where('available', 1)->first();
        return view('livewire.career-detail', [
            'footer' => $footer,
            'job' => $job
        ]);
    }
}
