<x-guest-layout>
    <div class="login-box">
        <!-- /.login-logo -->
        @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img class="" src="{{asset('logo.svg')}}" alt="Logo">
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div>
                        <x-form.label value="{{ __('Adresse email') }}" />
                        <div class="input-group  @error('email') is-invalid border border-danger rounded @enderror">
                            <x-form.input style="height: 45px" type="email" id="email"
                                     class="form-control"
                                     placeholder="Adresse mail" name="email" />
                        </div>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-form.label value="{{ __('Mot de passe') }}" />
                        <div class="input-group @error('password') is-invalid border border-danger rounded @enderror">
                            <x-form.input style="height: 45px" type="password"
                                     placeholder="Adresse mail"
                                     placeholder="Mot de passe"
                                     class="form-control bg-white"
                                     name="password" />
                        </div>
                        @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <x-form.button type="submit" class="btn-block" style="background: #3088B1;color: white">
                                Se connecter
                            </x-form.button>
                            <div class="mt-2 d-flex justify-content-end align-items-center">
                                <span>Vous n'avez de compte ? </span>
                                <a href="#" class="text-bold"> Créer un compte</a>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</x-guest-layout>
