<div class="card">
    <div class="card-header text-uppercase">
        <h3><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $typeCost->name }}</h3>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Filtrer par filière') }}" />
                <x-widget.list-classe-option-widget wire:model.live='classe_option_id' />
            </div>
            <div class="form-group ml-2">
                <x-form.label value="{{ __('Filtrer par classe') }}" />
                <x-widget.list-classe-select-widget option='{{$classe_option_id}}' wire:model.live='classe_id' />
            </div>
        </div>
        <div class="d-flex justify-content-center"><x-widget.loading-circular-md /></div>
        @if ($listStudent->isEmpty())
            <x-data-empty wire:loading.class='d-none' />
        @else
            <table class="table table-stripped table-sm" wire:loading.class='d-none'>
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th class="text-center">#</th>
                        <th>Noms élève</th>
                        @foreach ($months as $month)
                            <th class="text-center">{{ app_get_month_name($month) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listStudent as $index => $inscription)
                    @php
                        $status=$inscription->getByCurrentYearPaymentCheckerStatus(
                                        $selectedIndex, $inscription->student->id, $month,$defaultScolaryYerId);
                    @endphp
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{ $inscription->student->name }}</td>
                            @foreach ($months as $month)
                                <td class="text-center
                                    {{ $status =='OK'?' bg-success':'bg-danger'}}">
                                    {{ $status }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
