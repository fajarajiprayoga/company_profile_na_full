<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use Livewire\Component;
use App\Models\Type;

class Product extends Component
{
    public $type_id;
    public $type_name;
    public $searched;
    
    //Search Feature
    public $keywoard;
    protected $queryString = ['keywoard'];

    public function mount(){
        $type = Type::first();
        if(!empty($type)){
            $this->type_id = $type->id;
            $this->type_name = $type->name;
        }

        if(!empty($this->keywoard)){
            $this->searched = \App\Models\Product::where('name', 'LIKE', '%'.$this->keywoard.'%')->orWhere('slug', 'LIKE', '%'.$this->keywoard.'%')->orWhere('description', 'LIKE', '%'.$this->keywoard.'%')->orWhere('height', 'LIKE', '%'.$this->keywoard.'%')->orWhere('width', 'LIKE', '%'.$this->keywoard.'%')->orWhere('length', 'LIKE', '%'.$this->keywoard.'%')->orWhere('lighting', 'LIKE', '%'.$this->keywoard.'%')->orWhere('couches', 'LIKE', '%'.$this->keywoard.'%')->orWhere('interior', 'LIKE', '%'.$this->keywoard.'%')->orWhere('exterior', 'LIKE', '%'.$this->keywoard.'%')->orWhere('driver_station', 'LIKE', '%'.$this->keywoard.'%')->get();
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
            'footer' => $footer,
            'searched' => $this->searched
        ]);
    }
}
