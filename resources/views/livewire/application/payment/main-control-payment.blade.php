<div>
    <x-navigation.bread-crumb icon='fa fa-folder' label='SUIVE POUR LE CONTROLE PAIEMENT'>
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label='Suivi control payment' />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @foreach ($listTypeCost as $type)
                        <li class="nav-item">
                            <a wire:click='changeIndex({{ $type }})'
                               class="nav-link text-uppercase {{ $selectedIndex == $type->id ? 'active' : '' }}"
                               href="#inscription" data-toggle="tab">
                                &#x1F4C2; {{ $type->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if($isByTranch)
                @livewire('application.payment.list.list-student-control-by-tranch',['selectedIndex' => $selectedIndex])
            @else
                @livewire('application.payment.list.list-student-control-by-month',['selectedIndex' => $selectedIndex])
            @endif

        </div>
    </x-content.main-content-page>
</div>
