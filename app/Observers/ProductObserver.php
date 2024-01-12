<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('images')) {
            if(Storage::disk('public')->exists($product->getOriginal('images'))){
                Storage::disk('public')->delete($product->getOriginal('images'));
            }
        }
        if ($product->isDirty('home_photo')) {
            if(Storage::disk('public')->exists($product->getOriginal('home_photo'))){
                Storage::disk('public')->delete($product->getOriginal('home_photo'));
            }
        }
        if ($product->isDirty('wallpaper')) {
            if(Storage::disk('public')->exists($product->getOriginal('wallpaper'))){
                Storage::disk('public')->delete($product->getOriginal('wallpaper'));
            }
        }
        if ($product->isDirty('catalog')) {
            if(Storage::disk('public')->exists($product->getOriginal('catalog'))){
                Storage::disk('public')->delete($product->getOriginal('catalog'));
            }
        }
        if ($product->isDirty('lighting_images')) {
            if(Storage::disk('public')->exists($product->getOriginal('lighting_images'))){
                Storage::disk('public')->delete($product->getOriginal('lighting_images'));
            }
        }
        if ($product->isDirty('couches_images')) {
            if(Storage::disk('public')->exists($product->getOriginal('couches_images'))){
                Storage::disk('public')->delete($product->getOriginal('couches_images'));
            }
        }
        if ($product->isDirty('interior_images')) {
            if(Storage::disk('public')->exists($product->getOriginal('interior_images'))){
                Storage::disk('public')->delete($product->getOriginal('interior_images'));
            }
        }
        if ($product->isDirty('exterior_images')) {
            if(Storage::disk('public')->exists($product->getOriginal('exterior_images'))){
                Storage::disk('public')->delete($product->getOriginal('exterior_images'));
            }
        }
        if ($product->isDirty('driver_station_images')) {
            if(Storage::disk('public')->exists($product->getOriginal('driver_station_images'))){
                Storage::disk('public')->delete($product->getOriginal('driver_station_images'));
            }
        }
        if ($product->isDirty('gallery')) {
            foreach($product->getOriginal('gallery') as $data){
                if(Storage::disk('public')->exists($data)){
                    Storage::disk('public')->delete($data);
                }
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if (! is_null($product->images)) {
            if(Storage::disk('public')->exists($product->getOriginal('images'))){
                Storage::disk('public')->delete($product->getOriginal('images'));
            }
        }
        if (! is_null($product->home_photo)) {
            if(Storage::disk('public')->exists($product->getOriginal('home_photo'))){
                Storage::disk('public')->delete($product->getOriginal('home_photo'));
            }
        }
        if (! is_null($product->wallpaper)) {
            if(Storage::disk('public')->exists($product->getOriginal('wallpaper'))){
                Storage::disk('public')->delete($product->getOriginal('wallpaper'));
            }
        }
        if (! is_null($product->catalog)) {
            if(Storage::disk('public')->exists($product->getOriginal('catalog'))){
                Storage::disk('public')->delete($product->getOriginal('catalog'));
            }
        }
        if (! is_null($product->lighting_images)) {
            if(Storage::disk('public')->exists($product->getOriginal('lighting_images'))){
                Storage::disk('public')->delete($product->getOriginal('lighting_images'));
            }
        }
        if (! is_null($product->couches_images)) {
            if(Storage::disk('public')->exists($product->getOriginal('couches_images'))){
                Storage::disk('public')->delete($product->getOriginal('couches_images'));
            }
        }
        if (! is_null($product->interior_images)) {
            if(Storage::disk('public')->exists($product->getOriginal('interior_images'))){
                Storage::disk('public')->delete($product->getOriginal('interior_images'));
            }
        }
        if (! is_null($product->exterior_images)) {
            if(Storage::disk('public')->exists($product->getOriginal('exterior_images'))){
                Storage::disk('public')->delete($product->getOriginal('exterior_images'));
            }
        }
        if (! is_null($product->driver_station_images)) {
            if(Storage::disk('public')->exists($product->getOriginal('driver_station_images'))){
                Storage::disk('public')->delete($product->getOriginal('driver_station_images'));
            }
        }
        if (! is_null($product->gallery)) {
            foreach($product->getOriginal('gallery') as $data){
                if(Storage::disk('public')->exists($data)){
                    Storage::disk('public')->delete($data);
                }
            }
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
