<?php

namespace App\Livewire\Application\Parents;

use App\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Models\Student;
use App\Models\StudentResponsable;
use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ListParents extends Component
{
    use WithPagination;

    protected $listeners = [
        'selectedClasseOption' => 'getOptionSelected',
        'refreshListResponsible' => '$refresh',
        'deleteFamillyListner' => 'delete'
    ];
    public $name_responsable, $phone, $other_phone, $email;
    public  int $selectedIndex = 0;
    public string $keyToSearch = '';
    public StudentResponsable $studentResponsable;
    public $idStudentResponsable;

    public function mount(): void
    {
    }
    public  function getOptionSelected($index): void
    {
        $this->selectedIndex = $index;
    }

    public function show(StudentResponsable $studentResponsable)
    {
        $this->studentResponsable = $studentResponsable;
        $this->name_responsable = $studentResponsable->name_responsable;
        $this->phone = $studentResponsable->phone;
        $this->other_phone = $studentResponsable->other_phone;
        $this->email = $studentResponsable->email;
    }

    public function showDeleteDialog(string $idStudentResponsable)
    {
        $this->idStudentResponsable = $idStudentResponsable;
        $this->dispatch('delete-familly-dialog');
    }

    public function delete()
    {
        $responsable = StudentResponsable::find($this->idStudentResponsable);
        if ($responsable->students->isEmpty()) {
            $responsable->delete();
            $this->dispatch('familly-deleted', ['message' => "Famille bien rétirée !"]);
        } else {
            $this->dispatch('familly-deleted', ['message' => "Impossible, Famille déjà remplie"]);
        }
    }
    public function deleteInFamilly($id)
    {
        $student = Student::find($id);
        $student->student_responsable_id = null;
        $student->update();
        $this->dispatch('added', ['message' => "Enfant bien rérité de la famille !"]);
    }

    public function updateFamilly()
    {
        $this->validate(
            [
                'name_responsable' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'other_phone' => ['nullable', 'string'],
                'email' => ['nullable', 'string'],
            ]
        );
        $this->studentResponsable->name_responsable = $this->name_responsable;
        $this->studentResponsable->phone = $this->phone;
        $this->studentResponsable->other_phone = $this->other_phone;
        $this->studentResponsable->email = $this->email;
        $this->studentResponsable->update();
        $this->dispatch('updated', ['message' => "Infos bien mise à jour !"]);
    }

    public function sendBulkSMS()
    {
        try {
            $users = User::all();
            foreach ($users as $user) {
                SmsNotificationHelper::sendSMS(
                    '+243898337969',
                    '+243' . $user->phone,
                    'C.S.' . auth()->user()->school->name . "\n Juste un essaie technique \nA: " . date('Y-m-d H:i:s')
                );
            }
            $this->dispatch('added', ['message' => 'Message bien envoyer']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function showFromSoSendSms(StudentResponsable $studentResponsable)
    {
        $this->dispatch('studentToSedSMS', $studentResponsable);
    }

    public function getResponsable(StudentResponsable $responsable): void
    {
        $this->dispatch('selectRresposableId', $responsable);
    }
    public function render()
    {
        return view(
            'livewire.application.parents.list-parents',
            [
                'listResponsible' => StudentResponsable::where(
                    'school_id',
                    auth()->user()->school->id
                )
                    ->where('name_responsable', 'like', '%' . $this->keyToSearch . '%')
                    ->orderBy('name_responsable', 'ASC')
                    ->with('students')
                    ->paginate(25)
            ]
        );
    }
}
