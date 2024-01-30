<?php

namespace App\Livewire\Application\Navigation;

use Livewire\Component;

class ApplicationLinkMenuSub extends Component
{

    public function makeLoadingState($link, $user)
    {
        $this->dispatch('loadingState');
    }

    public function render()
    {
        return view('livewire.application.navigation.application-link-menu-sub');
    }
}
