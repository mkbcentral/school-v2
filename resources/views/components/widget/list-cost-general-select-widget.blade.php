<x-select {{ $attributes }} >
    <option value="">Choisir...</option>
    @foreach ($listGeneralCost as $cost)
        <option value="{{ $cost->id }}">{{ $cost->name }}
        </option>
    @endforeach
</x-select>