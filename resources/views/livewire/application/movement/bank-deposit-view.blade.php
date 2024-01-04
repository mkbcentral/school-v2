<div>
    @php
        $total = 0;
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    LISTE DEPOT BANK
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <x-widget.loading-circular-md />
                    </div>
                    <table class="table table-bordered mt-1">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Numero</th>
                                <th class="text-right">Montant</th>
                                <th class="text-right">Date mouvement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBankDeposit as $index => $bankDeposit)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bankDeposit->number . '-' . app_get_month_name($bankDeposit->month_name) }}
                                    </td>
                                    <td class="text-right">{{ $bankDeposit->amount }}</td>
                                    <td class="text-right">{{ $bankDeposit->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <x-form.button wire:click='edit({{ $bankDeposit }})'
                                            class="btn-sm text-primary" type="button">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </x-form.button>
                                        <x-form.button wire:click='delete({{ $bankDeposit }})'
                                            class="btn-sm text-danger"
                                            wire:confirm="Etes-vous sûre de supprimer??" type="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </x-form.button>
                                    </td>
                                </tr>
                                @php
                                    $total += $bankDeposit->amount;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <h3>Total: {{ app_format_number($total) }} USD</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ $formLabel }}
                </div>
                <form wire:submit='handlerSubmit'>
                    <div class="card-body">
                        <div class="form-group">
                            <x-form.label value="{{ __('Montant') }}" />
                            <x-form.input class="" type='text' wire:model='amount' />
                            @error('amount')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form.label value="{{ __('Mois') }}" />
                            <x-widget.list-month wire:model='month_name' />
                            @error('month_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Dévise</label>
                            <select class="form-control" wire:model='currency_id'>
                                <option>Choisir la dévise</option>
                                @foreach ($listCurrency as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->currency }}
                                    </option>
                                @endforeach
                            </select>
                            @error('currency_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($isEditing)
                            <div class="form-group">
                                <x-form.label value="{{ __('Date création') }}" />
                                <x-form.input class="" type='date' wire:model='created_at' />
                                @error('created_at')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <x-form.button type="submit" class="btn btn-primary">
                            <x-widget.loading-circular-sm action='store' />
                            Sauvegarder
                        </x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
