<?php

namespace App\Livewire\Application\Tarification;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\Cost\CrudCostGeneralHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use Illuminate\Support\Collection;
use Livewire\Component;

class CostTarification extends Component
{
    public Collection $listTarif;
    public $idDefaultIdScolaryYear;
    public CostGeneral $costGeneral;
    public bool $isEditing = false;
    public $costGeneralId;
    public $keyToSearch='';

    protected $listeners = [
        'refreshListTarification' => '$refresh',
        'deleteTarifListner'=>'delete'
    ];


    public function new()
    {
        $this->isEditing = false;
        $this->dispatch('getTarifCreateFormData', $this->isEditing);
    }
    public function edit(CostGeneral $costGeneral, string $id)
    {
        $this->isEditing = true;
        $this->dispatch('getTarifEditFormData', $costGeneral, $this->isEditing);
    }

    public function showDeleteDialog(string $id): void
    {
        $this->costGeneralId = $id;
        $this->dispatch('delete-cost-dialog');
    }

    public function delete()
    {
        try {
            $costGeneral=CrudCostGeneralHelper::show($this->costGeneralId);
            CrudCostGeneralHelper::delete($costGeneral);
            $this->dispatch('cost-dialog-deleted', ['message'=>"Action bien réalisée !"]);
        } catch (\Exception $ex) {
            $this->dispatch('error',  $ex->getMessage());
        }
    }
    public function mount(){
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $this->idDefaultIdScolaryYear=$scolaryYear->id;
    }

    public function render()
    {
        return view('livewire.application.tarification.cost-tarification',[
            'lisCostGeneral'=>(new CostGeneralHelper())
            ->getListCostGeneralByScolaryYEar($this->idDefaultIdScolaryYear,$this->keyToSearch)
        ]);
    }
}
