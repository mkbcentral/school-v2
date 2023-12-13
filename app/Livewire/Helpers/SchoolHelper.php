<?php

namespace App\Livewire\Helpers;

use App\Models\Classe;
use App\Models\ClasseOption;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\Rate;
use App\Models\ScolaryYear;
use Illuminate\Support\Collection;

class SchoolHelper
{
    //Get current rate
    public  function  getCurrentRate():Rate{
        return Rate::where('school_id',auth()->user()->school->id)
            ->where('status',true)
            ->first();
    }
    //Get current scolary year
    public  function  getCurrentScolaryYear():?ScolaryYear{
        return ScolaryYear::where('active', true)
            ->where('school_id',auth()->user()->school->id)
            ->first();
    }

    public function getOldScolaryYear():ScolaryYear{
        return  ScolaryYear::where('is_last_year',true)->first();
    }


    //Get Current Currency
    public function getCurrentCurrency():?Currency{
        return Currency::where('id', 1)
            ->where('school_id',auth()->user()->school->id)
            ->first();
    }

    //get list of classes by option
    public function getListClasseByOption( $id):Collection{
        return Classe::join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->where('classes.classe_option_id', $id)
            ->select('classes.*','classe_options.name as optioName')
            ->orderBy('classes.name')
            ->with(['classeOption','inscriptions'])
            ->get();
    }
    //get list of classes
    public function getListClasse():Collection{

        return Classe::join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->select('classes.*')
            ->orderBy('name','asc')
            ->with('classeOption')
            ->get();
    }
    //get list of classes option
    public function  getListClasseOption():Collection{
        return ClasseOption::join('sections','sections.id','=','classe_options.section_id')
            ->where('sections.school_id',auth()->user()->school->id)
            ->select('classe_options.*')
            ->get();
    }
    //Get list classe option by section_id
    public function  getListClasseOptionBySectionId($id):Collection{
        return ClasseOption::join('sections','sections.id','=','classe_options.section_id')
            ->where('sections.school_id',auth()->user()->school->id)
            ->where('classe_options.section_id',$id)
            ->select('classe_options.*')
            ->get();
    }
    //Get list of gender
    public function getListOfGender():Collection{
        return Gender::all();
    }

    public static function getCurrencyList():Collection{
        return Currency::all();
    }

    //Get current scolary year
    public  function  getCurrectScolaryYear():?ScolaryYear{
        return ScolaryYear::where('active', true)
            ->where('school_id',auth()->user()->school->id)
            ->first();
    }
}
