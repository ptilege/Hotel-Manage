<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Home\TopDealsComponent;


class AboutUsPageComponent extends Component
{
    public $deals;
    public function render()
    {
        // Assuming TopDealsComponent is in the correct namespace
        $topDealsComponent = app(TopDealsComponent::class);

        return view('livewire.about-us-page-component')
            ->layout('frontend')
            ->with('topDealsComponent', $topDealsComponent);
    }
}