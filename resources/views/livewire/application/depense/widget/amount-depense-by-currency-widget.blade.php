<div>
    <div class="d-flex justify-content-center">
        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
    </div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Depense mensuelle</h3>
        </div>
        <div class="card-body">
            @if ($listDepebse->isEmpty())
            <div class="d-flex justify-content-center">
                <span colspan="6" class="text-center text-success">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    Aucune dépense pour le mois {{app_get_month_name($month)}} !
                </span>
            </div>
            @else
            @foreach ($listDepebse as $depense)
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-success">
                    <i class="fas fa-chart-line "></i>
                </p>
                <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                        <i class="ion ion-android-arrow-up text-success text-lg"></i>
                        {{app_format_number($depense->total)}}
                        {{$depense->currency_name}}
                    </span>
                </p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
