<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Gallery;
use App\Models\Maps;
use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Type;
use App\Models\Visit;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;

class Home extends Component
{

    use WithPagination;

    public function mount(){
        $ip = Request::getClientIp();
        
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'home')->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'home';
        //     $visit->ip = $ip;
        //     $visit->save();
        // }
    }

    public function type($id){
        $type = Type::where('id', $id)->first();

        $slug = str_replace(' ', '-', $type->name);
        return redirect()->to(route('product', ['model' => $slug]) . "#tab-product");
    }

    public function getAboutStamping(){
        $apiUrl = "https://stamping.newarmada.co.id/api/about";
        $apiKey = "PtZaSobjwoxSxd3pTgIpxJ9jiiHRy2PWEWocHqWbVjOOB2oRcQuVG9YwsI0uDOZthAOxCJezKNbqrnWTx1V4yAsEOjt7LcSfefYapmFsQa7zfK0Eu38snYJb1BqzrH41JvRGcvs584f8xvsNibu2dcU0yyTgFb4r";

        $response = Http::accept('application/json')->withHeaders([
            "x-api-key" => $apiKey
        ])->get($apiUrl);
        
        if($response->ok()){
            $data = $response->json();
        }else{
            $data = [];
        }

        return $data;
    }

    public function getProductTypeStamping(){
        $apiUrl = "https://stamping.newarmada.co.id/api/product-type";
        $apiKey = "PtZaSobjwoxSxd3pTgIpxJ9jiiHRy2PWEWocHqWbVjOOB2oRcQuVG9YwsI0uDOZthAOxCJezKNbqrnWTx1V4yAsEOjt7LcSfefYapmFsQa7zfK0Eu38snYJb1BqzrH41JvRGcvs584f8xvsNibu2dcU0yyTgFb4r";

        $response = Http::accept('application/json')->withHeaders([
            "x-api-key" => $apiKey
        ])->get($apiUrl);
        
        if($response->ok()){
            $data = $response->json();
        }else{
            $data = [];
        }

        return $data;
    }

    public function render()
    {
        $about_stamping = $this->getAboutStamping();
        // $stampingProductTypes = $this->getProductTypeStamping();
        // $about_stamping = [];
        $stampingProductTypes = [];
        $sliders = Slider::all();
        $arr_sliders = [];
        foreach ($sliders as $key => $slider){
            $arr_sliders[$key]['title'] = $slider->title;
            $arr_sliders[$key]['file_name'] = $slider->file_name;
            if(Storage::exists('public/'.$slider->file_name)){
                $extension = pathinfo($slider->file_name, PATHINFO_EXTENSION);
                $arr_sliders[$key]['ext'] = $extension;
            }
        }

        $show_in_home_products = Product::where('show_in_home', 1)->get();

        $galleries = Gallery::where('show', 1)->get();

        $maps = Maps::all();

        $types = Type::all();

        $latest_news = News::latest()->take(3)->get();

        return view('livewire.home', [
            'sliders' => $arr_sliders,
            'show_in_home_products' => $show_in_home_products,
            'types' => $types,
            'galleries' => $galleries,
            'maps' => $maps,
            'latest_news' => $latest_news,
            'about_stamping' => $about_stamping,
            'stampingProductTypes' => $stampingProductTypes
        ]);
    }
}
