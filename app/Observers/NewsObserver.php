<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        dd("Hello WOrld");
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
        if ($news->isDirty('thumbnail')) {
            if(Storage::disk('public')->exists($news->getOriginal('thumbnail'))){
                Storage::disk('public')->delete($news->getOriginal('thumbnail'));
            }
        }
    }

    /**
     * Handle the News "deleted" event.
     */
    public function deleted(News $news): void
    {
        if (! is_null($news->thumbnail)) {
            if(Storage::disk('public')->exists($news->getOriginal('thumbnail'))){
                Storage::disk('public')->delete($news->getOriginal('thumbnail'));
            }
        }
    }

    /**
     * Handle the News "restored" event.
     */
    public function restored(News $news): void
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     */
    public function forceDeleted(News $news): void
    {
        //
    }
}
