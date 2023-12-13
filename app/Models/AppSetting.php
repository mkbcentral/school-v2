<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable=['app_name','is_sidebar_collapse','is_dark_mode'];
    use HasFactory;
    protected $casts=['is_sidebar_collapse'=>'boolean'];
}
