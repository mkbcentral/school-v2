<div class="card">
    <div class="card-header text-uppercase"><h4 >
        <i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $typeCost->name }}</h4></div>
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Choisir la tranche') }}" />
                <x-widget.list-cost-general-select-widget
                type='{{$selectedIndex}}'
                 wire:model.live='cost_general_id' />
            </div>
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Filtrer par filière') }}" />
                <x-widget.list-classe-option-widget wire:model.live='classe_option_id' />
            </div>
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Filtrer par classe') }}" />
                <x-widget.list-classe-select-widget option='{{$classe_option_id}}' wire:model.live='classe_id' />
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2"><x-widget.loading-circular-md /></div>
        @if($listStudent->isEmpty())
            <x-data-empty/>
        @else
            <table class="table table-stripped table-sm ">
                <thead class="thead-light">
                <tr class="text-uppercase">
                    <th class="text-center">#</th>
                    <th>Noms élève</th>
                    @foreach($months as $month)
                        <th class="text-center">{{app_get_month_name($month)}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($listStudent as $index => $inscription)
                @php
                    $status=$inscription->getByCurrentYearBycostPaymentCheckerStatus($selectedIndex,$inscription->student->id,$month,$cost_general_id,$defaultScolaryYerId);
                @endphp
                    <tr>
                        <td class="text-center">{{$index+1}}</td>
                        <td>{{$inscription->student->name}}</td>
                        @foreach($months as   $month)
                            <td class="text-center
                            {{$status
                                 =='OK'?' bg-success':'bg-danger'}}
                            ">
                                {{$status}}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
