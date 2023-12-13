<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{auth()->user()?->school==null?config('app.name'):auth()->user()->school->name}}</title>
        <link rel="icon" type="image/png" sizes="96x96" href="{{ auth()->user()?->school? asset('storage/'.auth()->user()?->school->logo):asset('Vector.png') }}">
        <script src="{{ asset('moment/moment.min.js') }}"></script>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="hold-transition login-page "  style="background: url({{asset('my-bg.svg')}});background-size:cover;background-repeat: no-repeat">
        {{ $slot }}
    </body>
</html>
