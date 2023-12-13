<div>
    <div class="card mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-chart-pie"></i> Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/" wire:navigate>Menu</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @can('edit-student-infos')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <label class="text-uppercase"><i class="fas fa-calendar-day"></i> Stiuation opérations
                                        journalières</label>
                                    <x-form.input class="form-control w-25" type='date' placeholder="Lieu de naissance"
                                        wire:model.live='day' />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>@livewire('application.inscription.widget.new-inscription-by-date-counter-widget')</h3>
                                                <p>Nouvelle(s) inscription(s)</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="small-box bg-primary">
                                            <div class="inner">
                                                <h3>@livewire('application.inscription.widget.old-student-inscription-counter-widget')</h3>
                                                <p>Réinscription(s)</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-user"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @livewire('application.inscription.widget.list-counter-inscription-by-classe-option-widget')
                        </div>
                    </div>

                </div>
            @endcan

            @can('view-total-amount')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <h4><i class="fas fa-calendar-day"></i> Recettes journalières</h4>
                            <x-form.input class="form-control w-25" type='date' placeholder="Lieu de naissance"
                                wire:model.live='day' />
                        </div>
                        <div class="card-body">
                            @livewire('application.receipts.cost-other-payment-receipts-by-date')
                        </div>
                        @can('view-depense-emprunt')
                            @livewire('application.depense.widget.amount-emprunt-by-currency-widget')
                        @endcan
                        <div class="">
                            @livewire('application.inscription.list.widget.list-classe-by-option-with-student-counter-widget')
                        </div>
                    </div>
                    <div class="col-md-6">
                        @can('view-total-amount')
                            @livewire('application.receipts.cost-other-payment-receipts-by-month')
                        @endcan
                        @can('view-depense-emprunt')
                            @livewire('application.depense.widget.amount-depense-by-currency-widget')
                        @endcan

                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
