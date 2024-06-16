<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        @auth
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{asset('storage/'.Auth::user()->profil)}}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"> {{Auth::user()->name}} </h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
             
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="bi bi-person-plus"></i>
              </span>
              <span class="menu-title">Medecin</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/ajouterMedecin">Ajouter medecin</a></li>
                <li class="nav-item"> <a class="nav-link" href="/listesMedecin">Listes medecins</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/specialite">
              <span class="menu-icon">
                <i class="bi bi-layers-half"></i>
              </span>
              <span class="menu-title">Specialite</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/callendarMedecin">
              <span class="menu-icon">
                <i class="bi bi-calendar-check"></i>
                          </span>
              <span class="menu-title">Calendrier</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">


                <li class="nav-item"> <a class="nav-link" href="/listesUsers"> Register </a></li>
                <br>

                <form class="forms-sample" method="POST" action="{{route('update.password.users')}}" >


                    @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Password</label>
                    <input type="password" class="form-control" id="exampleInputUsername1"  name="password" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputUsername1">Password-confirm</label>
                    <input type="password" class="form-control" id="exampleInputUsername1"  name="password_confirm" required>
                  </div>

                  <input type="hidden" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->id}}" name="id" placeholder="Email">

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>

              </ul>
            </div>
          </li>

        </ul>


        @endauth
      </nav>
