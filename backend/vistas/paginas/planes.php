<div class="content-wrapper" style="min-height: 864.156px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>PAGINA DE PLANES</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">INICIO</a></li>
              <li class="breadcrumb-item active">PLANES</li>

            </ol>

          </div>

        </div>

      </div>

    </section>

    <section class="content">

      <!-- Default box -->
      <div class="card card-warning card-outline">

        <div class="card-header">

         <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearPlan">CREAR NUEVO PLAN</button>  


       </div>
            <!-- /.card-header -->

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablaPlanes" width="100%">

                <thead>

                  <tr>

                    <th style="width:10px">#</th> 
                    <th>TITULO</th>
                    <th>IMAGEN</th>
                    <th>DESRIPCION</th>
                    <th>S/TEMP. ALTA</th>
                    <th>S/TEMP. BAJA</th>
                    <th>ACCIONES</th>          

                  </tr>   

                </thead>

                <tbody>
                  
                  <!-- <tr>
              
                    <td>1</td>

                    <td>
                      Romántico
                    </td> 

                    <td>
                      <img src="vistas/img/planes/plan-romantico.png" class="img-fluid">
                    </td>

                    <td>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas suscipit quis eligendi voluptatibus dolore libero quasi delectus odit impedit optio eius corporis cumque numquam aliquid repudiandae quisquam dolor explicabo, totam.
                    </td> 

                    <td>S/ <?php echo number_format(500)?></td>
                    <td>S/ <?php echo number_format(400)?></td>

                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit text-white"></i></button>  
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                      </div>  
                    </td>

                  </tr>-->

                </tbody>



              </table>
              
            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->

</div>

<!--=====================================
          Modal Crear Plan
======================================-->

<div class="modal" id="crearPlan">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!-- Modal Header -->
        <div class="modal-header bg-info">
          <h4 class="modal-title">CREAR PLAN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-suitcase-rolling"></span>
            </div>

            <input type="text" class="form-control" name="tipoPlan" placeholder="Ingresa el nombre del plan" required> 

          </div>

          <div class="form-group">

            <div class="form-group my-2">

              <div class="btn btn-default btn-file">

                  <i class="fas fa-paperclip"></i> Adjuntar imagen del plan

                  <input type="file" name="subirImgPlan">
                 
              </div>

              <img class="previsualizarImgPlan img-fluid py-2">

               <p class="help-block small">Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>

            <p>ESCRIBA LA DESCRIPCION DEL PLAN:</p>

            <textarea id="descripcionPlan" name="descripcionPlan" style="width: 100%"></textarea>

          </div>

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-money-bill-alt"></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="precio_alta" placeholder="Precio temporada alta" required> 

          </div>

           <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-money-bill-alt"></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="precio_baja" placeholder="Precio temporada baja" required> 

          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>

        </div>

        <?php

          $registroPlan = new ControladorPlanes();
          $registroPlan -> ctrRegistroPlan();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
      Modal Editar Plan
======================================-->

<div class="modal" id="editarPlan">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!-- Modal Header -->
        <div class="modal-header bg-info">
          <h4 class="modal-title">EDITAR PLAN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <input type="hidden" class="form-control" name="idPlan">

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-suitcase-rolling"></span>
            </div>

            <input type="text" class="form-control" name="editarPlan" required> 

          </div>

          <div class="form-group">

            <div class="form-group my-2">

              <div class="btn btn-default btn-file">

                  <i class="fas fa-paperclip"></i> Cambiar imagen del plan 

                  <input type="file" name="editarImgPlan">

                  <input type="hidden" name="imgPlanActual">
                 
              </div>

              <img class="previsualizarImgPlan img-fluid py-2">

               <p class="help-block small">Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>

            <p>ESCRIBA LA DESCRIPCION DEL PLAN:</p>

            <textarea id="editarDescripcionPlan" name="editarDescripcionPlan" style="width: 100%"></textarea>

          </div>

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span><i>S/</i></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="editar_precio_alta" required> 

          </div>

           <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span><i>S/</i></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="editar_precio_baja" required> 

          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>

        </div>

        <?php

          $editarPlan = new ControladorPlanes();
          $editarPlan -> ctrEditarPlan();

        ?>

      </form>

    </div>

  </div>

</div>
