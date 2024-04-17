<div>
    <div class="d-flex justify-content-center">
        <x-widget.loading-circular-md />
    </div>
    <div class="card p-2" wire:loading.class='d-none'>
        <div class="card-header">
            SITUATION DE REGULARISATION
            <h1>{{ $inscription->id . '/' . $inscription->classe->name }}</h1>
        </div>
        <div class="card-body">
            @if ($payments->isEmpty())
                <x-data-empty />
            @else
                <table class="table table-striped">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Date paiement</th>
                            <th>Type frais</th>
                            <th>Mois</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                <td>{{ $payment->cost->name }}</td>
                                <td>{{ $payment->month_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
