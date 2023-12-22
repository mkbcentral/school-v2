<div>
    <form wire:submit='handlerSubmit'>
        <div class="card">
            <div class="card-header">
                <i class="fas {!! $empruntToEdit == null ? 'fa-plus-circle' : 'fa-edit' !!} lign-items-start"></i>
                {!! $empruntToEdit == null ? 'NOUVEAU EMPRUNT' : 'MODIFICATION EMPRUNT' !!}
            </div>
            <div class="card-body">
                <div class="form-group">
                    <x-form.label value="{{ __('Description') }}" />
                    <x-form.input class="" type='text' placeholder="Description" wire:model='description' />
                    @error('description')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-form.label value="{{ __('Montant') }}" />
                    <x-form.input class="" type='text' placeholder="Montant" wire:model='amount' />
                    @error('amount')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Dévise</label>
                    <select class="form-control" wire:model='currency_id' id="">
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
                @if ($empruntToEdit != null)
                <div class="form-group">
                    <x-form.label value="{{ __('Date emprunt') }}" />
                    <x-form.input class="" type='date' placeholder="Date emprunt" wire:model='created_at' />
                    @error('created_at')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endif
            </div>
            <div class="card-footer text-muted d-flex justify-content-end">
                <x-form.button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    <i class="fas fa-save"></i>
                    Sauvegarder
                </x-form.button>
            </div>
        </div>
    </form>
</div>