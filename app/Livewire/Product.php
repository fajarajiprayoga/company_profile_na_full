<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use Livewire\Component;
use App\Models\Type;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

class Product extends Component
{
    public $type_id;
    public $type_name;
    public $searched;
    
    //Search Feature
    public $keywoard;
    protected $queryString = ['keywoard'];

    public $metadescription = "High-quality PT Mekar Armada Jaya (New Armada) products with the luxury of interior and exterior. Experience top-of-the-line features, advanced technology, and unparalleled comfort.";
    public $metakeyword = "New Armada Product, PT Mekar Armada Jaya Product, New Armada Produk, PT Mekar Armada Jaya Produk";

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
            $this->searched = \App\Models\Product::where('name', 'LIKE', '%'.$this->keywoard.'%')->where('is_show', true)
            ->get();
        }

        $ip = Request::getClientIp();
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'product')->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'product';
        //     $visit->ip = $ip;
        //     $visit->save();
        // }
    }

    #[Title("New Armada Product")]
    public function type($id){
        $type = Type::where('id', $id)->first();

        $slug = str_replace(' ', '-', $type->name);
        return redirect()->to(route('product', ['model' => $slug]) . "#tab-product");
    }

    public function render()
    {
        $types = Type::all();
        $products = \App\Models\Product::where('type_id', $this->type_id)->where('is_show', true)->get();
        $footer = Footer::first();
        return view('livewire.product', [
            'types' => $types,
            'products' => $products,
            'footer' => $footer,
            'searched' => $this->searched
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
