<?php

namespace App\Livewire;

use App\Models\Footer;
use App\Models\Maps;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

class Contact extends Component
{
    public $metadescription = "Get in touch PT Mekar Armada Jaya (New Armada) for inquiries, support, or feedback. Our team is here to help. Contact us via wa, phone, or email";
    public $metakeyword = "Contact New Armada, Contact PT Mekar Armada, Kontak New Armada, Kontak PT Mekar Armada, customer support, contact phone number, contact email";

    public function mount(){
        $ip = Request::getClientIp();
        
        // if(Visit::whereDate('created_at', Carbon::now()->toDateString())->where('ip', $ip)->where('url', 'contact')->count() == Null){
        //     $visit = new Visit;
        //     $visit->url = 'contact';
        //     $visit->ip = $ip;
        //     $visit->save();
        // }
    }

    #[Title("New Armada Contact")]
    public function render()
    {
        $footer = Footer::first();
        $contacts = \App\Models\Contact::all();
        $maps = Maps::all();
        return view('livewire.contact', [
            'footer' => $footer,
            'contacts' => $contacts,
            'maps' => $maps
        ])->layout('components.layouts.app', [
            'metadescription' => $this->metadescription,
            'metakeyword' => $this->metakeyword,
        ]);
    }
}
