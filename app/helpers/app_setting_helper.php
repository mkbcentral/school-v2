<?php
use Illuminate\Support\Facades\Cache;
function app_setting($key){
    $setting=\App\Models\AppSetting::first();
    return $setting->{$key};
}
