<?php 

  if($admin["perfil"] != "Administrador"){

    echo '<script>

      window.location = "banner";

    </script>';

    return;

  }

if(isset($_GET["not"])){

  $respuesta = ControladorInicio::ctrActualizarNotificaciones("reservas", 0);

}

 ?>

 <div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>PAGINA DE RESERVAS</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">INICIO</a></li>
              <li class="breadcrumb-item active">RESERVAS</li>

            </ol>

          </div>

        </div>

      </div>

    </section>

  <!--=====================================
        Módulo de gráfico de ventas
  ======================================-->

  <?php 

    include "modulos/ventas.php";
    
   ?>

    <section class="content">

      <!-- Default box -->
      <div class="card card-warning card-outline">


        <div class="card-body">

         <table class="table table-bordered table-striped dt-responsive tablaReservas" width="100%">
           
            <thead>

                <tr>

                  <th style="width:10px">#</th> 
                  <th>CODIGO</th>
                  <th>DESCRIPCION</th>
                  <th>USUARIO</th>
                  <th>PAGO</th>
                  <th>TRANSACCION</th> 
                  <th>INGRESO</th> 
                  <th>SALIDA</th>           
                  <th style="width:100px">ACCIONES</th>          

                </tr>   

              </thead>

              <tbody>
              
               <!--<tr>

                  <td>1</td>
                  <td>6NJS06V8L</td>
                  <td>Habitación Suite Oriental - Plan Continental - 2 personas</td>
                  <td>Felipe Trujillo</td> 
                  <td>S/ <?php echo number_format(900, 0, ",", "."); ?></td>
                  <td>19680828</td> 
                  <td>2020-08-17</td>
                  <td>2020-08-20</td>  
                  <td>             
                      <button class="btn btn-warning btn-sm"><i class="fas fa-edit text-white"></i></button>  
                      <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>  

                  </td> 

                </tr>-->

              </tbody>

         </table>
        
        </div>

      </div>

    </section>

  </div>

<!--=====================================
      Modal Editar Reserva
======================================-->

<div class="modal" id="editarReserva">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">EDITAR RESERVA: <span class="small"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

       <!-- Modal body -->
      <div class="modal-body">

        <h6 class="lead pt-4 pb-2"><strong>PUEDE MODIFICAR LA FECHA DE ACUERDO A LOS DIAS DISPONIBLES:</strong></h6>

        <div class="container mb-3">

          <div class="row py-2" style="background:#509CC3">

             <div class="col-6 col-md-3 input-group pr-1">
            
              <input type="text" class="form-control datepicker entrada" autocomplete="off" placeholder="Entrada" value=""  required>

              <div class="input-group-append">
                
                <span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
              
              </div>

            </div>

            <div class="col-6 col-md-3 input-group pl-1">
            
              <input type="text" class="form-control datepicker salida" readonly required>

              <div class="input-group-append">
                
                <span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
              
              </div>

            </div>

            <div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
                            
              <button class="btn btn-block btn-md text-white verDisponibilidad" idHabitacion style="background:black">VER DISPONIBILIDAD</button>

            </div>

          </div>

        </div>

        <div class="bg-white p-4 calendarioReservas">

          <div class="infoDisponibilidad">
            <h1 class="pb-5 float-left infoDisponibilidad">!ESTA DISPONIBLE!</h1>
          </div>

          <div class="float-right pb-3">
              
            <ul style="list-style:none">
              <li>
                <i class="fas fa-square-full" style="color:#847059"></i> NO DISPONIBLE
              </li>

              <li>
                <i class="fas fa-square-full" style="color:#eee"></i> DISPONIBLE
              </li>

              <li>
                <i class="fas fa-square-full" style="color:#F08080"></i> TU RESERVA
              </li>
            </ul>

          </div>

        </div>

        <div class="clearfix"></div>

        <div class="agregarCalendario p-3"></div>

      </div>

       <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-between">

        <div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        </div>

        <div>
          <button type="button" class="btn btn-primary guardarNuevaReserva" fechaIngreso fechaSalida idReserva>GUARDAR</button>
        </div>

      </div>

    </div>

  </div>

</div>