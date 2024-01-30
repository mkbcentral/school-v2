<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankDepositMissing extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'description', 'bank_deposit_id'];

    /**
     * Get the bankDeposit that owns the BankDepositMissing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankDeposit(): BelongsTo
    {
        return $this->belongsTo(BankDeposit::class, 'bank_deposit_id');
    }
}
