<div>
    <x-select wire:model.live='currency_id' class="text-danger text-bold" id="currency_id">
        <option class="bg-primary" value="{{$defaulCurrency?->currency}}">{{$defaulCurrency?->currency}}</option>
        @foreach ($listCurrencies as $currency)
            <option  value="{{$currency->currency}}" wire:key='{{$currency->currency}}'>{{$currency->currency}}</option>
        @endforeach
    </x-select>
</div>
