<div>
    <div class="row">
        @foreach ($listOldCostType as $cost)
            <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="{{ $cost->id }}" wire:model.live="typeCostSelected"
                            value="{{ $cost->id }}">
                        <label for="{{ $cost->id }}" class="">
                            {{ $cost->name }}
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Frais</th>
                @foreach ($months as $month)
                    <th>{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($listTypeCost as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    @foreach ($months as $m)
                        <td class="{{ $type->getPaymentCheckerBgtatus($type->id, $student->inscription->id, $m) }}">
                            {{ $type->getPaymentCheckerStatus($type->id, $student->inscription->id, $m) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
