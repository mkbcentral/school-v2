<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Version 1.0 | Developpé par <a target="_blank" href="https://mkbcentral.com/">mkbcentral</a>
    </div>
    <strong>Copyright &copy; 2022 <a href="/">
            @if(!Auth::user()->school)
                {{config('app.name')}}
            @else
                {{auth()->user()->school->name }}
            @endif
        </a>.</strong> Tout droit reservé.
</footer>
