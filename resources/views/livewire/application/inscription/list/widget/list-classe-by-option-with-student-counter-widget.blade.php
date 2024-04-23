<div>
    @php
        $total = 0;
    @endphp
    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-users" aria-hidden="true"></i> EFFECTIF PAR CLASSE</h4>
        </div>
        <div class="card-body">
            <div class="form-group mr-2 W-25">
                <x-form.label value="{{ __('Choisir une option') }}" />
                <x-select wire:model.live='classe_option_id'>s
                    @foreach ($classeOptionList as $classeOptionList)
                        <option value="{{ $classeOptionList->id }}">
                            {{ $classeOptionList->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
            </div>
            <div class="row mt-2" wire:loading.class='d-none'>
                @foreach ($classeList as $classe)
                    <div class="col-md-6">
                        <a href="{{ route('inscription.list.by.classe', $classe) }}" wire:navigate>
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4 class="">{{ $classe->name . '/' . $classe->classeOption->name }}
                                        ({{ $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id) }})
                                    </h4>
                                    </h4>
                                </div>
                            </div>
                        </a>
                        @php
                            $total += $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id);
                        @endphp
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer " wire:loading.class='d-none'>
            <div class="d-flex justify-content-between text-uppercase">

                <div class="btn-group">
                    <button type="button" class="btn btn-link dropdown-icon" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        Impression
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" target="_blank" href="{{ route('inscrption.number', 0) }}">
                            <i class="fa fa-file-pdf" aria-hidden="true"></i> Inscriptions
                        </a>
                        <a class="dropdown-item" target="_blank" href="{{ route('inscrption.number', 1) }}">
                            <i class="fa fa-file-pdf" aria-hidden="true"></i> Réinscriptions
                        </a>
                    </div>
                </div>
                <h4>Effectif total: {{ $total }} élèves</h4>
            </div>
        </div>
    </div>
</div>
