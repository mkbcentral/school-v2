<div class="card mt-4 p-2">
    @livewire('application.depense.list-depense-source')
    @livewire('application.depense.form.form-depense')
    @livewire('application.depense.list-depense-type')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-list" aria-hidden="true"></i>LISTE DEPENSES</div>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('application.depense.list.list-depense')
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <x-form.button type="button" class="btn-primary w-100" data-toggle="modal"
                        data-target="#listCategoryDepenseModal">
                        <i class="fas fa-coins    "></i> Catégorie dépennse
                    </x-form.button>
                    <x-form.button type="button" class="btn-secondary w-100 mt-2" data-toggle="modal"
                        data-target="#listSourceDepenseModal">
                        <i class="fas fa-coins    "></i> Source dépennse
                    </x-form.button>
                    <x-form.button type="button" class="btn-danger w-100 mt-2" data-toggle="modal"
                        data-target="#listDepenseTypeModal">
                        <i class="fas fa-coins    "></i> Type dépennse
                    </x-form.button>
                    <a href="{{ route('depense.emprunt') }}" wire:navigate class="btn btn-info  w-100 mt-2">
                        <i class="fas fa-hand-holding-usd    "></i>Nos Emprunts
                    </a>

                </div>
            </div>
            @livewire('application.depense.widget.amount-emprunt-by-currency-widget')
            @livewire('application.depense.list-category-depense')
        </div>
    </div>
</div>
