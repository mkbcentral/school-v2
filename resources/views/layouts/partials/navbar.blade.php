<nav class="main-header navbar navbar-expand {{theme_setting('is_dark_mode')?'navbar-dark':'navbar-white'}} navbar-light">
    <ul class="navbar-nav">
        @livewire('application.school.change-collapse-state-widget')
    </ul>

   @auth
   <ul class="navbar-nav ml-auto">
    <li class="nav-item mr-4">
        <div class="d-flex  align-items-center ">
            <span class="mr-2 text-bold pl-4 text-bold text-primary">Année scolaire</span>
            @if(!Auth::user()?->school)
                @livewire('application.school.scolary-year-widget')
            @endif
        </div>
    </li>
    <li class="nav-item dropdown user-menu text-white">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset(auth()->user()?->avatar ?'/storage/'.auth()->user()?->avatar :'defautl-user.jpg') }}" class="user-image img-circle elevation-2" alt="User Image" />
            <span class="d-none d-md-inline text-white">{{auth()->user()?->name}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
                <img src="{{asset(auth()->user()?->avatar ?'/storage/'.auth()->user()?->avatar :'defautl-user.jpg')}}" class="img-circle elevation-2" alt="User Image">
                <p>
                    <small>{{Auth::user()?->email}}</small>
                </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                    this.closest('form').submit();"
                       class="btn btn-default btn-flat float-right">Déconnexion</a>
                </form>
            </li>
        </ul>
    </li>
</ul>
   @endauth
</nav>
