<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-text"> <i class="fas fa-calendar-alt"></i> Recettes mensulles</h4>
            <div class="form-group d-flex align-items-center">
                <x-form.label value="{{ __('Mois') }}" />
                <x-select wire:model.live='month' class="ml-2">
                    <option value="">Choisir...</option>
                    @foreach ($months as $m)
                        <option value="{{$m}}">
                            {{ app_get_month_name($m) }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center align-items-center">
            <span wire:loading
                class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </div>
        <div class="row mt-2">
           @foreach($listReceipt as $receipt)
                <div class="col-sm-6 col-12">
                    <div class="info-box bg-indigo">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{$receipt->name}}</span>
                            <span class="info-box-number">
                                {{app_get_currency_type_cost_name($receipt->name)}}
                                {{app_format_number($receipt->amount)}}
                               </span>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{app_get_percentage($receipt->amount)}}%"></div>
                            </div>
                            <span class="progress-description">
                                {{app_get_percentage($receipt->amount)>=100?'+100':app_get_percentage($receipt->amount)}} % de Paiment par mois
                            </span>
                        </div>
                    </div>
                </div>
           @endforeach
        </div>
    </div>
</div>
