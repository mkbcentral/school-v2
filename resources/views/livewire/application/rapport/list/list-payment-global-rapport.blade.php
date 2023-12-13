<div>
    @livewire('application.payment.form.edit-payment-infos')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="form-group mr-2">
                <x-form.label value="{{ __('Choisir un le mois') }}" />
                <x-widget.list-month wire:model.live='month' />
            </div>
            <div class="form-group">
                <x-form.label value="{{ __('Filtrer par date') }}" />
                <x-form.input class="" type='date' placeholder="Lieu de naissance"
                    wire:model.live='date_to_search' />
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            <div class="form-group ">
                <x-form.label value="{{ __('Choisor frais') }}" />
                <x-select wire:model.live='cost_id'>
                    <option value="">Choisir...</option>
                    @foreach ($listCost as $cost)
                        <option value="{{ $cost->id }}">
                            {{ $cost->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Filtrer par par classe') }}" />
                <x-select wire:model.live='classe_id'>
                    <option value="">Choisir...</option>
                    @foreach ($classeList as $classe)
                        <option value="{{ $classe->id }}">
                            {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>

    </div>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <x-form.search-input />
            <div class="d-flex justify-content-center align-items-center">
                <x-widget.loading-circular-md/>
            </div>
            <div class="d-flex">
                <x-form.button type="button" wire:click='loadData' class="btn btn-primary btn-sm mr-2">
                    <i class="fas fa-sync" aria-hidden="true"></i> Actualiser
                </x-form.button>
                @if (config('app.env')=='production')}
                <x-form.button type="button" wire:click='updateSoclyYearInscrption' class="btn btn-danger btn-sm">
                    <i class="fas fa-toolbox    "></i> Fixing
                </x-form.button>
                @endif
               
                <div class="bg-warning ml-2 p-2">
                   @if ($amountPayments==null)
                   <h6 class="text-bold text-uppercase">Total: {{ app_format_number(0) }}</h6 class="tex-bold">
                   @else
                   @foreach ($amountPayments as $payment)
                   <h6 class="text-bold text-uppercase">Total: {{ app_format_number($payment->amount) }} {{ $payment->currency }}</h6 class="tex-bold">
               @endforeach
                   @endif
                </div>
            </div>
        </div>
        @if ($listPayments->isEmpty())
            <x-data-empty />
        @else
            <table class="table table-stripped table-sm mt-2">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Date</th>
                        <th>Noms élève</th>
                        <th class="text-center">sms status</th>
                        <th class="text-right">Type frais</th>
                        <th class="text-right">Montant</th>
                        <th class="text-right">Mois</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listPayments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                            <td>
                                {{$payment->student->name .'/'.$payment?->getStudentClasseName($payment)}}
                            </td>
                            <td class="text-center">
                                <span class="{{ $payment->has_sms ? 'text-success' : 'text-danger' }}">
                                    {{ $payment->has_sms ? 'Envoyé' : 'Non envoyé' }}

                                </span>
                                {{ $payment?->student?->studentResponsable?->phone }}
                            </td>
                            <td class="text-right">{{ $payment->cost->name }}</td>
                            <td class="text-right">{{ app_format_number($payment->amount) }}
                                {{ $payment->cost->currency->currency }}</td>
                            <td class="text-center">
                                {{ app_get_month_name($payment->month_name) }}
                            </td>
                            <td class="text-center">

                                <x-form.button class="btn-success btn-sm" type="button"
                                    wire:click="sendPaymentSMS({{ $payment->id }})">

                                    <i class="fab fa-telegram" aria-hidden="true"></i>
                                </x-form.button>
                                <x-form.button wire:click='edit({{ $payment }})' class="btn-sm text-secondary"
                                    type="button" data-toggle="modal" data-target="#editPayment">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </x-form.button>
                                <x-form.button class="btn-danger btn-sm" type="button"
                                    wire:click="showDeleteDialog({{ $payment->id }})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </x-form.button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $listPayments->links('vendor.livewire.bootstrap') }}
        @endif
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
