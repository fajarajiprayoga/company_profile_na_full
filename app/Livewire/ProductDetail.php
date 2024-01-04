<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public function mount($slug){
        $product = Product::where('slug', $slug)->first();
        $this->product = $product;
    }
    public function render()
    {
        $footer = Footer::first();
        return view('livewire.product-detail', [
            'footer' => $footer
        ]);
    }
}
