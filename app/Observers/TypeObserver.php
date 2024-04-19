<?php

namespace App\Observers;

use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class TypeObserver
{
    /**
     * Handle the Type "created" event.
     */
    public function created(Type $type): void
    {
        //
    }

    /**
     * Handle the Type "updated" event.
     */
    public function updated(Type $type): void
    {
        if ($type->isDirty('img')) {
            if(Storage::disk('public')->exists($type->getOriginal('img'))){
                Storage::disk('public')->delete($type->getOriginal('img'));
            }
        }
    }

    /**
     * Handle the Type "deleted" event.
     */
    public function deleted(Type $type): void
    {
        if (! is_null($type->img)) {
            if(Storage::disk('public')->exists($type->getOriginal('img'))){
                Storage::disk('public')->delete($type->getOriginal('img'));
            }
        }
    }

    /**
     * Handle the Type "restored" event.
     */
    public function restored(Type $type): void
    {
        //
    }

    /**
     * Handle the Type "force deleted" event.
     */
    public function forceDeleted(Type $type): void
    {
        //
    }
}
