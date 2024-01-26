<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\Footer;

class CareerDetail extends Component
{
    public $id;
    public function mount($id){
        $this->id = Crypt::decrypt($id);
    }
    public function render()
    {
        $footer = Footer::first();
        $job = Job::where('id', $this->id)->where('available', 1)->first();
        return view('livewire.career-detail', [
            'footer' => $footer,
            'job' => $job
        ]);
    }
}
