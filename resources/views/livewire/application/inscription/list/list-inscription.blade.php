<div class="mt-6">
    <div class="card card-info">
        <div class="card-header">
            <h5><i class="fas fa-list"></i>LISTE DES INSCRIPTIONS JOUNALIERES</h5>
        </div>
        <div class="card-body">
            <div>
                @livewire('application.inscription.forms.edit-inscription-form')
                @livewire('application.inscription.forms.edit-classe-and-inscription')
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="inscription">
                                @can('view-total-amount')
                                    <div class="d-flex justify-content-end">
                                        @can('view-total-amount')
                                            <x-form.button wire:click="refreshList" type="button" class="btn btn-warning"
                                                data-toggle="modal" data-target="#showListInscriptionPaymentByDateModal">
                                                @livewire('application.payment.widget.sum-inscription-by-day-widget', [
                                                    'date' => $date_to_search,
                                                    'defaultScolaryYerId' => $defaultScolaryYerId,
                                                    'classeId' => $classe_id,
                                                    'currency' => $defaultCureencyName,
                                                ])
                                            </x-form.button>
                                        @endcan
                                        <x-form.button type="button" wire:click='loadData' class="btn btn-info ml-2">
                                            <i class="fas fa-sync" aria-hidden="true"></i> Actualiser
                                        </x-form.button>
                                    </div>
                                @endcan
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($selectedIndex == 0)
                                        <div class="form-group ">
                                            <x-form.label value="{{ __('Choisir une option') }}" />
                                            <x-select wire:model.live='classe_option_id'>
                                                <option value="">Choisir...</option>
                                                @foreach ($classeOptionList as $classeOptionList)
                                                    <option value="{{ $classeOptionList->id }}">
                                                        {{ $classeOptionList->name }}</option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                    @endif
                                    <div class="form-group ">
                                        <x-form.label value="{{ __('Filtrer par par classe') }}" />
                                        <x-select wire:model.live='classe_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($classeList as $classe)
                                                <option value="{{ $classe->id }}">
                                                    {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Filtrer par date') }}" />
                                            <x-form.input class="" type='date' wire:model.live='date_to_search' />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <x-widget.loading-circular-md />

                                    </div>
                                    @if ($inscriptions->isEmpty())
                                        <span class="text-success text-center p-4">
                                            <h4><i class="fa fa-database" aria-hidden="true"></i>
                                                Aucune donnée trouvée !
                                            </h4>
                                        </span>
                                    @else
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <h4 class="text-uppercase text-bold">Inscriptions journalières</h4>
                                            </div>
                                        </div>
                                        <table class="table table-stripped table-sm">
                                            <thead class="thead-light">
                                                <tr class="text-uppercase">
                                                    <th class="text-center">#</th>
                                                    <th>Noms élève</th>
                                                    <th class="text-center">Genre</th>
                                                    <th class="text-center">Age</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inscriptions as $index => $inscription)
                                                    <tr>
                                                        <td class="text-center">{{ $index + 1 }}</td>
                                                        <td>{{ $inscription->student->name . '/' . $inscription->classe->name . ' ' . $inscription->classe->classeOption->name }}
                                                        </td>

                                                        <td class="text-center">{{ $inscription->student->gender }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $inscription->student->getAge($inscription->student->date_of_birth) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span
                                                                class="badge badge-{{ $inscription->getPaiementStatusColor($inscription) }}">{{ $inscription->getPaiementStatus($inscription) }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            @can('valid-payment')
                                                                <x-form.button
                                                                    wire:click='valideInscriptionPayement({{ $inscription }})'
                                                                    class="btn-sm text-secondary" type="button">
                                                                    <i class="fas {{ $inscription->is_paied ? ' fa-times-circle text-danger' : 'fa-check-double' }} "
                                                                        aria-hidden="true"></i>
                                                                </x-form.button>
                                                                @if ($inscription->is_paied)
                                                                    <a href="{{ route('receipt.inscription', [$inscription, 'USD']) }}"
                                                                        target="_blank"><i class="fas fa-print"></i></a>
                                                                @endif
                                                            @endcan
                                                            @can('edit-student-infos')
                                                                <x-form.button wire:click='editInscription({{ $inscription }})'
                                                                    class="btn-sm text-secondary" type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#editClasseAnInscription">
                                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                                </x-form.button>
                                                                <x-form.button wire:click='edit({{ $inscription->student }})'
                                                                    class="btn-sm" type="button" data-toggle="modal"
                                                                    data-target="#formEditInscriptionModal">
                                                                    <i class="fas fa-edit text-primary"></i>
                                                                </x-form.button>
                                                                <x-form.button class=" btn-sm" type="button"
                                                                    wire:click="showDeleteDialog({{ $inscription->id }})">
                                                                    <i class="fa fa-trash text-danger"
                                                                        aria-hidden="true"></i>
                                                                </x-form.button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $inscriptions->links('vendor.livewire.bootstrap') }}
                                    @endif
                                </div>
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
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
