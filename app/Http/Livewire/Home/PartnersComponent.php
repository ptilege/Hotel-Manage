<?php

namespace App\Http\Livewire\Home;

use App\Models\Partner;
use Livewire\Component;

class PartnersComponent extends Component
{
    public function render()
    {
        $partners = Partner::where(['status'=>1])->limit(12)->orderBy('position')->get();
        return view('livewire.home.partners-component', compact('partners'));
    }
}
