<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;

class ProductDetail extends Component
{
    public $product;
    public $tabDetail;
    public function mount($slug){
        $product = Product::where('slug', $slug)->first();
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
        $contacts = \App\Models\Contact::all();
        return view('livewire.product-detail', [
            'footer' => $footer,
            'contacts' => $contacts
        ]);
    }
}
