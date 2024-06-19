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
              <h3 class="page-title"> Listes medecins</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
              </nav>
            </div>
            <div class="row">
             
              <form action="{{route('search.medecin')}}" method="POST">
                @csrf
               
                <input type="text" name="value" placeholder="Recherche ..." required>
                <button type="submit" class="btn btn-info">Valider</button>
              </form>
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
                            <th> Details </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($medecinAll as $medecin)
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
                            <td> <a href="{{route('edit.medecin',['id'=>$medecin->id])}}" class="btn btn-info"><i class="bi bi-eye"></i></a> </td>

                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    {{$medecinAll->links()}}
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
    @include('Admin.templates.js')

  </body>
</html>