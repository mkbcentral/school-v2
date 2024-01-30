<div>
    @livewire('application.inscription.forms.edit-inscription-form')
    @livewire('application.inscription.forms.edit-classe-and-inscription')
    @livewire('application.payment.widget.list-payments-by-student-widget')
    @livewire('application.inscription.forms.change-student-classe')
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fa fa-list" aria-hidden="true"></i> Liste des élèves</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Menu</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.main') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Liste élèves</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if ($inscriptions->isEmpty())
            <span class="text-success text-center p-4">
                <h4><i class="fa fa-database" aria-hidden="true"></i>
                    Aucune donnée trouvée !
                </h4>
            </span>
        @else
            <div class="card p-2 w-50">
                <h4><span class="">Classe:
                    </span>{{ $classeData->name . '/' . $classeData->classeOption->name }}</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <x-form.search-input wire:model.live.debounce.500ms="keyToSearch" />
                <a target="_blank" href="{{ route('print.list.inscription.by.classe', $classeData->id) }}"><i
                        class="fa fa-print" aria-hidden="true"></i> Imprimer la liste</a>
            </div>
            <table class="table table-stripped table-sm mt-2">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th class="text-center">#</th>
                        <th>Noms élève</th>
                        <th class="text-center">Genre</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscriptions as $index => $inscription)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $inscription->student->name .
                                '/' .
                                $inscription->classe->name .
                                ' ' .
                                $inscription->classe->classeOption->name }}
                            </td>

                            <td class="text-center">{{ $inscription->student->gender }}
                            </td>
                            <td class="text-center">
                                {{ $inscription->student->getAge($inscription->student->date_of_birth) }}
                            </td>
                            <td class="text-center">
                                @can('valid-payment')
                                    <x-form.button wire:click='getInscription({{ $inscription }})' class="btn-sm btn-info"
                                        type="button" data-toggle="modal" data-target="#paymentsByStudent">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </x-form.button>
                                    <x-form.button wire:click='editInscription({{ $inscription }})'
                                        class="btn-sm btn-secondary" type="button" data-toggle="modal"
                                        data-target="#editClasseAnInscription">
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                    </x-form.button>
                                    <x-form.button wire:click='showChangeClasseModal({{ $inscription }})'
                                        class="btn-sm btn-success" type="button" data-toggle="modal"
                                        data-target="#change-student-classe-modal">
                                        <i class="fas fa-user-check    "></i>
                                    </x-form.button>
                                    <x-form.button wire:click='edit({{ $inscription->student }})' class="btn-sm btn-info"
                                        type="button" data-toggle="modal" data-target="#formEditInscriptionModal">
                                        <i class="fas fa-edit"></i>
                                    </x-form.button>
                                    <x-form.button class=" btn-sm btn-danger" type="button"
                                        wire:click="showDeleteDialog({{ $inscription->id }})">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </x-form.button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @push('js')
        <script type="module">
            //Confirmation dialog for delete role
            window.addEventListener('delete-inscription-dialog', event => {
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
                        Livewire.dispatch('deleteInscriptionListner');
                    }
                })
            })
            window.addEventListener('inscription-deleted', event => {
                Swal.fire(
                    'Oprétion !',
                    event.detail[0].message,
                    'success'
                );
            });
        </script>
    @endpush
</div>
