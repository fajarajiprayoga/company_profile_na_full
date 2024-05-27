<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\News;
use App\Models\NewsCategory;
use Livewire\Attributes\Title;
use Livewire\Component;

class NewsDetail extends Component
{
    public $news;

    public $metadescription, $metakeyword;

    public function mount($slug){
        $this->news = News::where('slug', $slug)->first();

        $metanewstitle = $this->news->title;
        $this->metadescription = "Read the last update of $metanewstitle";
        $this->metakeyword = "$metanewstitle, New Armada News, PT Mekar Armada News, Berita New Armada, Berita PT Mekar Armada";
    }

    #[Title("New Armada News")]
    public function render()
    {
        return view('livewire.news-detail', [
            'footer' => Footer::first(),
            'categories' => NewsCategory::all(),
            'news_recomendations' => News::where('slug', '!=' , $this->news->slug)->where('is_show', true)->latest()->take(3)->get()
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
