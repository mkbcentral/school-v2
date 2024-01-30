<?php

namespace App\Livewire\Application\Settings;

use Livewire\Component;

class InitialLoaddingApp extends Component
{
    protected $listeners = ['loadingState' => '$refresh'];
    public function render()
    {
        return view('livewire.application.settings.initial-loadding-app');
    }
}
