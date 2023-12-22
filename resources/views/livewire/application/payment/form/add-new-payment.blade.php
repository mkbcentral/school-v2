<x-modal.build-modal-fixed idModal='newPayment' size='xl' headerLabel='PASSE UN NOUVEAU PAIEMENT'
    headerLabelIcon='fas fa-plus-circle'>
    <form wire:submit='store'>
        <div class="modal-body">
            @if ($inscription)
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-2">
                            <h6><span class="text-bold text-info">Nom:</span>{{ $inscription->student->name }}
                            </h6>
                            <h6><span class="text-bold text-info">Classe:
                                    {{ $inscription->getStudentClasseName($inscription) }}</span>
                            </h6>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Type frais') }}" />
                                            <x-widget.list-type-cost-select-widget
                                                wire:model.live='type_other_cost_id' />
                                            @error('type_other_cost_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Frais') }}" />
                                            <x-widget.list-cost-general-select-widget type='{{ $selectedTypeCost }}'
                                                wire:model.live='cost_general_id' />
                                            @error('cost_general_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Mois') }}" />
                                            <x-widget.list-month wire:model='month' />
                                            @error('month')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <h4 class="mt-2 text-info text-bold">Montant à payer: {{ $amountLabel }}
                                    {{ $currency }}
                                </h4 class="mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @livewire('application.payment.list.list-payment-by-inscription', ['inscription' => $inscription])
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <x-form.button type="submit" class="btn btn-primary">
                <x-widget.loading-circular-sm action='store' />
                Sauvegarder
            </x-form.button>
            <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
        </div>
    </form>
</x-modal.build-modal-fixed>
