<div>
    @php
        $total = 0;
    @endphp
    <x-navigation.bread-crumb icon='fas fa-chart-pie' label="Situation Frais par section">
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label="Situation Frais de l'Etat" />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="card">
            <div class="d-flex">
                <div class="form-group mr-2">
                    <x-form.label value="{{ __('Choisir un le mois') }}" />
                    <x-widget.list-month wire:model.live='month' />
                </div>
                <div class="form-group">
                    <label for="my-select">Option</label>
                    <select id="my-select" class="form-control" wire:model.live='optionId'>
                        <option>Choisir</option>
                        @foreach ($classOptions as $classOption)
                            <option value="{{ $classOption->id }}">{{ $classOption->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <x-widget.loading-circular-md />
            </div>
            <div class="card-body mt-4">
                <div class="row">
                    @foreach ($sections as $section)
                        <div class="col-md-4 " wire:click='getSection({{ $section }})' data-toggle="modal"
                            data-target="#exampleModal">
                            <div class="bg-primary p-2 rounded">
                                <h3>{{ $section->name }}</h3>
                                <h5>USD {{ app_format_number($section->getCostBySectionAmount($optionId, $month)) }}
                                </h5>
                            </div>

                        </div>
                        @php
                            $total += $section->getCostBySectionAmount($optionId, $month);
                        @endphp
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <h3>Total: {{ app_format_number($total) }}</h3>
                </div>
            </div>
        </div>
    </x-content.main-content-page>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h class="modal-title fs-5" id="exampleModalLabel">DETAIL PAYMENT</h>
                </div>
                <div class="modal-body">
                    @if ($sectionSelected != null)
                        <h6>Section: {{ $sectionSelected->name }}</h6>
                        @if ($month != '')
                            <h6>Mois: {{ $month }}</h6>
                        @endif
                        <table class="table table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Option</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classOptions as $index => $classOption)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $classOption->name }}</td>
                                        <td>{{ $classOption->getCostByOptionAmount($sectionSelected->id) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

                </div>
            </div>
        </div>
    </div>
</div>
