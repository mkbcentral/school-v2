<div>

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
          <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#currentYear" data-toggle="tab">
                            <i class="fas fa-address-card"></i>Arrirés année en cours
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#oldYear" data-toggle="tab">
                            <i class="fas fa-address-card"></i>Arrirés année passée
                        </a>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="currentYear">
                       @livewire('application.payment.list.list-payment-for-last-month')
                    </div>
                    <div class="tab-pane" id="oldYear">
                        @livewire('application.payment.my-late-payment')
                     </div>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
      <!-- /.content -->

</div>
