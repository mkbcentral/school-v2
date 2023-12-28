<div>
    @livewire('application.inscription.forms.create-new-inscription-form', ['index' => $selectedIndex])
    @include('livewire.application.inscription.modals.list-student-in-familly-modal')
    @livewire('application.messaging.forms.send-new-sms-form')
    @include('livewire.application.inscription.modals.edit-familly-modal')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-2">
                <h4 class="text-uppercase text-bold">LISTE DES FAMILLES</h4>
                <x-form.search-input />
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center pb-2">
                <x-widget.loading-circular-md />
            </div>
            @if ($listResponsible->isEmpty())
            <x-data-empty />
            @else
            <table class="table table-stripped table-sm">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th class="text-center">#</th>
                        <th>NOM FAMILLE</th>
                        <th class="text-right">TELEPHONE</th>
                        <th class="text-center">NBRE ENFANT</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listResponsible as $index => $responsable)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $responsable->name_responsable }}</td>
                        <td class="text-right">{{ $responsable->phone }}</td>
                        <td class="text-center">{{ $responsable->students->count() }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-link dropdown-icon" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-white"></i>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item" wire:click="getResponsable({{ $responsable }})"
                                        data-toggle="modal" data-target="#formInscriptionModal" href="#"><i
                                            class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Ajouter une inscription</a>
                                    <a class="dropdown-item" wire:click="show({{ $responsable }})" data-toggle="modal"
                                        data-target="#lisStudentInFamillyModal" href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Voir les élèves</a>
                                    <a class="dropdown-item" wire:click="show({{ $responsable }})" data-toggle="modal"
                                        data-target="#editFamillyModal" href="#">
                                        <i class="fas fa-edit    "></i> Editer une famille</a>
                                    <a class="dropdown-item" wire:click="delete({{ $responsable->id }})" href="#">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Supprimer une famille</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $listResponsible->links('livewire::bootstrap') }}
            @endif
        </div>
    </div>
</div>