<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!--=====================================
              LOGO
  ======================================-->
  <a href="inicio" class="brand-link">
  
    <img src="vistas/img/plantilla/icono.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">

    <span class="brand-text font-weight-light text-center" style="width: 150px">HOTEL PARACAS</span>

  </a>

  <!--=====================================
                  MENÚ
  ======================================-->

  <div class="sidebar">

    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <br>

        <!-- botón Ver sitio -->

        <li class="nav-item">
          
          <a href="<?php echo $ruta; ?>" class="nav-link active" target="_blank">
            
            <i class="nav-icon fas fa-globe"></i>
            
            <p class="text-center" style="width: 150px; font-size: 120%">VER SITIO</p>

          </a>

        </li>

        <!-- Botón página inicio -->

        <li class="nav-item">

          <a href="inicio" class="nav-link">

            <i class="nav-icon fas fa-home"></i>

            <p>INICIO</p>

          </a>

        </li>

        <!-- Botón página administradores -->  

        <?php if ($admin["perfil"] == "Administrador"): ?>
          
          <li class="nav-item">

            <a href="administradores" class="nav-link">

              <i class="nav-icon fas fa-users-cog"></i>

              <p>ADMINISTRADORES</p>

            </a>

          </li>

           <?php endif ?>

        <!-- Botón página banner -->

        <li class="nav-item">

          <a href="banner" class="nav-link">

            <i class="nav-icon far fa-images"></i>
            <p>
              BANNER
            </p>
          </a>
        </li>

        <!-- Botón página planes -->

        <li class="nav-item">
          
          <a href="planes" class="nav-link">
            
            <i class="nav-icon fas fa-shopping-bag"></i>
            
            <p>PLANES</p>
          
          </a>

        </li>

        <!-- Botón página categorías -->

        <li class="nav-item">
          
          <a href="categorias" class="nav-link">
            
            <i class="nav-icon fas fa-list-ul"></i>
            
            <p>CATEGORIAS</p>
          
          </a>

        </li>

        <!-- Botón página habitaciones -->

        <li class="nav-item">

          <a href="habitaciones" class="nav-link">

            <i class="nav-icon fas fa-bed"></i>
            
            <p>HABITACIONES</p>

          </a>

        </li>

        <!-- Botón página reservas -->

         <?php if ($admin["perfil"] == "Administrador"): ?>

        <li class="nav-item">

          <a href="reservas" class="nav-link">

            <i class="nav-icon far fa-calendar-alt"></i>

            <p>RESERVAS</p>

          </a>

        </li>

          <?php endif ?>

        <!-- Botón página testimonios -->

        <li class="nav-item">

          <a href="testimonios" class="nav-link">

            <i class="nav-icon fas fa-user-check"></i>

            <p>TESTIMONIOS</p>

          </a>

        </li>

        <!-- Botón página usuarios -->

         <?php if ($admin["perfil"] == "Administrador"): ?>

         <li class="nav-item">
          
          <a href="usuarios" class="nav-link">
            
            <i class="nav-icon fas fa-users"></i>
            
            <p> USUARIOS</p>

          </a>

        </li>

          <?php endif ?>

        <!-- Botón página recorrido -->

         <li class="nav-item">

          <a href="recorrido" class="nav-link">

            <i class="nav-icon fas fa-bus"></i>

            <p>RECORRIDO</p>

          </a>

        </li>

        <!-- Botón página restaurante -->

        <li class="nav-item">
          
          <a href="restaurante" class="nav-link">
            
            <i class="nav-icon fas fa-utensils"></i>
            
            <p>RESTAURANTE</p>

          </a>

        </li>

         <!-- Botón página restaurante -->

        <li class="nav-item">
          
          <a href="cerrar-sesion" class="nav-link">
            
            <i class="nav-icon  fa fa-power-off"></i>
            
            <p>SALIR DEL SISTEMA</p>

          </a>

        </li>

      </ul>

    </nav>
  
  </div>

</aside>