<x-select {{ $attributes }} >
    <option value="">Choisir...</option>
    @foreach ($months as $month)
        <option value="{{ $month }}">
            {{ app_get_month_name($month) }}</option>
    @endforeach
</x-select>