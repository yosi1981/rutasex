

<div class="wrapper">

      <div class="sidebar" data-color="blue" data-image="{{asset('img/sidebar-1.jpg')}}">
      <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

      <div class="logo">
        <a href="http://localhost:8000" class="simple-text">
          RUTA SEX
        </a>
      </div>

        <div class="sidebar-wrapper">
              <ul class="nav">
                  <li class="active">
                      <a href="{{asset('/admin/Provincia')}}">
                          <i class="material-icons">dashboard</i>
                          <p>Provincias</p>
                      </a>
                  </li>
                  <li>
                      <a href="{{asset('/admin/Imagen')}}">
                          <i class="material-icons">photo</i>
                          <p>Imagenes</p>
                      </a>
                  </li>
                  <li>
                  <li>
                      <a href="{{asset('/admin/Usuario')}}">
                          <i class="material-icons">person</i>
                          <p>Usuario</p>
                      </a>
                  </li>
                  <?php 
                    if(Session::get('seccion_actual')=='infocuenta')
                    {
                      echo "<li class='active'>";
                    }
                    else
                    {
                      echo "<li>";
                    }
                  ?>

                      <a href="{{asset('/infocuenta')}}">
                          <i class="material-icons">bubble_chart</i>
                          <p>Info Cuenta</p>
                      </a>
                  </li>
                  <li>
                      <a href="maps.html">
                          <i class="material-icons">location_on</i>
                          <p>Maps</p>
                      </a>
                  </li>
                  <li>
              </ul>
        </div>
      </div>

      <div class="main-panel">
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Material Dashboard</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">dashboard</i>
                  <p class="hidden-lg hidden-md">Dashboard</p>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="hidden-lg hidden-md">Notifications</p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Mike John responded to your email</a></li>
                  <li><a href="#">You have 5 new tasks</a></li>
                  <li><a href="#">You're now friend with Andrew</a></li>
                  <li><a href="#">Another Notification</a></li>
                  <li><a href="#">Another One</a></li>
                </ul>
              </li>
              <li>
                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                   <i class="material-icons">person</i>
                   <p class="hidden-lg hidden-md">Profile</p>
                </a>
              </li>
            </ul>

            <form class="navbar-form navbar-right" role="search">
              <div class="form-group  is-empty">
                <input type="text" class="form-control" placeholder="Search">
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i><div class="ripple-container"></div>
              </button>
            </form>
          </div>
        </div>
      </nav>

      <div class="content">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->            
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="compras/ingreso"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="compras/proveedor"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>
            -->
