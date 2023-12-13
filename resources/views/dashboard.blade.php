<div>
    @include('layouts.partials.navbar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light text-upercase">
                {{ config('app.name', 'MASOMO') }}
            </span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">

                        @livewire('application.navigation.application-link-menu-sub',['appLink'=>$appLink])
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <x-app-layout>

    </x-app-layout>
</div>
