<div wire:ignore.self id="editFamillyModal" class="modal fade" tabindex="-1" role="dialog"
        data-backdrop="static" data-keyboard="false" aria-labelledby="editFamillyModal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFamillyModal-title">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form >
                            @if ($studentResponsable)
                            <div class="form-group">
                                <x-form.label value="{{ __('Nom de la famille') }}" />
                                <x-form.input class="" type='text' placeholder="Nom de la famille"
                                    wire:model='name_responsable' />
                                @error('name_responsable')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-form.label value="{{ __('Téléphone') }}" />
                                <x-form.input class="" type='text' placeholder="Tél" wire:model='phone' />
                                @error('phone')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-form.label value="{{ __('Autre Tél') }}" />
                                <x-form.input class="" type='text' placeholder="Autre tél" wire:model='other_phone' />
                                @error('other_phone')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        <div class="form-group">
                                <x-form.label value="{{ __('Adresse email') }}" />
                                <x-form.input class="" type='text' placeholder="Nom de la section"
                                    wire:model='email' />
                                @error('email')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        </form>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <x-form.button type="button" wire:click="updateFamilly" class="btn btn-primary">
                        <span wire:loading wire:target="updateFamilly" class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span>
                        <i class="fas fa-save"></i> Sauvegarder
                    </x-form.button>
                </div>
            </div>
        </div>
    </div>