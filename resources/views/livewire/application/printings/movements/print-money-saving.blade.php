<x-pinting-layout>
    @php
        $total = 0;
    @endphp
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <u style="text-transform: uppercase">EPARGNE ANNEE SCOLAIRE 2023-2024 </u>
            </div>
        </div>
    </div>
    <div>
        @if ($moneySavings->isEmpty())
        @else
            <table>
                <thead>
                    <tr style="background: rgb(139, 139, 139);text-transform: uppercase">
                        <th>#</th>
                        <th>Numero</th>
                        <th style="text-align: right">Montant USD</th>
                        <th style="text-align: right">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moneySavings as $index => $moneySaving)
                        <tr>
                            <td style="width: 30px;text-align: center">{{ $index + 1 }}</td>
                            <td style="width: 100px">
                                {{ $moneySaving->number . '-' . app_get_month_name($moneySaving->month_name) }}</td>
                            <td style="text-align: right">{{ $moneySaving->amount }} USD</td>
                            <td style="text-align: right">{{ $moneySaving->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @php
                            $total += $moneySaving->amount;
                        @endphp
                    @endforeach
                    <tr style="text-transform: uppercase;font-weight: bold">
                        <td colspan="2" style="text-align: right;font-size: 22px;">Total</td>
                        <td style="text-align: right;font-size: 22px;">{{ app_format_number($total) }} USD</td>
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
