<x-select {{ $attributes }}>
    <option value="">Choisir...</option>
    @foreach ($listTypeCost as $type)
        <option value="{{ $type->id }}">{{ $type->name }}
        </option>
    @endforeach
</x-select>