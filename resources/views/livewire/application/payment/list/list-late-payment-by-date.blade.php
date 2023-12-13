<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="ListLatePaymentModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="ListLatePaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ListLatePaymentModalLabel">
                        <i class="fa fa-list" aria-hidden="true"></i> LISTE PAIMENT ARRIRES
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="form-group mr-2">
                                <x-form.label value="{{ __('Filtre par date') }}" />
                                <x-form.input class="" type='date' placeholder="Filtre par date"
                                    wire:model.live='date' />
                            </div>
                            <div class="form-group ">
                                <x-form.label value="{{ __('Filtre par mois') }}" />
                                <x-select wire:model.live='month'>
                                    <option value="">Choisir...</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}">{{ app_get_month_name($month) }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-primary" href=""><i class="fa fa-print" aria-hidden="true">
                                    Imprimer le rapport</i></a>
                        </div>
                    </div>
                    @if ($listPayment->isEmpty())
                        <x-data-empty />
                    @else
                        <div class="d-flex justify-content-end">
                            @if ($isByDate)
                                <h4>Total/Jour: @livewire('application.payment.widget.sum-late-payment-by-date-widget')</h4>
                            @else
                                <h4>Total/Mois: @livewire('application.payment.widget.sum-late-payment-by-month-widget')</h4>
                            @endif
                        </div>
                        <table class="table table-stripped table-sm">
                            <thead class="bg-primary">
                                <tr class="text-uppercase">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Noms élève</th>
                                    <th class="">Type frais</th>
                                    <th class="text-right">Montant</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPayment as $index => $payment)
                                    <tr>
                                        <td class="d-flex align-items-center">{{ $index + 1 }}
                                            <span wire:loading class="spinner-border pinner-border-sm"
                                                wire:target='update({{ $payment->id }})' role="status"
                                                aria-hidden="true"></span>
                                        </td>
                                        <td>
                                            @if ($isEditing == true && $idSeleted == $payment->id)
                                                <x-form.input class="" type='date' placeholder="Filtre par date"
                                                    wire:model.live='date'
                                                    wire:keydown.enter='update({{ $payment->id }})' />
                                            @else
                                                {{ $payment->created_at->format('d/m/Y') }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $payment->inscription?->student?->name }}
                                        </td>
                                        <td>
                                            {{ $payment?->costGeneral->name }}/{{ app_get_month_name($payment->month_name) }}
                                        </td>
                                        <td class="text-right">
                                            @if ($isEditing == true && $idSeleted == $payment->id)
                                                <x-form.input class="" type='amount' placeholder="Montant"
                                                    wire:model.live='amount'
                                                    wire:keydown.enter='update({{ $payment->id }})' />
                                            @else
                                                {{ app_format_number($payment->amount) }} {{ $payment->currency }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <x-form.button
                                                wire:click='show({{ $payment }},{{ $payment->id }})'
                                                class="text-info" type="button">
                                                <span wire:loading class="spinner-border pinner-border-sm"
                                                    wire:target='show({{ $payment }},{{ $payment->id }})'
                                                    role="status" aria-hidden="true"></span>
                                                <i class="fas fa-edit"></i>
                                            </x-form.button>
                                            <x-form.button wire:click='delete({{ $payment->id }})'
                                                class="text-danger" type="button">
                                                <span wire:loading class="spinner-border pinner-border-sm"
                                                    wire:target='delete({{ $payment->id }})' role="status"
                                                    aria-hidden="true"></span>
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </x-form.button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
