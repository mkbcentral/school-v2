<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="listDepenseTypeModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="listdepenseTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listdepenseTypeModalLabel">
                        TYPE DES DEPENSES
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    LISTE DES SOURCES
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <div wire:loading class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listDepenseType as $index => $depenseType)
                                                <tr>
                                                    <td scope="row">{{ $index + 1 }}</td>
                                                    <td>{{ $depenseType->name }}</td>
                                                    <td class="text-center">
                                                        <x-form.button
                                                            wire:click='edit({{ $depenseType }},{{ $depenseType->id }})'
                                                            class="btn-sm text-primary" type="button">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </x-form.button>
                                                        <x-form.button wire:click='delete({{ $depenseType->id }})'
                                                            wire:confirm="Etes-vous sûre de supprimer?"
                                                            class="btn-sm text-danger" type="button">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </x-form.button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $listDepenseType->links('vendor.livewire.bootstrap') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <form
                                @if ($isEditing == false) wire:submit='store'
                                @else
                                wire:submit='update' @endif>
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas {{ $isEditing == false ? 'fa-plus-circle' : 'fa-edit' }}"></i>
                                        {{ $isEditing == false ? 'NOUVELLE TYPE' : 'MODIFICATION TYPE' }}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <x-form.label value="{{ __('Type depense') }}" />
                                            <x-form.input class="" type='text' placeholder="Type depense"
                                                wire:model='name' />
                                            @error('name')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <x-form.button type="submit" class="btn btn-primary">
                                            <span wire:loading wire:target="store"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <i class="fas {{ $isEditing == false ? 'fa-save' : 'fa-edit' }}"></i>
                                            {{ $isEditing == false ? 'Sauvegarder' : 'Modifier' }}
                                        </x-form.button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
