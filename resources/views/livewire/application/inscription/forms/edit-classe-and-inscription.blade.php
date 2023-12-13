<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editClasseAnInscription" tabindex="-1" role="dialog"
        aria-labelledby="showStudentInfosLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showStudentInfosLabel">
                        MODIFICATION CLASSE OU INSCRIPTION
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='update'>
                    <div class="modal-body">
                        @if ($inscription)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{$inscription->student->name}}</h6>
                                <h6><span class="text-bold text-info">Classe:</span>{{$inscription->classe->name}}</h6>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Classe') }}" />
                                                <x-select wire:model='classe_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($classeList as $classe)
                                                        <option value="{{ $classe->id }}">
                                                            {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Type inscription') }}" />
                                                <x-select wire:model='cost_inscription_id '>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($costInscriptionList as $cost)
                                                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Date de paiment') }}" />
                                                <x-form.input class="" type='date' placeholder="Date de paiement"
                                                    wire:model='created_at' />
                                                @error('created_at')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-form.label value="{{ __('Famille') }}" />
                                                <x-select wire:model='student_responsable_id '>
                                                    @foreach ($famillyList as $familly)
                                                        <option value="{{ $familly->id }}">{{ $familly->name_responsable }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">Sauvegarder</x-form.button>
                        <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
