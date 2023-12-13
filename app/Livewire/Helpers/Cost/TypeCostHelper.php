<?php

namespace App\Livewire\Helpers\Cost;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Payment\GetPaymentByTypeCostToCheck;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Illuminate\Support\Collection;

class TypeCostHelper
{
    /**
     * Retourner une liste de type de frais (TypcostGeneralModal), dont leur état est actif donc en cours d'utilisation
     * @param $defaultScolaryYerId
     * @return Collection
     */
    public function getListTypeCost($defaultScolaryYerId):Collection{
        return TypeOtherCost::where('school_id',auth()->user()->school->id)
            ->where('scolary_year_id',$defaultScolaryYerId)
            ->with('school')
            ->get();
    }

    /**
     * Retuurner la liste de frais (TypcostGeneralModal) dont l'état est inactif dont pas en utilisation.
     * @param $defaultScolaryYerId
     * @return Collection
     */
    public function getListDisableOldTypeCost():Collection{
        $scolaryYear=(new SchoolHelper())->getOldScolaryYear();
        return TypeOtherCost::where('school_id',auth()->user()->school->id)
            ->where('scolary_year_id',$scolaryYear->id)
            ->whereActive(false)
            ->with('school')
            ->get();
    }

    /**
     * Retourner la liste de type frais (TypcostGeneralModal) qui ne sont pas utilisés par id
     * @param int $defaultScolaryYerId
     * @param array $ids
     * @return Collection
     */
    public function getListDisableTypeCostWithArrayId(array $ids):Collection{
        $scolaryYear=(new SchoolHelper())->getOldScolaryYear();
        return TypeOtherCost::where('school_id',auth()->user()->school->id)
            ->where('scolary_year_id',$scolaryYear->id)
            ->whereIn('id',$ids)
            ->whereActive(false)
            ->with('school')
            ->get();
    }

    /**
     * Retourner le le le type des frais (TypcostGeneralModal) en cours d'utilisation
     * @param $scolaryYearid
     * @return TypeOtherCost
     */
    public function getFirstTypeCostActive($scolaryYearid):TypeOtherCost{
       return TypeOtherCost::where('scolary_year_id',$scolaryYearid)
            ->whereActive(true)
            ->where('school_id',auth()->user()->school->id)->first();
    }

    /**
     * Retourner le tableau de dettes de payment par type de frais
     * @param $studentId
     * @param array $costs
     * @return array
     */
    public function getListOfCostNotPaymentRapport($studentId,array $costs):array{
        //Recuperer le tableau de mois d'un année
        $months=(new DateFormatHelper())->getMonthsForYear();
        $data=array();//Stock les mois utilisés pour le paiement et ignore les qu'on pay pas
        $dataType=array();//Stock le resultat de dettes
        foreach ($costs as $cost){
            //Recupuer le type de fais
            $type=TypeOtherCost::find($cost);
            foreach ($months as $month ){
                //Recuperer le paiement par (eleve,typeFrais,mois)
                $payment=GetPaymentByTypeCostToCheck::getPaymentForLasYearChecker($cost,$studentId,$month);
                //Vérifier s'il y n a pas de paiemnt pour chaque et retourner les mois non payé
                if(!$payment){
                    if($month=='06' || $month=='07' || $month=='08'){
                    }else{
                        if ($cost==$type->id){
                            $data[]=$month;
                        }
                    }
                }
            }
            //Definir la structure tu tableau des dettes
            $dataType[]=[
                'name'=>$type->name,
                'label'=>(new CostGeneralHelper())->getCostByTypeId($cost)->name,
                'price'=>(new CostGeneralHelper())->getCostByTypeId($cost)->amount,
                'months'=>$data,
                'total'=>(new CostGeneralHelper())->getCostByTypeId($cost)->amount*count($data),
            ];
        }
        return $dataType;
    }

}
