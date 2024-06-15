<!DOCTYPE html>
<html lang="en">
  @include('Admin.templates.head')

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      @include('Admin.templates.sidebar')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        @include('Admin.templates.navbar')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Ajouter medecin </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Formulaire</a></li>
                </ol>
              </nav>
            </div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" method="POST" action="/storeMedecin" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nom" placeholder="Nom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Prenom</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="prenom" placeholder="Prenom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Profile</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" name="profil" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Telephone</label>
                        <input type="text" class="form-control"  id="exampleInputPassword1" name="phone" placeholder="Phone">
                      </div>

                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>








            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('Admin.templates.js')

    <!-- End custom js for this page -->
  </body>
</html>
