<x-select {{ $attributes }}>
    <option value="">Choisir...</option>
    @if (!$classeList->isEmpty())
    @foreach ($classeList as $classe)
    <option value="{{ $classe->id }}">
        {{ $classe->name . '/' . $classe->classeOption->name }}</option>
@endforeach
    @endif
</x-select>