<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

class ProductDetail extends Component
{
    public $product;
    public $tabDetail;

    public $metadescription, $metakeyword;

    public function mount($slug){
        $product = Product::where('slug', $slug)->where('is_show', true)->first();
        if(empty($product)){
            return redirect()->route('product');
        }
        $this->product = $product;

        $this->tabDetail = 'interior';

        $ip = Request::getClientIp();
        
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'product_detail')->where('params', $slug)->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'product_detail';
        //     $visit->params = $slug;
        //     $visit->ip = $ip;
        //     $visit->save();
        // }

        $this->metadescription = "Introducing $product->name, one of high-quality PT Mekar Armada Jaya (New Armada) product with the luxury of interior and exterior. Experience top-of-the-line features, advanced technology, and unparalleled comfort.";
        $this->metakeyword = "$product->name New Armada, $product->name PT Mekar Armada Jaya, $product->name specification, $product->name spesifikasi, $product->name gallery, $product->name product, $product->name detail, $product->name interior, $product->name exterior, $product->name video";
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

    #[Title("New Armada Product")]
    public function render()
    {
        $footer = Footer::first();
        $contacts = \App\Models\Contact::all();

        return view('livewire.product-detail', [
            'footer' => $footer,
            'contacts' => $contacts
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
