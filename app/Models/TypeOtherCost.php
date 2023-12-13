<?php

namespace App\Models;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Payment\GetPaymentByTypeCostToCheck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOtherCost extends Model
{
    use HasFactory;
    protected $fillable=['id','name','school_id','active','scolary_year_id','currency_id'];

    /**
     * Get the currency that owns the TypeOtherCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    /**
     * Get all of the comments for the TypeOtherCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function costs(): HasMany
    {
        return $this->hasMany(CostGeneral::class);
    }
    /**
     * Get the school that owns the TypeOtherCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    /**
     * Get the scolaryYear that owns the CostInscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scolaryYear(): BelongsTo
    {
        return $this->belongsTo(ScolaryYear::class, 'scolary_year_id');
    }

    /**
     * Retuner ok si le mois est payé e - si le mois de n'est pas payé
     * @param $idType
     * @param $studentId
     * @param $month
     * @return string
     */
    public  function getPaymentCheckerStatus($idType,$studentId,$month):string{
        $payment=GetPaymentByTypeCostToCheck::getPaymentForLasYearChecker($idType,$studentId,$month);
        $status='';
        if($payment){
            return   $status='OK';
        }else{
            return  $status='-';
        }
    }

    /**
     * Returner une une couleur de fond pour le mois qui n'on pas de payment ['06,07,08']
     * @param $idType
     * @param $studentId
     * @param $month
     * @return string
     */
    public  function getPaymentCheckerBgtatus($idType,$studentId,$month):string{
        $payment=GetPaymentByTypeCostToCheck::getPaymentForLasYearChecker($idType,$studentId,$month);
        $status='';
        if($payment){
            return $status;
        }else{
            return $status='bg-danger';
        }
    }

    /**
     * Returner une couleur pour les moins qui sont pas encore payé
     * @param $month
     * @return string
     */
    public function getBgColorWithMonthNotPayment($month):string{
        $bg='';
        if ($month=='06' || $month=='07' || $month=='08'){
            $bg='bg-success';
        }
        return $bg;
    }
}
