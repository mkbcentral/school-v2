<div>
    @livewire('application.inscription.forms.create-new-inscription-form', ['index' => $selectedIndex])
    @include('livewire.application.inscription.modals.list-student-in-familly-modal')
    @livewire('application.messaging.forms.send-new-sms-form')
    @include('livewire.application.inscription.modals.edit-familly-modal')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fa fa-users" aria-hidden="true"></i> LISTE DES FAMILLES</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Menu</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('dashboard.main') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Liste familles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <x-form.search-input  wire:model.live.debounce.500ms="keyToSearch" />
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
                                                <button type="button" class="btn btn-link dropdown-icon"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cog text-white" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item"
                                                        wire:click="showFromSoSendSms({{ $responsable }})"
                                                        data-toggle="modal" data-target="#sendNewSmsModal"
                                                        href="#">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        Envoyer un SMS</a>
                                                    <a class="dropdown-item" wire:click="show({{ $responsable }})"
                                                        data-toggle="modal" data-target="#lisStudentInFamillyModal"
                                                        href="#">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> Voir les élèves</a>
                                                    <a class="dropdown-item" wire:click="show({{ $responsable }})"
                                                        data-toggle="modal" data-target="#editFamillyModal"
                                                        href="#">
                                                        <i class="fas fa-edit    "></i> Editer une famille</a>
                                                    <a class="dropdown-item"
                                                        wire:click="showDeleteDialog({{ $responsable->id }})"
                                                        href="#">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Supprimer une
                                                        famille</a>
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
    </div>
    @push('js')
        <script type="module">
            //Confirmation dialog for delete role
            window.addEventListener('delete-familly-dialog', event => {
                Swal.fire({
                    title: 'Voulez-vous vraimant ',
                    text: "supprimer ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteFamillyListner');
                    }
                })
            })
            window.addEventListener('familly-deleted', event => {
                Swal.fire(
                    'Oprétion !',
                    event.detail[0].message,
                    'success'
                );
            });
        </script>
    @endpush
</div>
