<div>
    <x-select wire:model.live='scolary_year_id' class="text-primary text-bold" id="scolary_year_id">
        <option class="bg-primary" value="{{$defaulScolaryYear->id}}">{{$defaulScolaryYear->name}}</option>
        @foreach ($listScolaryYear as $scolaryYear)
            <option  value="{{$scolaryYear->id}}" wire:key='{{$scolaryYear->id}}'>{{$scolaryYear->name}}</option>
        @endforeach
    </x-select>
</div>
