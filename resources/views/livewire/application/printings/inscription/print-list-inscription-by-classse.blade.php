<x-pinting-layout>
    <div>
        <div style="border: 1px solid black;padding: 6px">
            <div style="text-align: center;padding: 15px;font-size: 22px">
                <span>LISTE DES ELEVES</span>
            </div>
            <span style="margin-top: 8px;margin-bottom: 8px "><b>Classe:</b> {{ $classe->name.'/'.$classe->classeOption->name }}</span>
        </div>
    </div>
    <table sty>
        <thead style="background: rgb(67, 67, 67);color: rgb(222, 221, 221)">
            <tr>
                <th class="text-center">#</th>
                <th>Noms élève</th>
                <th class="text-center">Genre</th>
                <th class="text-center">Age</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inscriptions as $index => $inscription)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $inscription->student->name . '/' . $inscription->classe->name . ' ' . $inscription->classe->classeOption->name }}
                    </td>
                    <td style="text-align: center">{{ $inscription->student->gender }}</td>
                    <td style="text-align: center">
                        {{ $inscription->student->getAge($inscription->student->date_of_birth) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right;font-size: 18px;margin-top: 10px;">
        <div style="margin-top: 8px">
            <span style="">Fiat à Lubumbashi,Le {{ date('d/m/Y') }}</span>
        </div>
    </div>
    </div>
    <div style="font-size: 18px; padding: 8px;color: rgb(32, 32, 32);text-align: right">
        <span style="font-weight: bold;">SECRETARIAT</span>
    </div>
</x-pinting-layout>
