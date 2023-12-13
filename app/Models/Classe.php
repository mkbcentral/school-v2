<?php

namespace App\Models;

use App\Livewire\Helpers\SchoolHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'classe_option_id'];

    /**
     * Get the classeoption that owns the Classe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classeOption(): BelongsTo
    {
        return $this->belongsTo(ClasseOption::class, 'classe_option_id');
    }

    /**
     * Get all of the inscriptions for the Classe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }
    //getInscriptionsCountByClasseFroCurrentScolaryYear
    public function getPaymentByClasseForCurrentYear($classeId,$typeCostId,$scolaryYearId)
    {
        $payment = Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->where('payments.classe_id', $classeId)
            ->where('type_other_costs.id', $typeCostId)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->first();
        return $payment?->cost?->amount;
    }
    public function getPaymentCurrencyByClasseForCurrentYear($classeId,$typeCostId,$scolaryYearId)
    {
        $payment = Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('payments.scolary_year_id',$scolaryYearId)
            ->where('payments.classe_id', $classeId)
            ->where('type_other_costs.id', $typeCostId)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->first();
        return $payment?->cost?->currency?->currency;
    }
    public function getAmountPaymentByClasseForCurrentYearByMonth($classeId,$typeCostId,$month)
    {
        $currentScolaryYear = (new SchoolHelper())->getCurrentScolaryYear();
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('payments.scolary_year_id', $currentScolaryYear->id)
            ->where('payments.classe_id', $classeId)
            ->where('type_other_costs.id', $typeCostId)
            ->where('payments.month_name', $month)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->sum('cost_generals.amount');

    }

    public function getInscriptionsCountByClasseFroCurrentScolaryYear($classeId)
    {
        return   Inscription::where('inscriptions.scolary_year_id', (new SchoolHelper())
            ->getCurrectScolaryYear()->id)
            ->where('inscriptions.classe_id', $classeId)
            ->orderBy('inscriptions.created_at', 'DESC')
            ->count();

           
    }

    
}
