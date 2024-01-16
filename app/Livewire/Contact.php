<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;

class Contact extends Component
{
    public function mount(){
        $ip = Request::getClientIp();
        
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'contact')->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'contact';
        //     $visit->ip = $ip;
        //     $visit->save();
        // }
    }
    public function render()
    {
        $footer = Footer::first();
        $contacts = \App\Models\Contact::all();
        return view('livewire.contact', [
            'footer' => $footer,
            'contacts' => $contacts
        ]);
    }
}
