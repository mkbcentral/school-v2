<div>
    <x-navigation.bread-crumb icon='fas fa-chart-pie' label="Autres mouvements">
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label="Autres mouvements" />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#bank" data-toggle="tab">
                        <i class="fas fa-address-card"></i> Dépot banque
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#saving" data-toggle="tab">
                        <i class="fas fa-address-card"></i> Epargne
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#salary" data-toggle="tab">
                        <i class="fas fa-address-card"></i> Salaire
                    </a>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="bank">
                    @livewire('application.movement.bank-deposit-view')
                </div>
                <div class="tab-pane" id="saving">
                    @livewire('application.movement.money-saving-view')
                </div>
                <div class="tab-pane" id="salary">
                   @livewire('application.movement.agent-salary-view')
                </div>
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
    </x-content.main-content-page>
</div>
