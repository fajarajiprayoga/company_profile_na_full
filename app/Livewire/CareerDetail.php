<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\Footer;
use App\Models\Plant;
use Illuminate\Support\Str;

class CareerDetail extends Component
{
    public $title, $plant;
    public function mount($title, $plant){
        $this->title = str_replace('-', ' ', $title);
        $this->plant = Plant::where('name', str_replace('-', ' ', $plant))->first();
    }
    public function render()
    {
        $footer = Footer::first();
        $job = Job::where('title', $this->title)->where('available', 1)->where('plant_id', $this->plant->id)->first();
        return view('livewire.career-detail', [
            'footer' => $footer,
            'job' => $job
        ]);
    }
}
