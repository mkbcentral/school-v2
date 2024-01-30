<?php

namespace App\Livewire\Application\Dashboard;

use Livewire\Component;

class MainDashboard extends Component
{
    public string $day = '';

    public function updatedDay($val)
    {
        $this->dispatch('changeDateInscription', $val);
    }
    public function mount()
    {
        $this->day = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.application.dashboard.main-dashboard');
    }
}
