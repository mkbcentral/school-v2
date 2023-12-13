<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>MON COMPTE</h4>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Non: {{Auth::user()->name}}</h5>
                        </div>
                    </div>
                    <form wire:submit='updatePassword'>
                        <div class="form-group">
                            <x-form.label value="{{ __('Ancien mot de passe') }}" />
                            <x-form.input class="" type='password' wire:model='old_password' />
                            @error('old_password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form.label value="{{ __('Nouveau mot de passe') }}" />
                            <x-form.input class="" type='password' wire:model='password' />
                            @error('password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form.label value="{{ __('Nouveau mot de passe') }}" />
                            <x-form.input class="" type='password' wire:model='password_confirm' />
                            @error('password_confirm')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <x-form.button type="submit" class="btn btn-primary">
                                <span wire:loading wire:target="updatePassword"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i class="fab fa-refresh" aria-hidden="true"></i> Mettre à jour mot de passe
                            </x-form.button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
