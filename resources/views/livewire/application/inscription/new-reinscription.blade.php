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
                        <li class="breadcrumb-item active">Nouvelle réinscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    @livewire('application.inscription.forms.add-new-reinscription')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-uppercase text-bold">LISTE DES ANCIENS ELEVES</h4>
                                <x-form.search-input />
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($studentList->isEmpty())
                            <x-data-empty />
                            @else
                            <table class="table table-stripped table-sm">
                                <thead class="bg-primary">
                                    <tr class="text-uppercase">
                                        <th>Noms élève</th>
                                        <th class="text-center">Genre</th>
                                        <th class="text-center">Age</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentList as $student)
                                    <tr>
                                        <td>{{ $student->name }}
                                        </td>

                                        <td class="text-center">
                                            {{ $student->gender }}
                                        </td>
                                        <td class="text-center">
                                            {{ $student->getAge($student->date_of_birth) }}
                                        </td>
                                        <td class="text-center">
                                            <x-form.button wire:click='show({{ $student }})' class="btn-sm"
                                                type="button" data-toggle="modal" data-target="#newReinscription">
                                                <i class="fas fa-user-plus text-primary"></i>
                                            </x-form.button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                    {{ $studentList->links('vendor.livewire.bootstrap') }}
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    @livewire('application.inscription.forms.add-new-familly')
                </div>
            </div>
            @livewire('application.inscription.list.list-inscription', ['index' => 0])
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>