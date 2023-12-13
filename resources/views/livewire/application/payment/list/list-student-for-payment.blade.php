<div>
    @livewire('application.payment.form.add-new-payment')
    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase text-bold">LISTE DES ELEVES</h4>
        </div>
        <div class="card-body">
            <x-form.search-input/>
            @if ($listInscription->isEmpty())
            <span class="text-success text-center p-4">
                <h4><i class="fa fa-database" aria-hidden="true"></i>
                    Aucune donnée trouvée !
                </h4>
            </span>
        @else
        <table class="table table-stripped table-sm">
            <thead class="bg-primary">
            <tr class="text-uppercase">
                <th>#</th>
                <th>Noms élève</th>
                <th class="text-center">Genre</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
           @foreach ($listInscription as $index => $inscription)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{ $inscription?->student->name }}{{$inscription->getStudentClasseName($inscription)}}
                </td>
                <td class="text-center">{{ $inscription->student->gender }}
                </td>
                <td class="text-center">
                    <x-form.button wire:click='show({{ $inscription }})'
                              class="btn-sm btn-info" type="button" data-toggle="modal"
                              data-target="#newPayment">
                        Payer
                    </x-form.button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $listInscription->links('vendor.livewire.bootstrap') }}
        @endif
        </div>
    </div>
</div>
