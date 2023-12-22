<div>
    @foreach (Auth::user()->subAppLinks as $menu)
        <x-nav-link class="nav-link" href="{{ route($menu->link) }}" :active="request()->routeIs($menu->link)">
            <div wire:click='makeLoadingState({{ $menu->id }},{{ Auth::user()->id }})'
                class="d-flex align-items-center">
                <i class="fa {{ $menu->icon }}"></i>
                <div class="d-flex justify-content-between align-items-center">
                    <p>{{ $menu->name }} </p>
                    <span wire:loading wire:target='makeLoadingState({{ $menu->id }},{{ Auth::user()->id }})'
                        class="spinner-border
                    spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                </div>
            </div>

        </x-nav-link>
    @endforeach
    @can('view-administration-panel')
        <x-nav-link class="nav-link" href="{{ route('settings.app.links') }}" :active="request()->routeIs('settings.app.links')">
            <i class="fas fa-cog"></i>
            <p>Paramètres de menu</p>
        </x-nav-link>
    @endcan
</div>
