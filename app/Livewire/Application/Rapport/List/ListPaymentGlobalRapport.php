<?php

namespace App\Livewire\Application\Rapport\List;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Livewire\Helpers\Payment\GetPaymentByDateHelper;
use App\Livewire\Helpers\Payment\GetPaymentByMonthHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Payment;

use Livewire\Component;
use Livewire\WithPagination;

class ListPaymentGlobalRapport extends Component
{
    use WithPagination;

    public $selectedIndex;
    public $keyToSearch = '', $date_to_search;
    public $defaultScolaryYerId;
    public $cost_id = 0, $classe_id = 0;
    public $classeList = [];
    public  $month = '';

    public $idPayment;
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'deletePaymentListner' => 'delete',
        'selectedIndexFresh' => 'getSelectedIndex'
    ];


    /**
     * Reset date to search on null after month property is updated
     * @return void
     */
    public function updatedMonth($val): void
    {
        $this->month = $val;
        $this->date_to_search = null;
    }

    public function updatedDateToSearch($val)
    {
        $this->date_to_search = $val;
    }

    /**
     * updated cost id property
     * @param $val
     * @return void
     */
    public function updatedCostId($val): void
    {
        $this->cost_id = $val;
    }

    /**
     * Updated classe id property
     * @param $val
     * @return void
     */
    public function updatedClasseId($val): void
    {
        $this->classe_id = $val;
    }

    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }

    public function getSelectedIndex($index)
    {
        $this->selectedIndex = $index;
    }

    public function edit(Payment $payment): void
    {
        $this->dispatch('paymentToEdit', $payment);
    }

    public function showDeleteDialog(string $idPayment)
    {
        $this->idPayment = $idPayment;
        $this->dispatch('delete-payment-dialog');
    }

    public function delete()
    {
        $payment = Payment::find($this->idPayment);
        $payment->delete();
        $this->dispatch('payment-deleted', ['message' => "Payment bien rétiré !"]);
    }

    public function sendPaymentSMS($id)
    {
        $payment = Payment::find($id);
        if ($payment->student->studentResponsable) {
            SmsNotificationHelper::sendSMS(
                '+243898337969',
                '+243' . $payment->student->studentResponsable->phone,
                "C.S." . auth()->user()->school->name . "\nBonjour Mr/Mm Votre enfant "
                    . $payment->student->name
                    . " est en ordre avec le frais "
                    . $payment->cost->name . "\nCout: " . $payment->cost->amount . " " .
                    $payment->cost->currency->currency .
                    "\n Pour le mois de: " . app_get_month_name($payment->month_name)
            );
            $payment->has_sms = true;
            $payment->update();
            $this->dispatch('added', ['message' => 'Message bien envoyé']);
        } else {
            $this->dispatch('error', ["message'=>'Echec d'envoi"]);
        }
    }
    /**
     * Fix update inscription inscriptions by month for inscription_id and classe_id problems.
     */
    public function updateSoclyYearInscrption()
    {
        $listPayments = GetPaymentByMonthHelper::getMonthPayments(
            $this->month,
            $this->defaultScolaryYerId,
            $this->cost_id,
            $this->selectedIndex,
            $this->classe_id,
            $this->keyToSearch,
        );
        foreach ($listPayments as $payment) {
            $inscription = Inscription::join('students', 'students.id', 'inscriptions.student_id')
                ->where('inscriptions.scolary_year_id', 2)
                ->where('students.name', $payment->student->name)
                ->select('inscriptions.*')
                ->first();
            $payment->inscription_id = $inscription->id;
            $payment->classe_id = $inscription->classe_id;
            $payment->update();
        }
        $this->dispatch('added', ['message' => 'Action bein rélisée']);
    }

    public function mount($selectedIndex)
    {
        $this->selectedIndex = $selectedIndex;
        $this->classeList = (new SchoolHelper())->getListClasse();
        $this->month = date('m');
        $this->defaultScolaryYerId = (new SchoolHelper())->getCurrentScolaryYear()->id;
    }
    public function render()
    {
        $listCost = (new CostGeneralHelper())->getListCostGeneral($this->selectedIndex, $this->defaultScolaryYerId);
        return view('livewire.application.rapport.list.list-payment-global-rapport', [
            'listCost' => $listCost,
            'listPayments' => $this->date_to_search == null ? GetPaymentByMonthHelper::getMonthPayments(
                $this->month,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->selectedIndex,
                $this->classe_id,
                $this->keyToSearch,
            ) : GetPaymentByDateHelper::getDatePayments(
                $this->date_to_search,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->selectedIndex,
                $this->classe_id,
                $this->keyToSearch
            ),
            'amountPayments' => $this->date_to_search == null ? GetPaymentByMonthHelper::getAmoutMonthPayments(
                $this->month,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->selectedIndex,
                $this->classe_id,
                $this->keyToSearch,
            ) : GetPaymentByMonthHelper::getAmoutDatePayments(
                $this->date_to_search,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->selectedIndex,
                $this->classe_id,
                $this->keyToSearch
            )
        ]);
    }
}
