<x-select {{ $attributes }}>
    <option value="">Choisir...</option>
    @foreach ($lisClasseOption as $option)
        <option value="{{ $option->id }}">
            {{ $option->name }}</option>
    @endforeach
</x-select>