<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Job;
use App\Models\Plant;
use Livewire\Component;
use Livewire\WithPagination;

class Career extends Component
{
    use WithPagination;

    public $search = '';
    public $search_plant;
    public $search_type = '';

    public function render()
    {
        $jobs = Job::where('available', 1)
        ->where('title', 'LIKE' ,'%'.$this->search.'%')
        ->where('type', 'LIKE' ,'%'.$this->search_type.'%')
        ->where('plant_id', 'LIKE', '%'.$this->search_plant.'%')
        ->orderBy('updated_at', 'desc')
        ->orderBy('created_at', 'desc')
        ->simplePaginate(10);
        $plants = Plant::all();
        $footer = Footer::first();
        return view('livewire.career',[
            'footer' => $footer,
            'jobs' => $jobs,
            'plants' => $plants
        ]);
    }
}
