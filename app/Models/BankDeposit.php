<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDeposit extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'number', 'month_name', 'school_id', 'currency_id'];
}
