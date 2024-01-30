<x-modal.build-modal-fixed idModal='new-deposit-bank-missing' size='xl' headerLabel="{{ $labelForm }}"
    headerLabelIcon='fas fa-plus-circle'>
    <div class="modal-body">
        <div class="d-flex justify-content-center">
            <x-widget.loading-circular-md />
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <form wire:submit='handlerSubmit'>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-form.label value="{{ __('Montant') }}" />
                                <x-form.input class="" type='text' wire:model='amount' />
                                @error('amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-form.label value="{{ __('Description') }}" />
                                <x-form.input class="" type='text' wire:model='description' />
                                @error('description')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            @if ($bankDeposit != null)
                                <x-form.button type="submit" class="btn btn-primary">
                                    <x-widget.loading-circular-sm action='store' />
                                    Sauvegarder
                                </x-form.button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                @if ($bankDeposit)
                    <h5>Depot: {{ $bankDeposit->number . '-' . app_get_month_name($bankDeposit->month_name) }}</h5>
                    <h5>Date: {{ $bankDeposit->created_at->format('d/M/Y') }}</h5>
                    <h5>
                        Monent: {{ app_format_number($bankDeposit->amount) . ' ' . $bankDeposit->currency->currency }}
                    </h5>
                    <hr>
                    @if ($bankDeposit->bankDepositMissing)
                        <h5>Manquant:
                            {{ $bankDeposit->bankDepositMissing->amount . ' ' . $bankDeposit->currency->currency }}
                        </h5>
                        <h5>Description :</h5>
                        <p>{{ $bankDeposit->bankDepositMissing->description }}</p>
                        <div class="d-flex justify-content-end  " wire:confirm="Etes-vous sûre de supprimer?"
                            wire:click='delete({{ $bankDeposit->bankDepositMissing }})'>
                            <button class="btn btn-danger" type="button"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </div>
                    @endif
                @endif
            </div>
            <hr>
        </div>
    </div>
</x-modal.build-modal-fixed>
