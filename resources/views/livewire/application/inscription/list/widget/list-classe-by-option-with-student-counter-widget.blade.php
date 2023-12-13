<div>
    @php
        $total=0;
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
                        <a href="{{ route('inscription.list.by.classe',$classe) }}" wire:navigate>
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4 class="">{{ $classe->name . '/' . $classe->classeOption->name }}
                                        ({{ $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id) }})</h4>
                                       </h4>
                                </div>
                            </div>
                        </a>
                        @php
                            $total+=$classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id);
                        @endphp
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end text-uppercase" wire:loading.class='d-none'>
            <h4>Effectif total: {{$total}} élèves</h4>
        </div>
    </div>
</div>
