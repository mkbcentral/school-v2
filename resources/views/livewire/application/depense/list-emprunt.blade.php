<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>LISTE DES EMPRUNTS</h5>
                        <a href="{{ route('emprunt.month', [$month]) }}" target="_blank" class="btn btn-primary"><i
                                class="fa fa-print" aria-hidden="true"></i> Imprimer</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between ">
                        @if ($totalByCurrency != null)
                        <h4 class="bg-secondary p-2 rounded">Total:
                            @foreach ($totalByCurrency as $total)
                            <span class="text-info">{{ $total->currency }}:
                            </span><span>{{ app_format_number($total->total) }}</span>
                            @endforeach
                        </h4>
                        @endif

                        <select class="form-control w-25" wire:model.live='month' id="">
                            @foreach ($months as $m)
                            <option value="{{ $m }}">{{ app_get_month_name($m) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span wire:loading class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-uppercase">
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>MT USD</th>
                                <th>MT CDF</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($listEmprunt->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center text-success">
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                    Aucune donnée trouvée !
                                </td>
                            </tr>
                            @else
                            @foreach ($listEmprunt as $index => $emprunt)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $emprunt->created_at->format('d/m/Y') }}</td>
                                <td>{{ $emprunt->description }}</td>
                                <td>
                                    {{ $emprunt->currency_name == 'USD' ? $emprunt->amount . ' $' : '-' }}
                                </td>
                                <td>
                                    {{ $emprunt->currency_name == 'CDF' ? $emprunt->amount . ' Fc' : '-' }}
                                </td>
                                <td class="text-center">
                                    <x-form.button wire:click='edit({{ $emprunt }})' class="btn-sm text-primary"
                                        type="button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </x-form.button>
                                    <x-form.button wire:click='showDeleteDialog({{ $emprunt }})'
                                        class="btn-sm text-danger" type="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </x-form.button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @livewire('application.depense.form.form-emprunt')
        </div>
    </div>
</div>
@push('js')
<script type="module">
    //Confirmation dialog for delete role
        window.addEventListener('delete-emprunt-dialog', event => {
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
                    Livewire.dispatch('deleteEmpruntListner');
                }
            })
        })
        window.addEventListener('emprunt-deleted', event => {
            Swal.fire(
                'Oprétion !',
                event.detail[0].message,
                'success'
            );
        });
</script>
@endpush
</div>