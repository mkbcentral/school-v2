<div>
    @php
        $total_usd = 0;
        $total_cdf = 0;
    @endphp
    @livewire('application.depense.list-retour-caisse')
    <div class="d-flex justify-content-between ">
        <x-form.button type="button" wire:click='new' class="btn-danger" data-toggle="modal"
            data-target="#formDepenseModal">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Nouvelle dépense
        </x-form.button>
        <a href="{{ route('depense.month', [$month, $currency, $source, $category, $type_depense_id]) }}" target="_blank"
            class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</a>
    </div>
    <div class="d-flex justify-content-between mt-4 align-items-center">
        <div class="form-group d-flex align-items-center">
            <h4 class="mr-1">Filtrer/Date</h4>
            <x-form.input class="" type='date' placeholder="Date depense" wire:model.live='date' />
        </div>
        <div class="d-flex align-items-center">
            <h4 class="mr-1">Filtrer/Mois</h4>
            <select class="form-control" wire:model.live='month' id="">
                @foreach ($months as $m)
                    <option value="{{ $m }}">{{ app_get_month_name($m) }}
                    </option>
                @endforeach
            </select>

        </div>

    </div>
    <div class="d-flex justify-content-center">
        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="form-group  mr-2">
                <x-form.label value="{{ __('Source') }}" />
                <select wire:model.live='source' id="" class="form-control">
                    <option value="">Tous</option>
                    <option value="">Source</option>
                    @foreach ($listDepenseSource as $source)
                        <option value="{{ $source->name }}">{{ $source->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  mr-2 w-25">
                <x-form.label value="{{ __('Catégorie') }}" />
                <select wire:model.live='category' id="" class="form-control">
                    <option value="">Tous</option>
                    <option value="">Catégorie...</option>
                    @foreach ($listCategoryDepense as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group ">
                <x-form.label value="{{ __('Dévise') }}" />
                <select wire:model.live='currency' id="" class="form-control">
                    <option value="">Tous</option>
                    @foreach ($currencyList as $currency)
                        <option value="{{ $currency->currency }}">{{ $currency->currency }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  ml-2">
                <x-form.label value="{{ __('Type') }}" />
                <select wire:model.live='type_depense_id' id="" class="form-control">
                    @foreach ($listTypeDepense as $typeDepense)
                        <option value="{{ $typeDepense->id }}">{{ $typeDepense->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h4 class="text-success">({{ $listDepense->count() }} {{ Str::plural('Depense', $listDepense->count()) }})
        </h4>
    </div>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Descriprion</th>
                <th>Source</th>
                <th class="text-right">MT USD</th>
                <th class="text-right">MT CDF</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($listDepense->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-success">
                        <i class="fa fa-database" aria-hidden="true"></i>
                        Aucune donnée trouvée !
                    </td>
                </tr>
            @else
                @foreach ($listDepense as $index => $depense)
                    <tr data-toggle="tooltip" data-placement="top" title="{{ $depense->name }}">
                        <td scope="row">{{ $index + 1 }}</td>
                        <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($depense->name, 20) }}</td>
                        <td>{{ $depense->source }}</td>
                        <td class="text-right">
                            @if ($depense->currency_name == 'USD')
                                {{ app_format_number($depense->amount) }} $
                                @php
                                    $total_usd += $depense->amount;
                                @endphp
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($depense->currency_name == 'CDF')
                                {{ app_format_number($depense->amount) }} FC
                                @php
                                    $total_cdf += $depense->amount;
                                @endphp
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            <x-form.button wire:click='edit({{ $depense }},{{ $depense->id }})'
                                class="text-primary" data-toggle="modal" data-target="#formDepenseModal" type="button">
                                <span wire:loading wire:target="edit({{ $depense }},{{ $depense->id }})"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </x-form.button>
                            <x-form.button wire:click='show({{ $depense }},{{ $depense->id }})'
                                class="text-primary" data-toggle="modal" data-target="#listRetourCaisseModal"
                                type="button">
                                <span wire:loading wire:target="edit({{ $depense }},{{ $depense->id }})"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </x-form.button>
                            <x-form.button wire:click='showDeleteDialog({{ $depense->id }})' class="text-danger"
                                type="button">
                                <span wire:loading wire:target="delete({{ $depense->id }})"
                                    class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </x-form.button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-end bg-navy p-1 rounded-lg pr-2">
        <h3 wire:loading.class="d-none"><i class="fas fa-coins ml-2"></i><span>Total</span>
            <span class="money_format">CDF: {{ app_format_number($total_cdf, 1) }}</span> |
            <span class="money_format">USD: {{ app_format_number($total_usd, 1) }}</span>
        </h3>
    </div>
    @push('js')
        <script type="module">
            //Confirmation dialog for delete role
            window.addEventListener('delete-depense-dialog', event => {
                Swal.fire({
                    title: 'Voulez-vous vraimant ',
                    text: "supprimer ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteDepenseListner');
                    }
                })
            })
            window.addEventListener('depense-deleted', event => {
                Swal.fire(
                    'Oprétion !',
                    event.detail[0].message,
                    'success'
                );
            });
        </script>
    @endpush
</div>
