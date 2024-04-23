<x-pinting-layout>
    @php
        $total = 0;
    @endphp
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <span>LISTE DES EFFECTIFS {{ $isOld == false ? 'NOUVEAUX INSCRITS' : 'REINSCRITS' }} PAR CLASSE</span>
            </div>
        </div>
    </div>
    @foreach ($classeOptions as $index => $classeOption)
        @php
            $total = 0;
        @endphp
        <h4 style="text-transform: uppercase">{{ $index + 1 }}.{{ $classeOption->name }}</h4>
        <table sty>
            <thead style="background: rgb(67, 67, 67);color: rgb(222, 221, 221)">
                <tr>
                    <th style="text-align: center">N°</th>
                    <th style="text-align: left">CLASSE</th>
                    <th style="text-align: right">EFFECTIF</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classeOption->classes as $index => $classe)
                    <tr style="text-transform: uppercase">
                        <td style="text-align: center">{{ $index + 1 }}</td>

                        <td style="text-align: left">{{ $classe->name . '/' . $classe->classeOption->name }}</td>
                        <td style="text-align: right">{{ $classe->getNumberInscriptionByType($classe->id, $isOld) }}
                        </td>
                    </tr>
                    @php
                        $total += $classe->getNumberInscriptionByType($classe->id, $isOld);
                    @endphp
                @endforeach
                <tr style="font-size: 30px;background: grey">
                    <td colspan="2" style="text-align: right;text-transform: uppercase">Total</td>
                    <td style="text-align: right">{{ $total }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach

</x-pinting-layout>
