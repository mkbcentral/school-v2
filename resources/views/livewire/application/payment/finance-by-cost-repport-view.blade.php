<div>
    @php
        $recettes = 0;
        $total_depense = 0;
        $type_costs = App\Models\TypeOtherCost::whereIn('id', [11, 12, 15, 16])->get();

    @endphp
    <div class="container">
        <h2 class="text-uppercase text-center text-primary"><i class="fas fa-chart-line"></i>
            Rapport fincier année
            scolare
            2023-2024 recettes globales</h2>
        <table class="table table-bordered text-bold table-sm active">
            <thead class="table-primary">
                <tr>
                    <td>MOIS</td>
                    @foreach ($type_costs as $type_cost)
                        <td class="text-right">
                            {{ $type_cost->name }}
                        </td>
                    @endforeach
                    <th class="bg-danger">RECETTES GLOBALES</th>
                    <th class="bg-danger">DEPENSES</th>
                    <th class="bg-danger">SOLDE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($months as $month)
                    <tr>
                        <td class="text-uppercase">{{ $month['name'] }}</td>
                        @foreach ($type_costs as $type_cost)
                            @php
                                $total = App\Models\Payment::query()
                                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                                    ->where('payments.month_name', $month['value'])
                                    ->where('cost_generals.type_other_cost_id', $type_cost->id)
                                    ->where('payments.is_paid', true)
                                    ->sum('cost_generals.amount');

                            @endphp
                            <td class="text-right">

                                @if ($type_cost->id == 15 || $type_cost->id == 16)
                                    @php
                                        $total = $total / 2700;
                                    @endphp
                                @endif
                                {{ app_format_number($total) }}

                            </td>
                        @endforeach
                        @php
                            $payments = App\Models\Payment::query()
                                ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                                ->where('payments.month_name', $month['value'])
                                ->whereIn('cost_generals.type_other_cost_id', [11, 12, 15, 16])
                                ->where('payments.is_paid', true)
                                ->get();
                            $amount_rec = 0;
                            foreach ($payments as $payment) {
                                if (
                                    $payment->cost->type_other_cost_id == 15 ||
                                    $payment->cost->type_other_cost_id == 16
                                ) {
                                    $amount_rec += $payment->cost->amount / 2700;
                                } else {
                                    $amount_rec += $payment->cost->amount;
                                }
                            }
                            $recettes = $amount_rec;

                        @endphp
                        @php
                            $total_usd = App\Models\Depense::query()
                                ->join('depense_sources', 'depense_sources.id', '=', 'depenses.depense_source_id')
                                ->where('depense_sources.month_name', $month['value'])
                                ->whereMonth('depenses.created_at', $month['value'])
                                ->where('depenses.currency_id', 1)
                                ->sum('depenses.amount');
                            $total_cdf = App\Models\Depense::query()
                                ->join('depense_sources', 'depense_sources.id', '=', 'depenses.depense_source_id')
                                ->where('depense_sources.month_name', $month['value'])
                                ->whereMonth('depenses.created_at', $month['value'])
                                ->where('depenses.currency_id', 2)
                                ->sum('depenses.amount');
                            if ($month['value'] == '03') {
                                $total_cdf_to_usd = $total_cdf / 27000;
                            } else {
                                $total_cdf_to_usd = $total_cdf / 2600;
                            }
                            $total_depense = $total_usd + $total_cdf_to_usd;
                        @endphp
                        <td class="text-right">{{ app_format_number($recettes) }}</td>
                        <td class="text-right">{{ app_format_number($total_depense) }}</td>
                        <td class="text-right">{{ app_format_number($recettes - $total_depense) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
