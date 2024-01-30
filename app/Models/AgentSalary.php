<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgentSalary extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'month_name', 'school_id', 'currency_id', 'scolary_year_id'];

    /**
     * Get all of the agentSalaryDetails for the AgentSalary
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agentSalaryDetails(): HasMany
    {
        return $this->hasMany(AgentSalaryDetail::class);
    }

    public function getTotal(): int|float
    {
        $total = 0;
        if ($this->agentSalaryDetails->isEmpty()) return $total;
        foreach ($this->agentSalaryDetails as $detail) {
            $total += $detail->amount;
        }
        return $total;
    }
}
