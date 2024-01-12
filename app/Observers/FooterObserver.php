<?php

namespace App\Observers;

use App\Models\Footer;
use Illuminate\Support\Facades\Storage;

class FooterObserver
{
    /**
     * Handle the Footer "created" event.
     */
    public function created(Footer $footer): void
    {
        //
    }

    /**
     * Handle the Footer "updated" event.
     */
    public function updated(Footer $footer): void
    {
        if ($footer->isDirty('background_product')) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_product'))){
                Storage::disk('public')->delete($footer->getOriginal('background_product'));
            }
        }
        if ($footer->isDirty('background_contact')) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_contact'))){
                Storage::disk('public')->delete($footer->getOriginal('background_contact'));
            }
        }
        if ($footer->isDirty('background_download_center')) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_download_center'))){
                Storage::disk('public')->delete($footer->getOriginal('background_download_center'));
            }
        }
    }

    /**
     * Handle the Footer "deleted" event.
     */
    public function deleted(Footer $footer): void
    {
        if (! is_null($footer->background_product)) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_product'))){
                Storage::disk('public')->delete($footer->getOriginal('background_product'));
            }
        }
        if (! is_null($footer->background_contact)) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_contact'))){
                Storage::disk('public')->delete($footer->getOriginal('background_contact'));
            }
        }
        if (! is_null($footer->background_download_center)) {
            if(Storage::disk('public')->exists($footer->getOriginal('background_download_center'))){
                Storage::disk('public')->delete($footer->getOriginal('background_download_center'));
            }
        }
    }

    /**
     * Handle the Footer "restored" event.
     */
    public function restored(Footer $footer): void
    {
        //
    }

    /**
     * Handle the Footer "force deleted" event.
     */
    public function forceDeleted(Footer $footer): void
    {
        //
    }
}
