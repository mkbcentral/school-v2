<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankDeposit extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'number', 'month_name', 'school_id', 'currency_id', 'scolary_year_id'];
    /**
     * Get the currency that owns the BankDeposit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Get the bankDepositMissing associated with the BankDeposit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bankDepositMissing(): HasOne
    {
        return $this->hasOne(BankDepositMissing::class);
    }
}
