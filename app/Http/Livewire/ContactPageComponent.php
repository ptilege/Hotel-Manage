<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactPageComponent extends Component
{
    public function render()
    {
        return view('livewire.contact-page-component')->layout('frontend');
    }
}
