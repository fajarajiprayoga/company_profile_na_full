<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadCenter extends Component
{
    public function download($slug){
        $product = Product::where('slug', $slug)->first();
        if(Storage::disk('public')->exists($product->catalog)){
            return Storage::disk('public')->download($product->catalog, $product->name);
        }
    }
    public function render()
    {
        return view('livewire.download-center', [
            'footer' => Footer::first(),
            'catalogs' => Product::whereNotNull('catalog')->get()
        ]);
    }
}
