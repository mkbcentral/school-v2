<?php
use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
function theme_setting($key){
    $setting=Cache::rememberForever('theme_setting',function(){
        return AppSetting::first();
    });
    return $setting->{$key};
}
