<?php

namespace App\Livewire\Application\Navigation;

use App\Models\SubAppLink;
use Livewire\Component;

class ApplicationLinkMenuSub extends Component
{
    public function makeLoadingState($link,$user){
        $this->reset();
    }

    public function render()
    {
        return view('livewire.application.navigation.application-link-menu-sub');
    }
}
