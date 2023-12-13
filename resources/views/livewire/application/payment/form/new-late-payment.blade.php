<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="newLatePayment" tabindex="-1" role="dialog"
        aria-labelledby="newLatePaymentLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLatePaymentLabel">
                        <i class="fas fa-plus-circle"></i> PASSE UN NOUVEAU PAIEMENT
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($student)
                        <div class="row">
                            <div class="col-md-4">
                                <form wire:submit='store'>
                                    <div class="card p-2">
                                        <h6><span class="text-bold text-info">Nom:</span>{{ $student->name }}</h6>
                                        <h6><span class="text-bold text-info">
                                                Classe
                                                passée:{{ $student->inscription->getStudentClasseName($student->inscription) }}</span>
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Type frais') }}" />
                                        <x-select wire:model.live='type_cost_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($listTypeCost as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('type_cost_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Frais') }}" />
                                        <x-select wire:model.live='cost_general_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($listCost as $cost)
                                                <option value="{{ $cost->id }}">{{ $cost->name }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('cost_general_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Dévise') }}" />
                                                <x-select wire:model.live='currency'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listCurrency as $currency)
                                                        <option value="{{ $currency->currency }}">{{ $currency->currency }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                                @error('currency')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Montant') }}" />
                                                <x-form.input class="" type='text' placeholder="Montant"
                                                    wire:model='amount' />
                                                @error('amount')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Mois') }}" />
                                                <x-select wire:model.live='month'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($months as $month)
                                                        <option value="{{ $month }}">{{app_get_month_name($month) }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                                @error('month')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Date de paiment') }}" />
                                                <x-form.input class="" type='date' placeholder="Date de paiement"
                                                    wire:model='created_at' />
                                                @error('created_at')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>                                  
                                   
                                    <x-form.button type="submit" class="btn btn-primary w-100">Sauvegarder</x-form.button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                @livewire('application.payment.widget.status-paylent-checker-widget', ['student' => $student])
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
