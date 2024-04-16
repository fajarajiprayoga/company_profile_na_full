<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use Livewire\Component;
use App\Models\Type;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;

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

        if(!empty($_GET['model'])){
            $type = Type::where('name', str_replace('-', ' ', $_GET['model']))->first();
            $this->type_id = $type->id;
            $this->type_name = $type->name;
        }

        if(!empty($this->keywoard)){
            $this->searched = \App\Models\Product::where('name', 'LIKE', '%'.$this->keywoard.'%')->orWhere('slug', 'LIKE', '%'.$this->keywoard.'%')->orWhere('description', 'LIKE', '%'.$this->keywoard.'%')->orWhere('height', 'LIKE', '%'.$this->keywoard.'%')->orWhere('width', 'LIKE', '%'.$this->keywoard.'%')->orWhere('length', 'LIKE', '%'.$this->keywoard.'%')->orWhere('lighting', 'LIKE', '%'.$this->keywoard.'%')->orWhere('couches', 'LIKE', '%'.$this->keywoard.'%')->orWhere('interior', 'LIKE', '%'.$this->keywoard.'%')->orWhere('exterior', 'LIKE', '%'.$this->keywoard.'%')->orWhere('driver_station', 'LIKE', '%'.$this->keywoard.'%')->get();
        }

        $ip = Request::getClientIp();
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'product')->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'product';
        //     $visit->ip = $ip;
        //     $visit->save();
        // }
    }

    public function type($id){
        $type = Type::where('id', $id)->first();

        $slug = str_replace(' ', '-', $type->name);
        return redirect()->to(route('product', ['model' => $slug]) . "#tab-product");
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
