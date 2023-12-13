<x-guest-layout>
    <div class="login-box w-50">
        <div class="card card-outline card-indigo">
            <div class="card-header text-center">
                <img  class="" src="{{asset('logo.svg')}}" alt="Logo">
            </div>
            <div class="card-body">
                @livewire('application.auth.register')
            </div>
        </div>
    </div>
</x-guest-layout>
