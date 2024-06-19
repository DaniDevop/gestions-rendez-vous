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
            <div class="page-header">
              <h3 class="page-title"> Listes des utilisateurs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
                @if ($errors->any())
                <div >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
              </nav>
            </div>
            <div class="row">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    +Ajouter un utilisateur
                  </button>




              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">

                        <form action="{{route('search.users')}}" method="GET">
                            @csrf
                           
                            <input type="text" name="value" placeholder="Recherche ..." required>
                            <button type="submit" class="btn btn-info">Valider</button>
                          </form>
                        <thead>
                          <tr>
                            <th> Profile </th>
                            <th> Nom </th>
                            <th> Prenom </th>
                            <th> Email </th>
                            <th> Tel </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($usersAll as $users)
                          <tr>
                            <td class="py-1">
                              <img src="{{asset('storage/'.$users->profil)}}" alt="image" />
                            </td>
                            <td> {{$users->name}} </td>
                            <td>
                            {{$users->prenom}}
                            </td>
                            <td> {{$users->email}} </td>
                            <td> {{$users->tel}} </td>
                            
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
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
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="forms-sample" method="POST" action="{{route('add.users')}}" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Nom</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Nom">
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
                <label for="exampleInputPassword1">Piece</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="profil" >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mot-de-passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Conirmation-mot-de-passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirm" >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Role</label>
                <select name="role" id="form-control" class="form-control">
                     <option value="USER">Utilisateur</option>
                     <option value="ADMIN">Administrateur</option>

                </select>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
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
    @include('Admin.templates.js')

  </body>
</html>
