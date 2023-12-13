<div>
    @livewire('application.payment.form.edit-payment-infos')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-group d-flex align-items-center">
                    <x-form.label value="{{ __('Date') }}" class="mr-2" />
                    <x-form.input class="" type='date' placeholder="Lieu de naissance"
                        wire:model.live='date_to_search' />
                </div>
                @livewire('application.payment.widget.sum-payment-total-by-date', ['date' => $date_to_search, 'defaultScolaryYerId' => $defaultScolaryYerId])
            </div>
        </div>
        
        <div class="card-bady">
            <div class="d-flex justify-content-center pb-2">
                <x-widget.loading-circular-md/>
            </div>
            @if ($listPayments->isEmpty())
                <span class="text-success text-center p-4">
                    <h4><i class="fa fa-database" aria-hidden="true"></i>
                        Aucune donnée trouvée !
                    </h4>
                </span>
            @else
                <h5 class="text-uppercase"><i class="fa fa-list " aria-hidden="true"></i> Liste des paiements journalières</h5>
                <table class="table table-stripped table-sm">
                    <thead class="thead-light">
                        <tr class="text-uppercase">
                            <th>#</th>
                            <th>Noms élève</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Mois</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPayments as $index => $payment)
                            <tr>
                                <td class="text-center">{{$index+1}}</td>
                                <td>{{ $payment->student->name }} {{ $payment->getStudentClasseName($payment) }}
                                </td>

                                <td class="text-center">{{ $payment->cost->name }}
                                </td>
                                <td class="text-center">
                                    {{ app_format_number($payment->amount) }} {{ $payment->cost->currency->currency }}
                                </td>
                                <td class="text-center">
                                    {{ app_get_month_name($payment->month_name) }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-link dropdown-icon" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item" wire:click='edit({{ $payment }})'
                                                data-toggle="modal" data-target="#editPayment"
                                                href="#"><i class="fas fa-edit    "></i>
                                                EDiter
                                            </a>
                                            <a class="dropdown-item" wire:click='printBill({{ $payment }})'>
                                                <i class="fas {{ $payment->is_paid ? ' fa-times-circle text-danger' : 'fa-check-double' }} "
                                                    aria-hidden="true"></i>
                                                    {{ $payment->is_paid ? ' Annuler' : 'Valider' }}
                                            </a>
                                            <a class="dropdown-item" target="_blank" href="{{ route('receipt.payment', [$payment, $payment->cost->currency->currency]) }}">
                                                <i class="fa fa-print" aria-hidden="true"></i> Imprimer
                                            </a>
                                            <a class="dropdown-item"wire:click="showDeleteDialog({{ $payment->id }})"
                                                href="#">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Supprimer
                                             </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    @push('js')
        <script type="module">
            //Confirmation dialog for delete role
            window.addEventListener('delete-payment-dialog', event => {
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
                        Livewire.dispatch('deletePaymentListner');
                    }
                })
            })
            window.addEventListener('payment-deleted', event => {
                Swal.fire(
                    'Oprétion !',
                    event.detail[0].message,
                    'success'
                );
            });
        </script>
    @endpush
</div>
