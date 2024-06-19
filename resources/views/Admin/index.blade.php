<!DOCTYPE html>
<html lang="en">
@include('Admin.templates.head')

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('Admin.templates.sidebar')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('Admin.templates.navbar')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <h4 class="mb-1 mb-sm-0">Bienvenue {{Auth::user()->name}} </h4>

                      </div>


                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">




            </div>
            <div class="row">


            </div>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Nombres des utilisateur</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> {{ $usersAll}} </h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium">{{ $usersAll /100}} %</p>
                        </div>

                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-doctor text-primary ml-auto"></i>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Nombres des Medecin</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> {{$medecinAll}} </h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium"> {{$medecinAll/100}} %</p>
                        </div>

                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account text-primary ml-auto"></i>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Nombres des demandes</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> {{$demandeAll}} </h2>
                          <p class="text-danger ml-2 mb-0 font-weight-medium"> {{$demandeAll/100}} % </p>
                        </div>

                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-calendar text-primary ml-auto"></i>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="color:blue;">Listes des demandes de rendez-vous</h4>
                    <div class="table-responsive">
                     <livewire:liste-demande-patient />
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title" style="color:blue;">Listes des demandes de rendez-vous Fixé</h4>
                        <div class="table-responsive">

                         <livewire:listes-rendez-vous-medecin-patient />
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
     @include('Admin.templates.js')
    <!-- End custom js for this page -->
  </body>
</html>
