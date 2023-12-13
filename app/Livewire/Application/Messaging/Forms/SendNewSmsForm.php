<?php

namespace App\Livewire\Application\Messaging\Forms;

use App\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Models\StudentResponsable;
use Exception;
use Livewire\Component;

class SendNewSmsForm extends Component
{
    protected $listeners = ['studentToSedSMS' => 'getStudent'];
    public $body;
    public StudentResponsable $studentResponsable;

    public function getStudent(StudentResponsable $studentResponsable)
    {
        $this->studentResponsable = $studentResponsable;
    }

    public function sendSMS()
    {
        try {
            $this->validate(['body' => ['required', 'nullable']]);
            SmsNotificationHelper::sendSMS(
                '+243898337969',
                '+243' . $this->studentResponsable->phone,
                'C.S.'.auth()->user()->school->name."\n".$this->body."\nA: ".date('Y-m-d H:i:s')
            );
            $this->dispatch('added', ['message' => 'Message bien envoyer']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.application.messaging.forms.send-new-sms-form');
    }
}
