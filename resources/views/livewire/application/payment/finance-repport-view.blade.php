<div>
    @php
        $totam = 0;
        $total_usd = 0;
        $total_cdf = 0;
        $total_cdf_to_usd = 0;
        $total_depense = 0;
    @endphp
    <div class="container">
        <h2 class="text-uppercase text-center text-primary"><i class="fas fa-chart-line"></i>
            Rapport fincier année
            scolare
            2023-2024</h2>
        <table class="table table-bordered text-bold table-sm active">
            <thead class="table-primary">
                <tr>
                    <td>MOIS</td>
                    <td class="text-right">RECETTES</td>
                    <td class="text-right">DEPENSES</td>
                    <td class="text-right">SOLDE</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($months as $month)
                    <tr>
                        <td class="text-uppercase">{{ $month['name'] }}</td>
                        <td class="text-right">
                            @php
                                $currency = 1;
                                $total = App\Models\Payment::query()
                                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                                    //->join('type_other_costs', 'type_other_costs.id', '=', 'cost_generals.type_other_cost_id')
                                    ->whereMonth('payments.created_at', $month['value'])
                                    ->where('cost_generals.type_other_cost_id', 11)
                                    ->where('payments.is_paid', true)
                                    ->sum('cost_generals.amount');
                            @endphp
                            {{ app_format_number($total) }}
                        </td>
                        <td class="text-right">
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
                            {{ app_format_number($total_depense) }}
                        </td>
                        <td class="text-right">
                            {{ app_format_number($total - $total_depense) }}
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
</div>
