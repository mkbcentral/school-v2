<?php

namespace App\Livewire\Application\User;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class MyAccount extends Component
{
    public $password, $old_password, $password_confirm;
    public function updatePassword()
    {
        $this->validate([
            'password' => ['required', 'string'],
            'old_password' => ['required', 'string'],
            'password_confirm' => ['required', 'string'],
        ]);
        try {
            $user = Auth::user();
            if (Hash::check($this->password, $user->password)) {
                $this->dispatch('error', ['message' => 'Ancien mot de passe incorrect !']);
            } elseif ($this->password != $this->password_confirm) {
                session()->flash('message', '');
                $this->dispatch('error', ['message' => 'Confirmer votre mot de passe SVP!']);
            } else {
                $user->password = Hash::make($this->password);
                $user->update();
                $this->dispatch('updated', ['message' => 'Mot de passe bien mis à jour']);
            }
        } catch (QueryException $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.application.user.my-account');
    }
}
