<?php

namespace App\Http\Livewire;

use App\Models\Partner;
use Livewire\Component;

class AllPartnersComponent extends Component
{
    public function render()
    {
        $partners = Partner::where(['status'=>1])->get();
        return view('livewire.all-partners-component',compact('partners'))->layout('frontend');
    }
}
