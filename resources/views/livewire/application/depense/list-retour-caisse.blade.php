<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="listRetourCaisseModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="listRetourCaisseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listRetourCaisseModalLabel">
                        NOS RESROURE CAISSE
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
                    </div>
                    <div class="row" wire:loading.class='d-none'>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    LISTE DES RETOURS CAISSE
                                </div>
                                <div class="card-body">
                                    @if ($depense)
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Code: {{$depense?->code}}</h5>
                                                <h5 class="card-title">Montant: {{$depense?->amount}} {{$depense->currency->currency}}</h5><br>
                                                <h5 class="card-title">Source: {{$depense->depenseSource->name}}</h5>
                                                <h5 class="card-text">Categorie: {{$depense?->categoryDepense->name}}</h5>
                                                <h5 class="card-title">Réalisé le: {{$depense->created_at->format('d/m/Y')}}</h5>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between ">
                                        <select class="form-control w-25" wire:model.live='month' id="">
                                            @foreach ($months as $m)
                                                <option value="{{ $m }}">{{ app_get_month_name($m) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span wire:loading
                                        class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span>
                                    </div>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Montant</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($listEmprunt->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center text-success">
                                                        <i class="fa fa-database" aria-hidden="true"></i>
                                                        Aucune donnée trouvée !
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($listEmprunt as $index => $emprunt)
                                                    <tr>
                                                        <td scope="row">{{ $index + 1 }}</td>
                                                        <td>{{ $emprunt->created_at->format('d/m/Y') }}</td>
                                                        <td>{{ $emprunt->code }}</td>
                                                        <td>{{ $emprunt->name }}</td>
                                                        <td>{{ $emprunt->amount }}</td>
                                                        <td class="text-center">
                                                            <x-form.button
                                                                wire:click='edit({{ $emprunt }},{{ $emprunt->id }})'
                                                                class="btn-sm text-primary" type="button">
                                                                <span wire:loading
                                                                    wire:target="edit({{ $emprunt }},{{ $emprunt->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </x-form.button>
                                                            <x-form.button wire:click='delete({{ $emprunt->id }})'
                                                                class="btn-sm text-danger" type="button">
                                                                <span wire:loading
                                                                    wire:target="delete({{ $emprunt->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </x-form.button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form
                                @if ($isEditing == false) wire:submit='store'
                                @else
                                wire:submit='update' @endif>
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas {{ $isEditing == false ? 'fa-plus-circle' : 'fa-edit' }}"></i>
                                        {{ $isEditing == false ? 'NOUVEAU EMPRUNT' : 'MODIFICATION EMPRUNT' }}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Description') }}" />
                                            <x-form.input class="" type='text' placeholder="Description"
                                                wire:model='name' />
                                            @error('name')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Montant') }}" />
                                            <x-form.input class="" type='text' placeholder="Montant"
                                                wire:model='amount' />
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
                                        @if($isEditing == true)
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Date emprunt') }}" />
                                            <x-form.input class="" type='date' placeholder="Date emprunt"
                                                wire:model='created_at' />
                                            @error('created_at')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-footer text-muted">
                                        <x-form.button type="submit" class="btn btn-primary">
                                            <span wire:loading wire:target="store"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <i class="fas {{ $isEditing == false ? 'fa-save' : 'fa-edit' }}"></i>
                                            {{ $isEditing == false ? 'Sauvegarder' : 'Modifier' }}
                                        </x-form.button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
