<?php

namespace App\Livewire\Application\Auth;

use App\Livewire\Helpers\AuthUserHleper;
use Livewire\Component;
class Login extends Component
{
    public ?string $email, $password;
    public function loginUser()
    {
        $data = $this->validate([
            'email' => ['string', 'required','email', 'min:6'],
            'password' => ['required', 'string', 'min:6']
        ]);
        try {
            if (AuthUserHleper::login($data)){
                $this->dispatch('added', ['message' => "Connexion bien établie !"]);
                return $this->redirect('/',navigate:true);;
            }else{
                $this->dispatch('error', ['message' => "'Email ou mot de password incorrect.'"]);
            }

        } catch (\Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
            }

    }
    public function render()
    {

        return view('livewire.application.auth.login');
    }
}
