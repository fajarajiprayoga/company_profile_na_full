<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use App\Models\Maps;
use App\Models\Product;
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

        $show_in_home_products = Product::where('show_in_home', 1)->get();

        $galleries = Gallery::where('show', 1)->get();

        $maps = Maps::all();

        return view('livewire.home', [
            'sliders' => $arr_sliders,
            'show_in_home_products' => $show_in_home_products,
            'galleries' => $galleries,
            'maps' => $maps
        ]);
    }
}
