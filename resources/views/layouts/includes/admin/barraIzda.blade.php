
 <div class="sidebar" data-color="blue" data-image="{{asset('img/sidebar-1.jpg') }}">
      <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
          Creative Tim
        </a>
      </div>

        <div class="sidebar-wrapper">
              <ul class="nav">
              <?php
                $seccion       = \Session::get('seccion_actual');
                if($seccion==="Provincia")
                {
                  echo "<li class='active'>";
                }
                else
                {
                  echo "<li>";
                }
              ?>
                      <a href="{{asset('/admin/Provincia')}}">
                          <i class="material-icons">dashboard</i>
                          <p>Provincias</p>
                      </a>
                  </li>
              <?php
                $seccion       = \Session::get('seccion_actual');
                if($seccion==="Imagen")
                {
                  echo "<li class='active'>";
                }
                else
                {
                  echo "<li>";
                }
              ?>
                      <a href="{{asset('/admin/Imagen')}}">
                          <i class="material-icons">person</i>
                          <p>Imagenes</p>
                      </a>
                  </li>
              <?php
                $seccion       = \Session::get('seccion_actual');
                if($seccion==="Anuncio")
                {
                  echo "<li class='active'>";
                }
                else
                {
                  echo "<li>";
                }
              ?>
                      <a href="{{asset('/Anuncio')}}">
                          <i class="material-icons">content_paste</i>
                          <p>Anuncios</p>
                      </a>
                  </li>
              <?php
                $seccion       = \Session::get('seccion_actual');
                if($seccion==="Usuario")
                {
                  echo "<li class='active'>";
                }
                else
                {
                  echo "<li>";
                }
              ?>
                      <a href="{{asset('/admin/Usuario')}}">
                          <i class="material-icons">library_books</i>
                          <p>Usuarios</p>
                      </a>
                  </li>
              <?php
                $seccion       = \Session::get('seccion_actual');
                if($seccion==="InfoCuenta")
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
              </ul>
        </div>
      </div>