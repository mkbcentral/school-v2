<div>
    <form wire:submit="store">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-users"></i> CREATION NOUVELLE FAMILLE</h5>
            </div>
            <div class="card-body">
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
                    <x-form.input class="" type='text' placeholder="Nom de la section" wire:model='email' />
                    @error('email')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <x-form.button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    <i class="fas fa-save"></i> Sauvegarder
                </x-form.button>
            </div>
        </div>
    </form>
</div>
