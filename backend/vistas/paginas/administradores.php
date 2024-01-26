<?php 

  if($admin["perfil"] != "Administrador"){

    echo '<script>

      window.location = "inicio";

    </script>';

    return;

  }

 ?>
 
<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>PAGINA DE ADMINISTRADORES</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">INICIO</a></li>
              <li class="breadcrumb-item active">ANALISIS</li>

            </ol>

          </div>

        </div>

      </div>

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

      <div class="card card-success card-outline">

        <div class="card-header">

       <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearAdministrador">
       CREAR NUEVO ADMINISTRADOR</button>


        </div>

        <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%">
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>NOMBRE</th>
                <th>USUARIO</th>
                <th>PERFIL</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>

              </tr>

            </thead>

            <tbody>
              
              <tr>
                
                <td>1</td>
                <td>Hotel Paracas</td>
                <td>paracas</td>
                <td>Administrador</td>
                <td><button class="btn btn-info btn-sm">ACTIVO</button></td>
                <td>
                      
                        <button class="btn btn-warning btn-sm">
                          <i class="fas fa-edit text-white"></i>
                        </button>  

                        <button class="btn btn-danger btn-sm">
                          <i class="fas fa-trash-alt"></i>
                        </button> 

             

                  </td>

              </tr>

            </tbody>

          </table>

        </div>

        <div class="card-footer">


        </div>

      </div>

    </div>

  </div>

</section>

</div>

<!--=====================================
      Modal Crear Administrador
======================================-->

<div class="modal" id="crearAdministrador">

  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post">
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">CREAR ADMINISTRADOR</h4>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

          <!-- input nombre -->
          
          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user"></span>

            </div>

            <input type="text" class="form-control" name="registroNombre" placeholder="Ingresa el nombre" required>   

          </div>

          <!-- input usuario -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user-lock"></span>

            </div>

            <input type="text" class="form-control" name="registroUsuario" placeholder="Ingresa el usuario" required>   

          </div>

          <!-- input password -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-lock"></span>

            </div>

            <input type="password" class="form-control" name="registroPassword" placeholder="Ingresa la contraseña" required>   

          </div>

           <!-- seleccionar el perfil -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              
              <span class="fas fa-key"></span>
            
            </div>

            <select class="form-control" name="registroPerfil" required>

              <option value="">SELECCIONE PERFIL</option>

              <option value="Administrador">ADMINISRADOR</option>

              <option value="Empleado">EMPLEADO</option>

            </select>     

          </div>

           <?php 

             $registroAdministrador = new ControladorAdministradores();
             $registroAdministrador -> ctrRegistroAdministrador();

           ?>

        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          </div>

          <div>
             <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
    Modal Editar Administrador
======================================-->

<div class="modal" id="editarAdministrador">

  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post">
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">EDITAR ADMINISTRADOR</h4>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

          <input type="hidden" name="editarId">

          <!-- input nombre -->
          
          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user"></span>

            </div>

            <input type="text" class="form-control" name="editarNombre" value required>   

          </div>

          <!-- input usuario -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user-lock"></span>

            </div>

            <input type="text" class="form-control" name="editarUsuario" value required>   

          </div>

          <!-- input password -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-lock"></span>

            </div>

            <input type="password" class="form-control" name="editarPassword" placeholder="Cambie la contraseña"> 
            <input type="hidden" name="passwordActual">     

          </div>

           <!-- seleccionar el perfil -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              
              <span class="fas fa-key"></span>
            
            </div>

            <select class="form-control" name="editarPerfil" required>

              <option class="editarPerfilOption"></option>

              <option value="">SELECCIONE PERFIL</option>

              <option value="Administrador">ADMINISTRADOR</option>

              <option value="Empleado">EMPLEADO</option>

            </select>     

          </div>

            <?php 

             $editarAdministrador = new ControladorAdministradores();
             $editarAdministrador -> ctrEditarAdministrador();

           ?>


        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          </div>

          <div>
             <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>

        </div>

      </form>

    </div>

  </div>

</div>