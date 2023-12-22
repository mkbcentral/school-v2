<div>
    <div class="d-flex justify-content-center align-items-center">
        <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    </div>
    <div class="row">
        @if($listReceipt->isEmpty())
        <span class="text-success text-center p-4">
            <h4><i class="fa fa-database" aria-hidden="true"></i><br>
                Aucune opération pour aujourd'hui !
            </h4>
        </span>
        @else
        @foreach($listReceipt as $receipt)
        <div class="col-md-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{app_get_currency_type_cost_name($receipt->name)}}
                        {{app_format_number($receipt->amount)}}</h3>
                    <p>{{$receipt->name}} </p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">({{$receipt->number}})
                    {{Str::plural('payment',$receipt->number)}}</a>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</div>