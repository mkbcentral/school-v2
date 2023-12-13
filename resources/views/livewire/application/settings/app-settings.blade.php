<div>
    <x-loading-indicator />
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-danger"> &#x1F6E0; AUTRES PARAMETRES</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="w-25">
        <div class="form-group">
            <x-form.label value="{{ __('Nom iprimante') }}" />
            <x-form.input placeholder="Nom de l'imprimante" wire:model='name'/>
            @error('name')
            <span class="error text-danger">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $message }}
                </span>
            @enderror
            <div class="form-group clearfix mt-4">
                <div  class="icheck-primary d-inline">
                    <input type="checkbox" id="is_sidebar_collapse"
                           wire:model="is_sidebar_collapse">
                    <label for="is_sidebar_collapse">
                        Reduire menu
                    </label>
                </div>
            </div>
            <div class="form-group clearfix">
                <div  class="icheck-primary d-inline">
                    <input type="checkbox" id="is_dark_mode"
                           wire:model="is_dark_mode">
                    <label for="is_dark_mode">
                        Thème sombre
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start">
            <button wire:click='save' class="btn btn-info" type="button">Sauvegarder</button>
        </div>
    </div>
</div>

@push('js')
    <script type="module">
        $('#is_sidebar_collapse').on('change',function () {
            $('body').toggleClass('sidebar-collapse')
        })
        $('#is_dark_mode').on('change',function () {
            $('body').toggleClass('dark-mode')
            $('nav').toggleClass('navbar-dark')
        })
    </script>
@endpush
