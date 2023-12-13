<x-pinting-layout>
    @php
        $total_usd = 0;
        $total_cdf = 0;
    @endphp
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <u>SITUATION DES EMPRUNT MENSUELS</u>
            </div>
            <span style="margin-top: 8px;margin-bottom: 8px "><b>Mois</b>: {{ app_get_month_name($month) }}</span>
        </div>
    </div>
    <div>
        @if ($listEmprunt->isEmpty())
        @else
            <table>
                <thead>
                    <tr style="background: rgb(139, 139, 139);text-transform: uppercase">
                        <th>#</th>
                        <th>Date</th>
                        <th style="text-align: left">Motif emprunt</th>
                        <th style="text-align: right">MT USD</th>
                        <th style="text-align: right">MT CDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listEmprunt as $index => $emprunt)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            <td>{{ $emprunt->created_at->format('d/m/Y') }}</td>
                            <td>{{ $emprunt->description }}</td>
                            <td style="text-align: right">
                                {{$emprunt->currency_name=='USD'?app_format_number($emprunt->amount).' $':'-'}}
                            </td>
                            <td style="text-align: right">
                                {{$emprunt->currency_name=='CDF'?app_format_number($emprunt->amount).' Fc':'-'}}
                            </td>
                        </tr>
                        @php
                            if ($emprunt->currency_name == 'USD') {
                                $total_usd += $emprunt->amount;
                            } else {
                                $total_cdf += $emprunt->amount;
                            }
                            
                        @endphp
                    @endforeach
                    <tr style="background: rgb(139, 139, 139);">
                        <th colspan="3" style="font-size: 25px;text-transform: uppercase">Total</th>
                        <td style="text-align: right;font-size: 18px;font-weight: bold">
                            {{ app_format_number($total_usd) }} $</td>
                        <td style="text-align: right;font-size: 18px;font-weight: bold">
                            {{ app_format_number($total_cdf) }} Fc</td>
                    </tr>
                </tbody>
            </table>
        @endif
        <div style="text-align: right;font-size: 18px;margin-top: 10px;">
            <div style="margin-top: 8px">
                <span style="">Fiat à Lubumbashi,Le {{ date('d/m/Y') }}</span>
            </div>
            <div>
                <span style="font-weight: bold;text-align: right;mt-10">FINANCE</span>
            </div>
        </div>
    </div>

    </div>

</x-pinting-layout>
