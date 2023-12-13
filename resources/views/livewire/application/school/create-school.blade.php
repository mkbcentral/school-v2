<div>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img  class="" src="{{asset('logo.svg')}}" alt="Logo">
            </div>
            <div class="card-body">
                <form wire:submit="store">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="">
                            <img src="{{ asset('defautl-user.jpg') }}" class="user-image img-circle elevation-2"
                                 alt="User Image" width="100px"/>
                        </a>
                    </div>
                    <div class="input-group mt-2  @error('name') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" class="" placeholder="Nom de votre école" wire:model="name" />
                    </div>
                    @error('name')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mt-4 @error('email') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="email" class="" placeholder="Adresse mail" wire:model="email" />
                    </div>
                    @error('email')
                    <span class="error text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <div class="input-group mt-4 @error('phone') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" class="" placeholder="N° Tél" wire:model="phone" />
                    </div>
                    @error('phone')
                    <span class="error text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-form.button type="submit" class=" btn-info btn-block">
                                <span wire:loading wire:target="store"
                                      class="spinner-border spinner-border-sm"
                                      role="status" aria-hidden="true">
                                </span>
                               Créer...
                            </x-form.button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
