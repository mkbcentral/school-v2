<x-guest-layout>
    <div class="login-box">
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <img  class="" src="{{asset('logo.svg')}}" alt="Logo">
            </div>
            <div class="card-body">
               @livewire('application.auth.login')
            </div>
        </div>
    </div>
</x-guest-layout>
