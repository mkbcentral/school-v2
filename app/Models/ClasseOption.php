<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClasseOption extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'section_id'];

    /**
     * Get the Section that owns the ClasseOption
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    /**
     * Get all of the Classe for the ClasseOption
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function getCostByOptionAmount($sectionId)
    {
        $amount = Payment::join('cost_generals', 'cost_generals.id', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', 'cost_generals.type_other_cost_id')
            ->join('classe_options', 'classe_options.id', 'cost_generals.classe_option_id')
            ->leftJoin('sections', 'sections.id', 'classe_options.section_id')
            ->where('sections.id', $sectionId)
            ->where('classe_options.id', $this->id)
            ->where('type_other_costs.id', 11)
            ->sum('cost_generals.amount');
        return $amount;
    }
}
