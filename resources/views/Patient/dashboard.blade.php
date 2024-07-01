<!DOCTYPE html>

<html class="no-js">

@include('Patient.template.head')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<body id="welcome">

	<aside class="left-sidebar">
		<div class="logo">
			<a href="#welcome">
				<h3>Dashboard</h3>
			</a>
		</div>
		<nav class="left-nav">
			<ul id="nav">
				<li class="current"><a href="/">Page d'acceuil</a></li>
				<li><a href="#css-structure"> <i class="bi bi-envelope-at"></i> Messages</a></li>

				<li><a href="#credit" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update compte</a></li>
                <li><a href="{{route('logout.patient')}}">Deconnection</a></li>
			</ul>
		</nav>
	</aside>

	<div id="main-wrapper">
		<div class="main-content">
			<section id="welcome">
				<div class="content-header">

				</div>

					<h2 class="twenty">Bienvenu {{$patient->nom}} </h2>

					<p>Date :{{date('Y-m-d')}} </p>

					<p>Listes des rendez-vous</p>


                        @if ($errors->any())
                        <div >
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="alert alert-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

			</section>

			<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
   Faire une demande
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Faire la demande</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('addDemande.patient')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail16" class="form-label">Motif</label>
                  <input type="text" name="motif" class="form-control"  id="exampleInputEmail16" required>
                </div>


                    <input type="hidden"  name="id" value="{{$patient->id}}" class="form-control" id="exampleInputPassword8">

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>

      </div>
    </div>
  </div>


              <livewire:liste-rendez-vous-patient :idPatient="$patient->id" />




  </div>
</div>


  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modification des informations</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('updateccount.Patient')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nom</label>
                  <input type="text" name="nom" class="form-control" value="{{$patient->nom}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail12" class="form-label">Prenom</label>
                    <input type="text" name="prenom" class="form-control" value="{{$patient->prenom}}" id="exampleInputEmail12" aria-describedby="emailHelp">


                    <div class="mb-3">
                        <label for="exampleInputEmail13" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{$patient->email}}" id="exampleInputEmail13" aria-describedby="emailHelp">
                      </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail14" class="form-label">Teléphoné</label>
                    <input type="text" name="tel" class="form-control" value="{{$patient->tel}}" id="exampleInputEmail14" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail15" class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="{{$patient->adresse}}" id="exampleInputEmail15" aria-describedby="emailHelp">
                  </div>
                <div class="mb-3">
                  <label for="exampleInputPassword16" class="form-label">Password <span style="color:red">NB:(Si vous voules garder l anciens mots de passes laisser le champs vide)</span> </label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword16">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword17" class="form-label">Password-confirmation</label>
                    <input type="password" name="password_confirm" class="form-control" id="exampleInputPassword17">
                  </div>
                    <input type="hidden"  name="id" value="{{$patient->id}}" class="form-control" id="exampleInputPassword199">

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


  @livewireScripts

		</body>
		</html>
