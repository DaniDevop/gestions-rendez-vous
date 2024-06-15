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
              <h3 class="page-title"> Details medecins</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
              </nav>
            </div>
            <div class="row">


              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Profile </th>
                            <th> Nom </th>
                            <th> Prenom </th>
                            <th> Email </th>
                            <th> Tel </th>
                            <th> Modifier </th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td class="py-1">
                              <img src="{{asset('storage/'.$medecin->profil)}}" alt="image" />
                            </td>
                            <td> {{$medecin->nom}} </td>
                            <td>
                            {{$medecin->prenom}}
                            </td>
                            <td> {{$medecin->email}} </td>
                            <td> {{$medecin->tel}} </td>
                            <td> <a href="#" class="btn btn-info"><i class="bi bi-eye"  data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a> </td>

                          </tr>


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

             <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification informations</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form class="forms-sample" method="POST" action="/updateMedecin" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nom" value="{{$medecin->nom}}" placeholder="Nom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Prenom</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{$medecin->prenom}}" name="prenom" placeholder="Prenom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" value="{{$medecin->email}}" id="exampleInputEmail1" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Profile</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" name="profil" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Telephone</label>
                        <input type="text" class="form-control" value="{{$medecin->tel}}"  id="exampleInputPassword1" name="phone" placeholder="Phone">
                      </div>

                      <input type="hidden" class="form-control" value="{{$medecin->id}}"  id="exampleInputPassword1" name="id" placeholder="Phone">


                      <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
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
    <!-- container-scroller -->
    @include('templates.js')

  </body>
</html>
