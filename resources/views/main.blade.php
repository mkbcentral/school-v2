<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{auth()->user()?->school==null?config('app.name'):auth()->user()->school->name}}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ auth()->user()?->school? asset('storage/'.auth()->user()?->school->logo):asset('Vector.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="hold-transition py-4" style="background: url({{asset('my-bg.svg')}});background-size:cover;background-repeat: no-repeat">
    <div class="d-flex justify-content-center align-items-center">
        @livewire('application.navigation.application-link-menu')
    </div>
    @livewireScripts
</body>
</html>
