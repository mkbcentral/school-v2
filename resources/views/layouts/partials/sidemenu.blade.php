<aside class="main-sidebar sidebar-dark-primary  elevation-4">
    <a href="/" class="brand-link">
        @if(Auth::user()->school)
            <img src="{{asset('Vector-white.svg')}}" alt="Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light text-upercase">{{config('app.name')}}</span>
        @else
            <img src="{{asset('Vector-white.svg')}}" alt="Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light text-upercase">{{config('app.name')}}</span>
        @endif
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @livewire('application.navigation.application-link-menu-sub')
            </ul>
        </nav>
    </div>
</aside>
