<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formInscriptionModal"
         tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false"
        aria-labelledby="formInscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formInscriptionModalLabel"><i class="fas fa-user-plus"></i> PASSER UNE NOUVELLE INSCRIPTION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit="store">
                    <div class="modal-body">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="card">
                                   <div class="card-header">
                                       <h4><i class="fas fa-user"></i> INFORMATION DE L'ELEVE</h4>

                                   </div>
                                   <div class="card-body">
                                       @if($responsable)
                                           <samp>Famille: {{$responsable->name_responsable}}</samp>
                                           <div class="row mt-2">
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                       <x-form.label value="{{ __('Nom complet élève') }}" />
                                                       <x-form.input class="" type='text' placeholder="Nom de la section"
                                                                wire:model.live='name' />
                                                       @error('name')
                                                       <span class="error text-danger">{{ $message }}</span>
                                                       @enderror
                                                   </div>
                                               </div>
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                       <x-form.label value="{{ __('Date de naissance') }}" />
                                                       <x-form.input class="" type='date'
                                                                wire:model='date_of_birth' />
                                                       @error('date_of_birth')
                                                       <span class="error text-danger">{{ $message }}</span>
                                                       @enderror
                                                   </div>
                                               </div>
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                       <x-form.label value="{{ __('Genre') }}" />
                                                       <x-select wire:model='gender'>
                                                           <option value="">Choisir...</option>
                                                           @foreach ($genderList as $gender)
                                                               <option value="{{ $gender->slug }}">{{ $gender->name }}</option>
                                                           @endforeach
                                                       </x-select>
                                                   </div>
                                                   @error('gender')
                                                   <span class="error text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                       <x-form.label value="{{ __('Lieu de naissance') }}" />
                                                       <x-form.input class="" type='text' placeholder="Lieu de naissance"
                                                                wire:model='place_of_birth' />
                                                       @error('place_of_birth')
                                                       <span class="error text-danger">{{ $message }}</span>
                                                       @enderror
                                                   </div>
                                               </div>
                                               <div class="col-md-4">
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
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                       <x-form.label value="{{ __('Type inscription') }}" />
                                                       <x-select wire:model='cost_inscription_id '>
                                                           <option value="">Choisir...</option>
                                                           @foreach ($costInscriptionList as $cost)
                                                               <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                           @endforeach
                                                       </x-select>
                                                   </div>
                                                   @error('cost_inscription_id')
                                                   <span class="error text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                       @endif
                                   </div>
                               </div>

                           </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">
                            <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <i class="fas fa-save"></i> Sauvegarder
                        </x-form.button>
                        <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
