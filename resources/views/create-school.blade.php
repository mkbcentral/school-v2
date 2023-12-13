<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{auth()->user()?auth()->user()?->school?->name:app_setting('app_name') }}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ auth()->user()? asset('storage/'.auth()->user()?->school?->logo):asset('storage/'.app_setting('app_logo')) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="old-transition login-page bg-info">
<div class="d-flex justify-content-center align-items-center">
    @livewire('application.school.create-school')
</div>
@livewireScripts
</body>
</html>
