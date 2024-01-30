<x-modal.build-modal-fixed idModal='new-detail-agent-salary' size='xl' headerLabel="{{ $labelForm }}"
    headerLabelIcon='fas fa-plus-circle'>
    <div class="modal-body">
        <div class="d-flex justify-content-center">
            <x-widget.loading-circular-md/>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <form wire:submit='handlerSubmit'>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-form.label value="{{ __('Description') }}" />
                                <x-form.input class="" type='text' wire:model='name' />
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-form.label value="{{ __('Montant') }}" />
                                <x-form.input class="" type='text' wire:model='amount' />
                                @error('amount')
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
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            @if ($agentSalry != null)
                                <x-form.button type="submit" class="btn btn-primary">
                                    <x-widget.loading-circular-sm action='store' />
                                    Sauvegarder
                                </x-form.button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            @if ($agentSalry != null)
                <div class="col-md-6">
                    @if ($agentSalry->agentSalaryDetails->isEmpty())
                        <div>
                            <h4 class="text-success">fadata Aucune donnée trouvéé</h4>
                        </div>
                    @else
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="text-right">Monatnt</th>
                                    <th class="text-lg-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agentSalry->agentSalaryDetails as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->name }}</td>
                                        <td class="text-right">{{ $detail->amount }}</td>
                                        <td class="text-center">
                                            <x-form.button wire:click='edit({{ $detail }})'
                                                class="btn-sm text-primary" type="button">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </x-form.button>
                                            <x-form.button wire:click='delete({{ $detail }})'
                                                class="btn-sm text-danger"
                                                wire:confirm="Etes-vous sûre de supprimer?"
                                                type="button">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </x-form.button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total: {{app_format_number($agentSalry->getTotal())}} USD</h5>
                            </div>
                        </div>
                    @endif
                </div>

            @endif
        </div>
    </div>
</x-modal.build-modal-fixed>
