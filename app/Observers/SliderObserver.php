<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderObserver
{
    /**
     * Handle the Slider "created" event.
     */
    public function created(Slider $slider): void
    {
        //
    }

    /**
     * Handle the Slider "updated" event.
     */
    public function updated(Slider $slider): void
    {
        if ($slider->isDirty('file_name')) {
            if(Storage::disk('public')->exists($slider->getOriginal('file_name'))){
                Storage::disk('public')->delete($slider->getOriginal('file_name'));
            }
        }
    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        if (! is_null($slider->file_name)) {
            if(Storage::disk('public')->exists($slider->getOriginal('file_name'))){
                Storage::disk('public')->delete($slider->getOriginal('file_name'));
            }
        }
    }

    /**
     * Handle the Slider "restored" event.
     */
    public function restored(Slider $slider): void
    {
        //
    }

    /**
     * Handle the Slider "force deleted" event.
     */
    public function forceDeleted(Slider $slider): void
    {
        //
    }
}
