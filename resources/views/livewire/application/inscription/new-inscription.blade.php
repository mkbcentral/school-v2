<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"> &#x1F5C3; NOUVELLE REINSCIRPION</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Menu</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('dashboard.main') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nouvelle inscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills" wire:keydown.enter>
                @foreach ($optionList as $option)
                    <li class="nav-item">
                        <a wire:click='changeIndex({{ $option }})'
                            class="nav-link {{ $selectedIndex == $option->id ? 'active' : '' }} "
                            href="#inscription" data-toggle="tab">
                            &#x1F4C2; {{ $option->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center pb-2">
                <x-widget.loading-circular-md />
            </div>
            <div class="row">
                <div class="col-md-8">
                    @livewire('application.inscription.list.list-student-responsable', ['index' => $selectedIndex])
                </div>
                <div class="col-md-4">
                    @livewire('application.inscription.forms.add-new-familly')
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
    @livewire('application.inscription.list.list-inscription', ['index' => $selectedIndex])
</div>
