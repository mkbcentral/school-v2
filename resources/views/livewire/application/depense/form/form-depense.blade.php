<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formDepenseModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="formDepenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formDepenseModalLabel">
                        {{$isEditing==false?'NOUVELLE DEPENSE':'EDITION DEPENSE'}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="d-flex justify-content-center">
                    <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
                </div>
                <form @if($isEditing==false)
                    wire:submit='store'
                     @else wire:submit='update'
                      @endif>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Description') }}" />
                                        <x-form.input class="" type='text' placeholder="Description"
                                            wire:model='name' />
                                        @error('name')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Source de la dépense') }}" />
                                                <x-select wire:model='depense_source_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listDepenseSource as $source)
                                                    <option value="{{ $source->id }}">
                                                        {{ $source->name }}</option>
                                                    @endforeach
                                                </x-select>
                                                @error('depense_source_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Catégorie dépenses') }}" />
                                                <x-select wire:model='category_depense_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listCategoryDepense as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                    @endforeach
                                                </x-select>
                                                @error('category_depense_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Montant') }}" />
                                                <x-form.input class="" type='text' placeholder="Montant" wire:model='amount' />
                                                @error('amount')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Devise') }}" />
                                                <x-select wire:model='currency_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listCurrency as $currency)
                                                    <option value="{{ $currency->id }}">
                                                        {{ $currency->currency }}
                                                    </option>
                                                    @endforeach
                                                </x-select>
                                                @error('currency_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Date dépense') }}" />
                                                <x-form.input class="" type='date' placeholder="Date dépense"
                                                wire:model='created_at' />
                                                @error('created_at')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">
                            {{$isEditing==false?'Sauvegarder':'Modifier'}}
                        </x-form.button>
                        <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
