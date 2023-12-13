<?php

namespace App\Livewire\Application\School;

use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateSchool extends Component
{
    public $name,$email,$phone;
    public function store(){
        $validate=$this->validate([
            'name'=>['required','string'],
            'email'=>['required','string','email'],
            'phone'=>['required','string']
        ]);
       $school=School::create($validate);
       $user=Auth::user();
       $user->school_id=$school->id;
       $user->update();
        $this->dispatch('added', ['message' => "Création effectu&ée avec succès !"]);
       return redirect()->route('main');
    }
    public function render()
    {
        return view('livewire.application.school.create-school');
    }
}
