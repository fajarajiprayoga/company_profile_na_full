<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $tabDetail;
    public function mount($slug){
        $product = Product::where('slug', $slug)->first();
        $this->product = $product;

        $this->tabDetail = 'interior';
    }
    public function tab($name){
        $this->tabDetail = $name;
    }
    public function catalog($slug){
        $product = Product::where('slug', $slug)->first();
        if(Storage::disk('public')->exists($product->catalog)){
            return Storage::disk('public')->download($product->catalog, $product->name);
        }
    }
    public function render()
    {
        $footer = Footer::first();
        return view('livewire.product-detail', [
            'footer' => $footer
        ]);
    }
}
