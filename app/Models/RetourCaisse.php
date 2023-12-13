<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RetourCaisse extends Model
{
    use HasFactory;

    protected $fillable= ['name','amount','currency_id','depense_id','school_id'];

    /**
     * Get the depense that owns the RetourCaisse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depense(): BelongsTo
    {
        return $this->belongsTo(Depense::class, 'depense_id');
    }
}
