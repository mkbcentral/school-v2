<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex justify-content-between align-items-center">
                    <h5>LISTE DES EMPRUNTS</h5>
                    <a href="{{ route('emprunt.month', [$month]) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"
                        aria-hidden="true"></i> Imprimer</a>
                   </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between ">
                        <h4 class="bg-secondary p-2 rounded">Total:
                            @foreach ($totalByCurrency as $total)
                                <span class="text-info">{{ $total->currency }}:
                                </span><span>{{ app_format_number($total->total) }}</span>
                            @endforeach
                        </h4>
                        <select class="form-control w-25" wire:model.live='month' id="">
                            @foreach ($months as $m)
                                <option value="{{ $m }}">{{ app_get_month_name($m) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span wire:loading class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-uppercase">
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>MT USD</th>
                                <th>MT CDF</th>
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
                                        <td>{{ $emprunt->description }}</td>
                                        <td>
                                            {{$emprunt->currency_name=='USD'?$emprunt->amount.' $':'-'}}
                                        </td>
                                        <td>
                                            {{$emprunt->currency_name=='CDF'?$emprunt->amount.' Fc':'-'}}
                                        </td>
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
                                wire:model='description' />
                            @error('description')
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
                        @if ($isEditing == true)
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
