<div>
    <x-navigation.bread-crumb icon='fa fa-folder' label='RAPPORT GLOBAL DE PAIMENT'>
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label='Rapport global' />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @foreach ($listTypeCost as $type)
                        <li class="nav-item">
                            <a wire:click='changeIndex({{ $type }})'
                                class="nav-link {{ $selectedIndex == $type->id ? 'active' : '' }} "
                                href="#payement-rapport" data-toggle="tab">
                                &#x1F4C2; {{ $type->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                @livewire('application.rapport.list.list-payment-global-rapport', ['selectedIndex' => $selectedIndex])
            </div>
        </div>
    </x-content.main-content-page>
</div>
