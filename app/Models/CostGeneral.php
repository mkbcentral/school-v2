<?php

namespace App\Models;

use App\Livewire\Helpers\SchoolHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostGeneral extends Model
{
    use HasFactory;
    protected $fillable=['id','name','amount','type_other_cost_id','classe_option_id','currency_id'];

    /**
     * Get the Paiement associated with the CostGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paiements(): HasMany
    {
        return $this->hasMany(Paiment::class);
    }
    /**
     * Get the typ that owns the CostGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeOtherCost(): BelongsTo
    {   $scolaryYer=(new SchoolHelper())->getCurrentScolaryYear();;
        return $this->belongsTo(TypeOtherCost::class, 'type_other_cost_id')
               ->where('active',true);
    }
    public function classeOption():BelongsTo{
        return $this->belongsTo(ClasseOption::class,'classe_option_id');
    }

    /**
     * Get the currency that owns the CostGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }



}
