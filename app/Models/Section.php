<?php

namespace App\Models;

use App\Livewire\Helpers\Inscription\GetCounterInscriptionHelper;
use App\Livewire\Helpers\Payment\PaymentCounterHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'school_id'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(ClasseOption::class);
    }
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * Get student count
     */
    public function getStudentCount($id, $isScolaryYeae): int
    {
        return (new GetCounterInscriptionHelper())->getCountInscriptionsSection($id, $isScolaryYeae);
    }
    public function getPaymentCount($id, $isScolaryYeae): int
    {
        return PaymentCounterHelper::getPayementCounterBySection($id, $isScolaryYeae);
    }

    public function getCostEtatByTranchAmount($idType)
    {
        $amount = Payment::join('cost_generals', 'cost_generals.id', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', 'cost_generals.type_other_cost_id')
            ->join('classe_options', 'classe_options.id', 'cost_generals.classe_option_id')
            ->leftJoin('sections', 'sections.id', 'classe_options.section_id')
            ->where('sections.id', $this->id)
            ->where('type_other_costs.id', $idType)
            ->sum('cost_generals.amount');
        return $amount;
    }

    public function getCostBySectionAmount($optionId, $month)
    {
        $amount = Payment::join('cost_generals', 'cost_generals.id', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', 'cost_generals.type_other_cost_id')
            ->join('classe_options', 'classe_options.id', 'cost_generals.classe_option_id')
            ->leftJoin('sections', 'sections.id', 'classe_options.section_id')
            ->where('sections.id', $this->id)
            ->where('type_other_costs.id', 11)
            ->when($optionId, function ($query, $optionId) {
                return $query->where('classe_options.id', $optionId);
            })
            ->when($month, function ($query, $month) {
                return $query->where('payments.month_name', $month);
            })
            ->sum('cost_generals.amount');
        return $amount;
    }
}
