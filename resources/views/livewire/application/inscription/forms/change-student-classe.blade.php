<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="change-student-classe-modal" tabindex="-1" role="dialog"
        aria-labelledby="showStudentInfosLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showStudentInfosLabel">
                        BASCULER VER UNE AUTRE CLASSE
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='changeClasse'>
                    <div class="modal-body">
                        @if ($inscription)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{ $inscription->student->name }}</h6>
                                <h6><span class="text-bold text-info">Classe
                                        actuelle:</span>{{ $inscription->classe->name . '/' . $inscription->classe->classeOption->name }}
                                </h6>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Type inscription') }}" />
                                        <x-select wire:model.blur='cost_inscription_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($costInscriptions as $costInscription)
                                                <option value="{{ $costInscription->id }}">
                                                    {{ $costInscription->name }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('cost_inscription_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Option') }}" />
                                        <x-select wire:model.live='classe_option_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($classeOptions as $classeOption)
                                                <option value="{{ $classeOption->id }}">
                                                    {{ $classeOption->name }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('classe_option_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-form.label value="{{ __('Classe') }}" />
                                        <x-select wire:model='classe_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}">
                                                    {{ $classe->name . '/' . $classe->classeOption->name }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('classe_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center p-2">
                                <x-widget.loading-circular-md />
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">
                            <div wire:loading wire:target='changeClasse'
                                class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Sauvegarder
                        </x-form.button>
                        <x-form.button type="button" class="btn btn-danger"
                            data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script type="module">
            //Open create new sheet modal
            window.addEventListener('close-change-student-classe-modal', e => {
                $('#change-student-classe-modal').modal('hide')
            });
        </script>
    @endpush
</div>
