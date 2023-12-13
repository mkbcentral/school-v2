<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable=['code','amount','currency_id','created_at','description','school_id'];

    /**
     * Get the currecny that owns the Emprunt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currecny(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
