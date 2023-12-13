<?php

namespace App\Livewire\Application\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public ?string $email, $password,$phone,$username,$name;
    public function registerUser()
    {
        $data = $this->validate([
            'name' => ['string', 'required','email', 'min:6'],
            'username' => ['string', 'required','email', 'min:4'],
            'phone' => ['string', 'required','email', 'min:13'],
            'email' => ['string', 'required','email', 'min:6'],
            'password' => ['required', 'string', 'min:6','confirmed']
        ]);
        try {
            if (Auth::attempt($data)) {
                return  redirect()->route('app.dashboard-main');
            }
            session()->flash('message', 'Email ou mot de password incorrect.');
        } catch (\Exception $ex) {
            session()->flush(['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.application.auth.register');
    }
}
