<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use Livewire\Component;
use App\Models\Type;

class Product extends Component
{
    public $type_id = '';
    public $type_name = '';

    public function mount(){
        $type = Type::first();
        if(!empty($type)){
            $this->type_id = $type->id;
            $this->type_name = $type->name;
        }
    }

    public function type($id){
        $type = Type::where('id', $id)->first();
        $this->type_id = $type->id;
        $this->type_name = $type->name;
    }
    public function render()
    {
        $types = Type::all();
        $products = \App\Models\Product::where('type_id', $this->type_id)->get();
        $footer = Footer::first();
        return view('livewire.product', [
            'types' => $types,
            'products' => $products,
            'footer' => $footer
        ]);
    }
}
