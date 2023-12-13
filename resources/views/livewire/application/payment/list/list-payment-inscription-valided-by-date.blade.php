<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="showListInscriptionPaymentByDateModal" data-backdrop="static"
        data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="showListInscriptionPaymentByDateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showListInscriptionPaymentByDateModalLabel"><i class="fas fa-list"></i>
                        LISTE PAIEMENT INSCRIPTIONS JOURNALIERES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-form.label value="{{ __('Filtrer par date') }}" />
                                <x-form.input class="" type='date' placeholder="Lieu de naissance"
                                    wire:model.live='date_to_search' />
                            </div>
                        </div>
                    </div>
                    @php
                        $total = 0;
                    @endphp
                    <div>
                        <div wire:loading wire:target="updatedDateToSearch">
                            Processing Payment...
                        </div>
                        @if ($inscriptions->isEmpty())
                            <span class="text-success text-center p-4">
                                <h4><i class="fa fa-database" aria-hidden="true"></i>
                                    Aucune donnée trouvée !
                                </h4>
                            </span>
                        @else
                            <table class="table table-stripped table-sm">
                                <thead class="thead-light">
                                    <tr class="text-uppercase">
                                        <th class="text-center">#</th>
                                        <th>Date paiment</th>
                                        <th>Noms élève</th>
                                        <th class="text-center">Genre</th>
                                        <th class="text-center">Montant</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscriptions as $index => $inscription)
                                        <tr>
                                            <td class="text-center d-flex align-items-center">{{ $index + 1 }}
                                                <span wire:loading
                                                wire:target="edit({{ $inscription }},{{ $inscription->id }})"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span></td>
                                            <td>
                                                @if ($isEditing==true && $idSelected==$inscription->id)
                                                <x-form.input class="" type='date' placeholder="Date de paiement"
                                                wire:model='created_at' wire:keydown.enter='update({{$inscription->id}})' />
                                                @else
                                                {{$inscription->created_at->format('d/m/Y')}}
                                                @endif
                                            </td>
                                            <td>{{ $inscription->student->name . '/' . $inscription->classe->name . ' ' . $inscription->classe->classeOption->name }}
                                            </td>
                                            <td class="text-center">{{ $inscription->student->gender }}</td>
                                            <td class="text-center">
                                                {{ app_format_number($inscription->amount) }} {{ $defaultCureencyName }}
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge badge-{{ $inscription->getPaiementStatusColor($inscription) }}">{{ $inscription->getPaiementStatus($inscription) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('receipt.inscription', [$inscription, 'USD']) }}"
                                                    target="_blank" class="btn-sm text-warning"><i class="fas fa-print"></i></a>
                                                <x-form.button
                                                    wire:click='edit({{ $inscription }},{{ $inscription->id }})'
                                                    class="btn-sm text-primary" type="button">
                                                    <span wire:loading
                                                        wire:target="edit({{ $inscription }},{{ $inscription->id }})"
                                                        class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </x-form.button>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $inscription->amount;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('print.rapport.inscription.payment.by.day', [$date_to_search, $defaultScolaryYerId, $defaultCureencyName]) }}"
                        target="_blank"><i class="fas fa-print"></i> Imprimer</a>
                    <h3 class="text-uppercase text-primary">Total: {{ app_format_number($total) }}
                        {{ $defaultCureencyName }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
