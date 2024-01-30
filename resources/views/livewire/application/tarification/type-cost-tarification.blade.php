<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="typeCostTarif" tabindex="-1" data-backdrop="static" data-keyboard="false"
        role="dialog" aria-labelledby="typeCostTarifLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="typeCostTarifLabel">
                        <i class="fas fa-plus-circle"></i> PASSE UN NOUVEAU PAIEMENT
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form
                                @if ($isEditing == true) wire:submit='update'
                            @else
                            wire:submit='store' @endif>
                                <div class="form-group">
                                    <x-form.label value="{{ __('Nom type frais') }}" />
                                    <x-form.input class="" type='text' placeholder="Nom frais"
                                        wire:model='name' />
                                    @error('name')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <x-form.label value="{{ __('Type frais') }}" />
                                    <x-select wire:model.live='currency_id'>
                                        <option value="">Choisir...</option>
                                        @foreach ($listCurrecies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->currency }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @error('currency_id')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <x-form.button type="submit"
                                    class="btn btn-primary">{{ $isEditing == true ? 'Modifier' : 'Sauvegarder' }}</x-form.button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>Nom type frais</th>
                                                <th>Devise</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listTypeCost as $index => $type)
                                                <tr>
                                                    <td scope="row">{{ $index + 1 }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>{{ $type?->currency?->currency }}</td>
                                                    <td>
                                                        <x-form.button wire:click='edit({{ $type->id }})'
                                                            class="btn-sm text-primary" type="button">
                                                            <span wire:loading wire:target="edit({{ $type->id }})"
                                                                class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </x-form.button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $listTypeCost->links('vendor.livewire.bootstrap') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                </div>
            </div>
        </div>
    </div>
</div>
