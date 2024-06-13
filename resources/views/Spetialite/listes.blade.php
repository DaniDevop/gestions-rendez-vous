<!DOCTYPE html>
<html lang="en">

@include('templates.head')

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('templates.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      @include('templates.navbar')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Listes des specialite</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </ol>
              </nav>
            </div>
            <div class="row">


                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    +Ajouter-une-specialite
                  </button></br>


              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Numero </th>
                            <th> Specialite </th>
                            <th> Status </th>
                            <th> Date-creation </th>
                            <th> Date-mise-a-jour </th>
                            <th> Details </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($spetialiteAll as $special)
                          <tr>
                            <td> {{$special->id}} </td>

                            <td> {{$special->nom}} </td>
                            <td>
                            {{$special->status}}
                            </td>


                            <td> {{$special->created_at}} </td>
                            <td> {{$special->updated_at}} </td>
                            <td> <a href="" class="btn btn-info"><i class="bi bi-eye"></i></a> </td>

                          </tr>
                          @endforeach

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
          <h4 class="modal-title fs-5" id="exampleModalLabel">Ajouter une spetialite</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="forms-sample" method="POST" action="{{route('add.Specialite')}}" >
                @csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Speciqlite</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="nom" placeholder="Designation" required>
              </div>

              <div class="form-group">
                <label for="exampleInputUsername1">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="Disponible">Disponible</option>
                    <option value="Indisponible">Indisponible</option>

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
