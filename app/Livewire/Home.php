<?php

namespace App\Livewire;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $sliders = Slider::all();
        $arr_sliders = [];
        foreach ($sliders as $key => $slider){
            $arr_sliders[$key]['title'] = $slider->title;
            $arr_sliders[$key]['file_name'] = $slider->file_name;
            if(Storage::exists('public/'.$slider->file_name)){
                $extension = pathinfo($slider->file_name, PATHINFO_EXTENSION);
                $arr_sliders[$key]['ext'] = $extension;
            }
        }

        return view('livewire.home', [
            'sliders' => $arr_sliders
        ]);
    }
}
