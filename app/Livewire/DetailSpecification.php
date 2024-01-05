<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class DetailSpecification extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();

        return view('livewire.detail-specification', [
            'product' => $product
        ]);
    }
}
