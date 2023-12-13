<div>
    @livewire('application.payment.form.new-late-payment')
    @livewire('application.payment.list.list-late-payment-by-date')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fa fa-folder" aria-hidden="true"></i> REGLEMENT ARRIERES</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-uppercase text-bold">LISTE DES ELEVES</h4>
                                    <x-form.search-input class="w-100" />
                                </div>
                                <x-form.button wire:click='showList' class=" btn-primary" data-toggle="modal" data-target="#ListLatePaymentModal"
                                    type="button">
                                    Liste paiment
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </x-form.button>
                            </div>
                            @if ($studentList->isEmpty())
                                <x-data-empty />
                            @else
                                <div class="p-2">
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
                                                        <x-form.button wire:click='show({{ $student }})'
                                                            class="" data-toggle="modal"
                                                            data-target="#newLatePayment" type="button">
                                                            <i class="fas fa-user-plus text-primary"></i>
                                                        </x-form.button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                    {{ $studentList->links('vendor.livewire.bootstrap') }}
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    @livewire('application.payment.form.new-late-payment')
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
