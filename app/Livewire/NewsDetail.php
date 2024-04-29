<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\News;
use App\Models\NewsCategory;
use Livewire\Component;

class NewsDetail extends Component
{
    public $news;
    public function mount($slug){
        $this->news = News::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.news-detail', [
            'footer' => Footer::first(),
            'categories' => NewsCategory::all(),
            'news_recomendations' => News::where('slug', '!=' , $this->news->slug)->latest()->take(3)->get()
        ]);
    }
}
