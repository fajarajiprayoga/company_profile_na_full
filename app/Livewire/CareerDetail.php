<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\Footer;
use App\Models\Plant;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class CareerDetail extends Component
{
    public $title, $plant;
    public $metadescription, $metakeyword;

    public function mount($title, $plant){
        $this->title = $title;
        $this->plant = Plant::where('name', str_replace('-', ' ', $plant))->first();
    }

    #[Title("New Armada Career")]
    public function render()
    {
        $footer = Footer::first();
        $job = Job::where('slug', $this->title)->where('available', 1)->where('plant_id', $this->plant->id)->first();

        $this->metadescription = "Join our dynamic team as a $job->title at PT Mekar Armada Jaya (New Armada). Explore exciting career opportunities, competitive salaries, and growth potential. Apply Today!";
        $this->metakeyword = "$job->title New Armada, $job->title PT Mekar Armada Jaya, New Armada $job->title Career, PT Mekar Armada $job->title Career, New Armada $job->title Job, PT Mekar Armada $job->title Job, Loker $job->title New Armada, Loker $job->title PT Mekar Armada Jaya";

        return view('livewire.career-detail', [
            'footer' => $footer,
            'job' => $job
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
