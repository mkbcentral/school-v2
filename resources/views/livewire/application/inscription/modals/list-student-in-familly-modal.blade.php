<div>
    <div wire:ignore.self id="lisStudentInFamillyModal" class="modal fade" tabindex="-1" role="dialog"
        data-backdrop="static" data-keyboard="false" aria-labelledby="lisStudentInFamillyModal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lisStudentInFamillyModal-title">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-users"></i>LISTE ELEVE PAR FAMILLE</h5>
                        </div>
                        <div class="card-body">
                            @if ($studentResponsable !== null)
                                <table class="table table-striped">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom complet </th>
                                            <th>Genre</th>
                                            <th>Age</th>
                                            <th>Classe</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentResponsable->students as $index => $student)
                                            <tr>
                                                <td scope="row">{{ $index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>{{ $student->getAge($student->date_of_birth) }}</td>
                                                <td>{{ $student->inscription->getStudentClasseNameForCurrentYear($student->id) }}
                                                </td>
                                                <td class="text-center">
                                                    <x-form.button class="btn-danger btn-sm" type="button"
                                                        wire:click="deleteInFamilly({{ $student->id }})">
                                                        <span wire:loading wire:target="deleteInFamilly({{ $student->id }})"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </x-form.button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</div>
