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
              <h3 class="page-title"> Modification du profile </h3>

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
                    <div class="card-body" style="display: flex; justify-content: center; align-items: center; min-height: 300px;">

                  <div class="card-body">

                    <form class="forms-sample" method="POST" action="{{route('update.user')}}" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputUsername122" value="{{Auth::user()->name}}" name="name" placeholder="Nom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername122">Prenom</label>
                        <input type="text" class="form-control" id="exampleInputUsername12E" value="{{Auth::user()->prenom}}" name="prenom" placeholder="Prenom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail12">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail12" value="{{Auth::user()->email}}" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword13">Piece</label>
                        <input type="file" class="form-control" id="exampleInputPassword13" name="profil" >
                      </div>

                      <input type="hidden" class="form-control" id="exampleInputEmail133" value="{{Auth::user()->id}}" name="id" placeholder="Email">


                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </form>
                    </div>
                  </div>
                </div>
              </div>









            </div>
          </div>

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">

                <form class="forms-sample" method="POST" action="{{route('update.password.users')}}" >


                    @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Password</label>
                    <input type="password" class="form-control" id="exampleInputUsername1"  name="password" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputUsername12">Password-confirm</label>
                    <input type="password" class="form-control" id="exampleInputUsername12"  name="password_confirm" required>
                  </div>

                  <input type="hidden" class="form-control" id="exampleInputEmail13" value="{{Auth::user()->id}}" name="id" placeholder="Email">

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>
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
