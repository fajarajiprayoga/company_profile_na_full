<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\NewsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class News extends Component
{
    use WithPagination;

    public $search = '';
    public $search_year = 'semua';
    public $search_time = 'desc';
    public $category = '';
    public $category_title = '';
    public $category_data;

    public function mount()
    {
        if (isset($_GET['category'])) {
            $this->category = $_GET['category'];

            $this->category_title = ucwords(str_replace('-', ' ', $this->category));

            $this->category_data = NewsCategory::where('slug', $_GET['category'])->where('is_show', true)->first();
        }
    }

    public function render()
    {
        $uniqueYears = \App\Models\News::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        if (!empty($this->category_data)) {
            if($this->search_year == 'semua'){
                $news = \App\Models\News::where('is_show', true)->where('title', 'LIKE', '%' . $this->search . '%')->where('news_categories_id', $this->category_data->id)->orderBy('created_at', $this->search_time)->simplePaginate(6);
            }else{
                $news = \App\Models\News::where('is_show', true)->where('title', 'LIKE', '%' . $this->search . '%')->where('news_categories_id', $this->category_data->id)->whereYear('created_at', $this->search_year)->orderBy('created_at', $this->search_time)->simplePaginate(6);
            }
        } else {
            if($this->search_year == 'semua'){
                $news = \App\Models\News::where('is_show', true)->where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', $this->search_time)->simplePaginate(6);
            }else{
                $news = \App\Models\News::where('is_show', true)->where('title', 'LIKE', '%' . $this->search . '%')->whereYear('created_at', $this->search_year)->orderBy('created_at', $this->search_time)->simplePaginate(6);
            }
        }


        return view('livewire.news', [
            'footer' => Footer::first(),
            'categories' => NewsCategory::all(),
            'news' => $news,
            'years' => $uniqueYears
        ]);
    }
}
