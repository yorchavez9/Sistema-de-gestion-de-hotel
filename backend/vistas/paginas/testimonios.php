<?php 

if(isset($_GET["not"])){

  $respuesta = ControladorInicio::ctrActualizarNotificaciones("testimonios", 0);

}

?>

<div class="content-wrapper" style="min-height: 717px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PAGINA DE GESTOR DE TESTIMONIOS</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">INICIO</a></li>
            <li class="breadcrumb-item active">GESTOR TESTIMONIO</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
 <section class="content">

    <div class="card card-primary card-outline">

      <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaTestimonios" width="100%">
        
          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>RESERVA</th>
              <th>USUARIO</th> 
              <th>HABITACION</th>
              <th>TESTIMONIO</th> 
              <th>ESTADO</th>
              <th>FECHA</th>     

            </tr>   

          </thead>

          <tbody>

           <!-- <tr>
              
              <td>1</td>

              <td>
                ZLMAOP6C0
              </td> 

              <td>
                Juan Fernando Urrego
              </td>           

              <td>
                Habitación Suite Oriental - Plan Americano - 2 personas
              </td>            

              <td>
                Fue una experiencia maravillosa
              </td> 

              <td>
                <button class="btn btn-success btn-sm">APROBAR</button>
              </td> 

              <td>
                2020-05-14 19:35:52
              </td> 

            </tr> -->

          </tbody>

        </table>

      </div>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>