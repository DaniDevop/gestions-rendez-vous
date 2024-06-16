<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

@include('Patient.template.head')
<body id="welcome">

	<aside class="left-sidebar">
		<div class="logo">
			<a href="#welcome">
				<h3>Dashboard</h3>
			</a>
		</div>
		<nav class="left-nav">
			<ul id="nav">
				<li class="current"><a href="/patient/home">Page d'acceuil</a></li>
				<li><a href="#css-structure"> <i class="bi bi-envelope-at"></i> Messages</a></li>
				
				<li><a href="#credit">Update compte</a></li>
                <li><a href="#credit">Deconnection</a></li>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
       
      </div>
    </div>
  </div>

			<section id="tmpl-structure">
				<table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
			</section>

         
    
  </div>
</div>


	

		</body>
		</html>
