<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LatePayment extends Model
{
    use HasFactory;

    protected $fillable=[
        'number_payment',
        'month_name',
        'currency',
        'amount',
        'inscription_id',
        'cost_general_id',
        'rate_id',
        'scolary_year_id',
        'user_id',
        'school_id',
        'is_paid',
        'is_printed',
        'created_at'
    ];

    /**
     * Get the inscription that owns the LatePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    /**
     * Get the costGeneral that owns the LatePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function costGeneral(): BelongsTo
    {
        return $this->belongsTo(CostGeneral::class, 'cost_general_id');
    }
}
