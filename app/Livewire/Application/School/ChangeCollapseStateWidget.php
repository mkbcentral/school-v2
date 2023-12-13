<?php

namespace App\Livewire\Application\School;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ChangeCollapseStateWidget extends Component
{
    public function updateCollapsedState(){
        $setting= AppSetting::first();
        if ($setting->is_sidebar_collapse==true){
            $setting->is_sidebar_collapse=false;
        }else{
            $setting->is_sidebar_collapse=true;
        }
        $setting->update();
        Cache::forget('theme_setting');
    }
    public function render()
    {
        return view('livewire.application.school.change-collapse-state-widget');
    }
}
