<?php

namespace App\Livewire\Application\Settings;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AppSettings extends Component
{
    public $setting,$name,$is_sidebar_collapse,$is_dark_mode;
    public function mount(){
        $this->setting=AppSetting::where('id',1)->first();
        if ($this->setting) {
            $this->name=$this->setting->printer_name;
            $this->is_sidebar_collapse=$this->setting->is_sidebar_collapse;;
            $this->is_dark_mode=$this->setting->is_dark_mode;;
        }
    }
    public function save(){
        $this->validate(['name'=>'required']);
        if ($this->setting) {
            $this->setting->printer_name=$this->name;
            $this->setting->is_sidebar_collapse=$this->is_sidebar_collapse;
            $this->setting->is_dark_mode=$this->is_dark_mode;
            $this->setting->update();
            Cache::forget('theme_setting');
            $this->dispatch('updated',['message'=>'Paramètre bien modifié']);
        } else {
            $setting=new AppSetting();
            $setting->printer_name=$this->name;
            $setting->is_sidebar_collapse=$this->is_sidebar_collapse;
            $setting->is_dark_mode=$this->is_dark_mode;
            $setting->save();
            Cache::forget('theme_setting');
            $this->dispatch('updated',['message'=>'Paramètres bien défini']);
        }

    }
    public function render()
    {
        return view('livewire.application.settings.app-settings');
    }
}
