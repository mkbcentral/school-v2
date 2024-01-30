<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ auth()->user()?->school == null ? config('app.name') : auth()->user()->school->name }}</title>
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ auth()->user()?->school ? asset('storage/' . auth()->user()?->school->logo) : asset('Vector.png') }}">
    <script src="{{ asset('moment/moment.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="hold-transition sidebar-mini {{ theme_setting('is_dark_mode') ? 'dark-mode' : '' }}  {{ theme_setting('is_sidebar_collapse') ? 'sidebar-collapse' : '' }}">
    <div class="wrapper">
        @include('layouts.partials.navbar')
        @include('layouts.partials.sidemenu')
        <div class="content-wrapper card">
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        @livewire('application.school.switch-theme-widget')
                        @livewire('application.settings.initial-loadding-app')
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.footer')
    </div>
    @stack('js')
</body>

</html>
