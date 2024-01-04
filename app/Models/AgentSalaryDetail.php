<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSalaryDetail extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'name','currency_id','agent_salary_id'];
}
