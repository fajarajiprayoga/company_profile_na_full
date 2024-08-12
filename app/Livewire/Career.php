<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Job;
use App\Models\Plant;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Career extends Component
{
    use WithPagination;

    public $search = '';
    public $search_plant;
    public $search_type = '';

    public $metadescription = "Join our dynamic team at PT Mekar Armada Jaya (New Armada). Explore exciting career opportunities, competitive salaries, and growth potential. Apply Today!";
    public $metakeyword = "New Armada Career, PT Mekar Armada Career, New Armada Job, PT Mekar Armada Job, Recruitment New Armada, Recruitment PT Mekar Armada, Loker New Armada, Loker PT Mekar Armada Jaya";

    #[Title("New Armada Career")]
    public function render()
    {
        $jobs = Job::where('available', 1)
        ->where('title', 'LIKE' ,'%'.$this->search.'%')
        ->where('type', 'LIKE' ,'%'.$this->search_type.'%')
        ->where('plant_id', 'LIKE', '%'.$this->search_plant.'%')
        ->orderByRaw("FIELD(type, 'staff', 'supervisor', 'manager', 'leader', 'support')")
        ->paginate(10);
        $plants = Plant::all();
        $footer = Footer::first();
        return view('livewire.career',[
            'footer' => $footer,
            'jobs' => $jobs,
            'plants' => $plants
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
