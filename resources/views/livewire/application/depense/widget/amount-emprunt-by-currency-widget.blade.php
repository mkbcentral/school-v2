<div>
    <div class="d-flex justify-content-center">
        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
    </div>
    <div class="card bg-primary" >
        <div class="card-header border-0">
            <h3 class="card-title text-uppercase">emprunt</h3>
        </div>
        <div class="card-body">
            @if ($listEmprunt->isEmpty())
            <div class="d-flex justify-content-center">
                <span colspan="6" class="text-center text-white">
                    <i class="fa fa-database  aria-hidden="true"></i>
                    Aucun emprunt pour le mois {{app_get_month_name($month)}} !
                </span>
            </div>
            @else
            @foreach ($listEmprunt as $emprunt)
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-white">
                    <i class="fas fa-hand-holding-usd text"></i>
                </p>
                <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                        <i class="ion ion-android-arrow-up text-success text-lg"></i> {{app_format_number($emprunt->total)}}
                        {{$emprunt->currency}}
                    </span>
                </p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
