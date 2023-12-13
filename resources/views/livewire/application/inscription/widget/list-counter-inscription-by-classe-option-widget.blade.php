<div>
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title text-uppercase"><i class="fas fa-chart-area"></i> Evolution journalière par filière</h3>
        </div>
        <div class="card-body p-0">
            <div class="d-flex justify-content-center pb-4">
                <x-widget.loading-circular-sm />
            </div>
            <div class="table-responsive" wire:loading.class='d-none'>
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>FILLIERES</th>
                            <th class="text-right">NOMBRE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($inscriptionList->isEmpty())
                            <tr>
                                <td></td>
                                <td> Aucune donnée trouvée</td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($inscriptionList as $inscription)
                                <tr class="{{ $inscription->number < 2 ? 'text-danger' : 'text-primary' }}">
                                    <td class="text-uppercase">{{ $inscription->name }}</a></td>
                                    <td class="text-right">
                                        <i
                                            class="fas {{ $inscription->number < 2 ? 'fa-arrow-down' : 'fa-arrow-up' }} "></i>
                                        {{ $inscription->number }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
