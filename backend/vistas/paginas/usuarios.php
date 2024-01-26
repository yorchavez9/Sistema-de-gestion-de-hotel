<?php 

  if($admin["perfil"] != "Administrador"){

    echo '<script>

      window.location = "banner";

    </script>';

    return;

  }

 ?>

<div class="content-wrapper" style="min-height: 717px;">
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PAGINA DE GESTOR DE USUARIOS</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">INICIO</a></li>
            <li class="breadcrumb-item active">GESTOR USUARIOS</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
 <section class="content">

    <div class="card card-primary card-outline">

      <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">
        
          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>FOTO</th> 
              <th>NOMBRE</th>
              <th>EMAIL</th>
              <th>RESERVAS</th> 
              <th>TESTIMONIOS</th>     

            </tr>   

          </thead>

          <tbody>

            <tr>
              
              <td>1</td>

              <td>
                <img src="vistas/img/usuarios/3/279.png" class="rounded-circle" width="50px">
              </td> 
              
              <td>
                Juan Fernando Urrego
              </td> 

              <td>
                correotutorialesatualcance@gmail.com
              </td>            

              <td>
                3
              </td> 

              <td>
                1
              </td> 

            </tr> 

          </tbody>

        </table>

      </div>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>