<?php

namespace App\Livewire\Application\School;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SwitchThemeWidget extends Component
{
    public bool $is_dark_mode = false;
    public function updatedIsDarkMode($val)
    {
        $setting = AppSetting::first();
        $setting->is_dark_mode = $val;
        $setting->update();
        Cache::forget('theme_setting');
    }
    public function render()
    {
        return view('livewire.application.school.switch-theme-widget');
    }
}
