<div>
    <h4 class="text-info text-uppercase text-center text-bold align-items-center">
        <i class="fas fa-user"></i> se connecter
    </h4>
    <form wire:submit="loginUser" class="mt-4">
        <div class="form-group">
            <label>Adresse mail</label>
            <div class="input-group @error('email') is-invalid border border-danger rounded @enderror">
                <x-form.input style="height: 45px"
                         type="email"
                         class="form-control"
                         placeholder="Adresse mail"
                         wire:model="email" />
            </div>
            @error('email')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <div class="input-group @error('password') is-invalid border border-danger rounded @enderror">
                <x-form.input style="height: 45px"
                         type="password"
                         class="form-control"
                         placeholder="Mot de passe"
                         wire:model="password" />
            </div>
            @error('password')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <x-form.button type="submit" class="btn-block" style="background: #3088B1;color: white">
                    <div wire:loading wire:target='loginUser' class="spinner-border spinner-border-sm text-white"
                         role="status"></div>
                    Se connecter
                </x-form.button>
                <div class="mt-2 d-flex justify-content-end align-items-center">
                    <span class="p-2">Vous n'avez de compte ? </span>
                    <a href="{{route('register')}}" class="text-bold"> Créer un compte</a>
                </div>

            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
