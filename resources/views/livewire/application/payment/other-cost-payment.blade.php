<div>
    <x-navigation.bread-crumb icon='fas fa-id-card' label='PAIEMENT TOUT LES FRAIS'>
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label='Paiement tout les frais' />
    </x-navigation.bread-crumb>

    <x-content.main-content-page>
        <div class="row">
            <div class="col-md-5">
                @livewire('application.payment.list.list-student-for-payment')
            </div>
            <div class="col-md-7">
                @livewire('application.payment.list.list-payment-by-day')
            </div>
        </div>
    </x-content.main-content-page>
</div>
