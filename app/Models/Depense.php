<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depense extends Model
{
    use HasFactory;
    protected $fillable=['name','amount','currency_id','depense_source_id','school_id','category_depense_id','created_at'];

    /**
     * Get the currency that owns the Depense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Get the depenseSource that owns the Depense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depenseSource(): BelongsTo
    {
        return $this->belongsTo(DepenseSource::class, 'depense_source_id');
    }

    /**
     * Get the categoryDepense that owns the Depense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryDepense(): BelongsTo
    {
        return $this->belongsTo(CategoryDepense::class, 'category_depense_id');
    }
}
