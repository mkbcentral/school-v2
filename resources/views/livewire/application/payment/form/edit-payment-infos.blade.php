<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editPayment" tabindex="-1" role="dialog"
         aria-labelledby="editPaymentLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=editPaymentLabel">
                        <i class="fas fa-edit"></i> MODIFICATION PAIEMENT
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='update'>
                    <div class="modal-body">
                        @if ($payment != null)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{ $payment->student->name }}</h6>
                                <h6><span class="text-bold text-info">Classe: {{$payment->getStudentClasseName($payment)}}</span></h6>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Date de paiement') }}" />
                                                <x-form.input class="" type='date'
                                                         wire:model='created_at' />
                                                @error('created_at')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Frais') }}" />
                                                <x-select wire:model='cost_other_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listOtherCost as $cost)
                                                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            @error('cost_other_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Mois') }}" />
                                                <x-select wire:model='month'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($months as $month)
                                                        <option value="{{ $month }}">{{ app_get_month_name($month) }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            @error('month')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">Sauvegarder</x-form.button>
                        <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
