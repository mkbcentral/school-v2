<div>
    <x-navigation.bread-crumb icon='fa fa-folder' label='SITUATION DES EXEMPTES'>
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label='Rapport global' link='rapport.payments' isLinked=true />
        <x-navigation.bread-crumb-item label='Exempté' />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="d-flex">
            <div class="form-group mr-2">
                <x-form.label value="{{ __('Choisir un le mois') }}" />
                <x-widget.list-month wire:model.live='month' />
            </div>
            <div class="form-group ">
                <x-form.label value="{{ __('Choisor frais') }}" />
                <x-select wire:model.live='idCost'>
                    <option value="">Choisir...</option>
                    @foreach ($costs as $cost)
                        <option value="{{ $cost->id }}">
                            {{ $cost->name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <x-widget.loading-circular-md />
        </div>
        @if ($payments->isEmpty())
            <x-data-empty />
        @else
            <table class="table table-stripped table-sm mt-2">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Noms élève</th>
                        <th class="text-center">sms status</th>
                        <th class="text-right">Type frais</th>
                        <th class="text-right">Montant</th>
                        <th class="text-right">Mois</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $payment->student->name . '/' . $payment?->getStudentClasseName($payment) }}
                            </td>
                            <td class="text-right">{{ $payment->cost->name }}</td>
                            <td class="text-right">{{ app_format_number($payment->amount) }}
                                {{ $payment->cost->currency->currency }}</td>
                            <td class="text-center">
                                {{ app_get_month_name($payment->month_name) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-content.main-content-page>
</div>
