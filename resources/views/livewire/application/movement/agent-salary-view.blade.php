<div>
    @livewire('application.movement.detail-agent-salary-view')
    @php
        $total = 0;
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4> MOUVEMENTS SALAIRE</h4>
                        <a target="_blank" href="{{ route('print.agent.salary') }}" class="btn btn-primary"><i
                                class="fa fa-print" aria-hidden="true"></i>
                            Imprimer</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <x-widget.loading-circular-md />
                    </div>
                    <table class="table table-bordered mt-1">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Numero</th>
                                <th class="text-right">Montant</th>
                                <th class="text-right">Date mouvement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ListAgentSalary as $index => $agentSalary)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $agentSalary->number . '-' . app_get_month_name($agentSalary->month_name) }}
                                    </td>
                                    <td class="text-right">{{ app_format_number($agentSalary->getTotal()) }} usd</td>
                                    <td class="text-right">{{ $agentSalary->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <x-form.button wire:click='show({{ $agentSalary }})' class="btn-sm btn-primary"
                                            type="button" data-toggle="modal" data-target="#new-detail-agent-salary">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </x-form.button>
                                        <x-form.button wire:click='edit({{ $agentSalary }})' class="btn-sm btn-info"
                                            type="button">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </x-form.button>
                                        <x-form.button wire:click='delete({{ $agentSalary }})'
                                            class="btn-sm btn-danger" wire:confirm="Etes-vous sûre de supprimer?"
                                            type="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </x-form.button>
                                    </td>
                                </tr>
                                @php
                                    $total += $agentSalary->getTotal();
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <h3>Total: {{ app_format_number($total) }} USD</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ $formLabel }}
                </div>
                <form wire:submit='handlerSubmit'>
                    <div class="card-body">
                        <div class="form-group">
                            <x-form.label value="{{ __('Mois') }}" />
                            <x-widget.list-month wire:model='month_name' />
                            @error('month_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($isEditing)
                            <div class="form-group">
                                <x-form.label value="{{ __('Date création') }}" />
                                <x-form.input class="" type='date' wire:model='created_at' />
                                @error('created_at')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <x-form.button type="submit" class="btn btn-primary">
                            <x-widget.loading-circular-sm action='store' />
                            Sauvegarder
                        </x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
