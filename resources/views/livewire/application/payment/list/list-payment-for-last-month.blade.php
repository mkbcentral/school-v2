<div>
    @php
        $total = 0;
    @endphp
    <div class="row">
        <div class="form-group">
            <x-form.label value="{{ __('Mois en cours') }}" />
            <x-widget.list-month wire:model.live='month' />
            @error('month')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group ml-2">
            <x-form.label value="{{ __('Mois en prochain') }}" />
            <x-widget.list-month wire:model.live='next_month' />
            @error('next_month')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group ml-2">
            <x-form.label value="{{ __('Type frais') }}" />
            <x-widget.list-type-cost-select-widget wire:model.live='type_other_cost_id' />
            @error('type_other_cost_id')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-center align-items-center">
            <x-widget.loading-circular-md />
        </div>
        @if ($payments->isEmpty())
            <x-data-empty />
        @else
            <table class="table table-stripped table-sm mt-2">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Date</th>
                        <th>Noms élève</th>
                        <th class="text-right">Type frais</th>
                        <th class="text-right">Montant</th>
                        <th class="text-right">Mois</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                            <td>
                                {{ $payment->student->name }}
                            </td>
                            <td class="text-right">{{ $payment->cost->name }}</td>
                            <td class="text-right">{{ app_format_number($payment->amount) }}
                                {{ $payment->cost->currency->currency }}</td>
                            <td class="text-center">
                                {{ app_get_month_name($payment->month_name) }}
                            </td>
                            @php
                                $total += $payment->amount;
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end bg-navy p-1 rounded-lg pr-2">
                <h3 wire:loading.class="d-none">
                    <span>Total</span>
                    <span class="money_format">CDF: {{ app_format_number($total, 1) }}</span> |
                </h3>
            </div>
        @endif
    </div>
</div>
