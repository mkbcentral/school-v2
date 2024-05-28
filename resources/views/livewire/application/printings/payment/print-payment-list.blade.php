<x-pinting-layout>
    @php
        $total = 0;
    @endphp
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <u style="text-transform: uppercase">SITUATION DES PAYMENT {{ $typeCost->name }}</u>
            </div>
            <span style="margin-top: 8px;margin-bottom: 8px ">
                <b>Frais</b>: {{ $cost->name }}<br>
                <b>Classe</b>: {{ $classe->name . '/' . $classe->classeOption->name }}<br>
            </span>
        </div>
        @if ($payments->isEmpty())
        @else
            <table class="table table-stripped table-sm mt-2">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Date</th>
                        <th>Noms élève</th>
                        <th style="text-align: right">Type frais</th>
                        <th style="text-align: right">Montant</th>
                        <th style="text-align: right">Mois de paie</th>

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
                            <td style="text-align: right">{{ $payment->cost->name }}</td>
                            <td style="text-align: right">{{ app_format_number($payment->amount) }}
                                {{ $payment->cost->currency->currency }}</td>
                            <td style="text-align: right">
                                {{ app_get_month_name($payment->month_name) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-pinting-layout>
