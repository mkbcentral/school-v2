<x-pinting-layout>
    @php
        $total=0;;
    @endphp
    <div>
        @if ($inscriptions->isEmpty())

        @else
            <table>
                <thead>
                <tr *>
                    <th>#</th>
                    <th>Noms élève</th>
                    <th>Genre</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($inscriptions as $index => $inscription)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $inscription->student->name . '/' . $inscription->classe->name . ' ' . $inscription->classe->classeOption->name }}
                        </td>

                        <td>{{ $inscription->student->gender }}
                        </td>
                        <td>
                            {{ app_format_number($inscription->amount) }} {{$defaultCureencyName}}
                        </td>
                        <td>
                            <span class="badge badge-{{$inscription->getPaiementStatusColor($inscription)}}">{{$inscription->getPaiementStatus($inscription)}}</span>
                        </td>
                        <td>
                            <x-form.button wire:click='printBill({{ $inscription }})'
                                      class="btn-sm text-info" type="button">
                                <i class="fas fa-print" aria-hidden="true"></i>
                            </x-form.button>

                        </td>
                    </tr>
                    @php
                        $total+=$inscription->amount;
                    @endphp
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-pinting-layout>
