<x-pinting-layout>
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <u style="text-transform: uppercase">DEPOT BANQUES / {{ app_get_month_name($month) }} 2024</u>
            </div>
        </div>
    </div>
    <div>
        @if ($bankDeposits->isEmpty())
        @else
            <table>
                <thead>
                    <tr style="background: rgb(139, 139, 139);text-transform: uppercase">
                        <th>#</th>
                        <th class="text-right">Date</th>
                        <th>Numero</th>
                        <th style="text-align: right">Montant USD</th>
                        <th style="text-align: right">Montant CDF</th>
                        <th style="text-align: right">Autres détails</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($bankDeposits as $index => $bankDeposit)
                        <tr>
                            <td style="width: 30px;text-align: center">{{ $index + 1 }}</td>
                            <td style="width: 55px">{{ $bankDeposit->created_at->format('d/m/Y') }}</td>
                            <td style="width: 120px">
                                {{ $bankDeposit->number . '-' . app_get_month_name($bankDeposit->month_name) }}
                            </td>
                            @if ($bankDeposit->currency->currency == 'USD')
                                <td style="text-align: right">{{ app_format_number($bankDeposit->amount) }}</td>
                            @else
                                <td style="text-align: right">-</td>
                            @endif
                            @if ($bankDeposit->currency->currency == 'CDF')
                                <td style="text-align: right">{{ app_format_number($bankDeposit->amount) }}</td>
                            @else
                                <td style="text-align: right">-</td>
                            @endif
                            <td style="text-align: right">
                                @if ($bankDeposit->bankDepositMissing != null)
                                    <span class="text-danger">Manquant</span>
                                @else
                                    -
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    <tr style="text-transform: uppercase;font-weight: bold">
                        <td colspan="3" style="text-align: right;font-size: 22px;">Total</td>
                        <td style="text-align: right;font-size: 22px;">{{ app_format_number($total_cdf) }}</td>
                        <td style="text-align: right;font-size: 22px;">{{ app_format_number($total_usd) }}</td>
                        <td></td>
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
