<x-pinting-layout>
    @php
        $total = 0;
    @endphp
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <span>SITUATION DE PAIMENT DES INSCRIPTIONS JOURNALIER</span>
            </div>
            <span style="margin-top: 8px;margin-bottom: 8px ">Inscription du:
                {{ (new DateTime($date))->format('d/m/Y') }}</span>
        </div>
    </div>
    <table sty>
        <thead style="background: rgb(67, 67, 67);color: rgb(222, 221, 221)">
            <tr>
                <th style="text-align: center">N°</th>
                <th style="text-align: left">DATE</th>
                <th style="text-align: left">NOMS ELEVE</th>
                <th style="text-align: right">MONTANT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inscriptionList as $index => $payment)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td style="text-align: left">{{ $payment->created_at->format('d/m/Y') }}</td>
                    <td style="text-align: left">{{ $payment->student->name }}</td>
                    <td style="text-align: right">{{ $payment->amount }} {{ $currency }}</td>
                </tr>
                @php
                    $total += $payment->amount;
                @endphp
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right;font-size: 18px;margin-top: 10px;">
        <span style="font-weight: bold">Total: </span><span>{{ number_format($total, 1, ',', ' ') }}
            {{ $currency }}</span>
        <div style="margin-top: 8px">
            <span style="">Fiat à Lubumbashi,Le {{ date('d/m/Y') }}</span>
        </div>
    </div>
    </div>
    <div style="font-size: 18px;margin-top: 20px; padding: 8px;color: rgb(32, 32, 32)">
        <span style="font-weight: bold;margin-right: 400px">FINANCE</span>
        <span style="font-weight: bold">COORDONATEUR</span>
    </div>
</x-pinting-layout>
