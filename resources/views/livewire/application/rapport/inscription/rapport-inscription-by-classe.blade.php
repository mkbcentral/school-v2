<div>
    <x-navigation.bread-crumb icon='fas fa-chart-pie' label='Rapport financier par filière'>
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label='Rapport financier' />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="row mt-2">
            <div class="card col-md-2">
                <div class="card-header">
                    <h4 class="text-uppercase"><i class="fas fa-list-ul"></i> Filières</h4>
                </div>
                <div class="card-body">
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        @foreach ($listClasseOption as $option)
                            <button wire:click="changeIndex({{ $option }})" type="button"
                                class="btn {{ $selectedIndex == $option->id ? 'btn-primary' : 'btn-link text-secondary' }}   text-left">
                                <i class="fas fa-arrow-alt-circle-right"></i> {{ $option->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card col-md-8">
                @php $total=0 @endphp
                <div class="card-header text-uppercase bg-primary">
                    <h4><i class="fas fa-chart-line    "></i> Tableau de visualisation</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mr-2">
                        <x-form.label value="{{ __('Choisir un le mois') }}" />
                        <x-select wire:model.live='month'>
                            <option value="">Choisir...</option>
                            @foreach ($months as $m)
                                <option value="{{ $m }}">
                                    {{ app_get_month_name($m) }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="d-flex  justify-content-center">
                        <div wire:loading class="spinner-grow text-primary text-center" role="status">
                            <span hidden>Loading...</span>
                        </div>
                    </div>
                    @if ($classeList->isEmpty())
                        <x-data-empty />
                    @else
                        <table class="table table-bordered border-primary mt-2">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">CLASSE</th>
                                    <th class="text-center" scope="col">EFFECTIF </th>
                                    <th class="text-center" scope="col">NRE PAYE</th>
                                    <th class="text-center" scope="col">MONTANT </th>
                                    <th class="text-right" scope="col">RCTT. ATTENDUE </th>
                                    <th class="text-right" scope="col">RCCT. REALISEE</th>
                                    <th class="text-right" scope="col"> MANQ. A GANGNER</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($classeList as $index => $classe)
                                    @php
                                        $number = $classe->inscriptions->where('scolary_year_id', $defaultScolaryYerId)->count();
                                        $amount = $classe->getPaymentByClasseForCurrentYear($classe->id, $selectedOtherCostIndex, $defaultScolaryYerId);
                                        $currency = $classe->getPaymentCurrencyByClasseForCurrentYear($classe->id, $selectedOtherCostIndex, $defaultScolaryYerId);
                                        $amoutMonth = $classe->getAmountPaymentByClasseForCurrentYearByMonth($classe->id, $selectedOtherCostIndex, $month);
                                        $number_payment = $classe->getCountPaymentByClasseForCurrentYearByMonth($classe->id, $selectedOtherCostIndex, $month);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="text-center">{{ $index + 1 }}</th>
                                        <td>{{ $classe->name . '/' . $classe->classeOption->name }}</td>
                                        <td class="text-center">
                                            {{ $number }}
                                        </td>
                                        <td class="text-center">
                                            {{ $number_payment }}
                                        </td>
                                        <td class="text-center">
                                            {{ $amount }}{{ $currency }}
                                        </td>
                                        <td class="text-right">
                                            {{ app_format_number($amount * $number) }}{{ $currency }}
                                        </td>
                                        <td class="text-right">
                                            {{ app_format_number($amount * $number_payment) }} {{ $currency }}
                                        </td>
                                        <td class="text-right">
                                            {{ app_format_number($amount * $number - $amoutMonth) }}{{ $currency }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-list-ul"></i>Frais</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                            @foreach ($listTYpeCost as $cost)
                                <button wire:click="changeIndexTypeCost({{ $cost }})" type="button"
                                    class="btn {{ $selectedOtherCostIndex == $cost->id ? 'btn-danger' : 'btn-link text-secondary' }}   text-left">
                                    <i class="fas fa-arrow-alt-circle-left"></i> {{ $cost->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-content.main-content-page>
</div>
