 <div class="content-wrapper" style="min-height: 717px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PAGINA DE GESTOR DE RECORRIDOS</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">INICIO</a></li>
            <li class="breadcrumb-item active">GESTOR RECORRIDO</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="card card-primary card-outline">
       
       <div class="card-header pl-2 pl-sm-3">
        
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearRecorrido">CREAR NUEVO RECORRIDO</button>

      </div>

      <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaRecorrido" width="100%">
        
          <thead>

            <tr>

              <th style="width:10px">#</th> 
              <th>TITULO</th>
              <th>DESCRIPCION</th>
              <th>FOTO GRANDE</th>
              <th>FOTO PEQUEÑA</th>
              <th style="width:100px">ACCIONES</th>          

            </tr>   

          </thead>

          <tbody>

             <!--<tr>
              
              <td style="width:10px">1</td>
               
              <td>
                LOREM IPSUM
              </td> 

              <td>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas suscipit quis eligendi voluptatibus dolore libero quasi delectus odit impedit optio eius corporis cumque numquam aliquid repudiandae quisquam dolor explicabo, totam.
              </td> 

              <td>
                <img src="vistas/img/recorrido/pueblo01b.png" class="img-fluid">
              </td> 

              <td>
                <img src="vistas/img/recorrido/pueblo01a.png" class="img-fluid">
              </td> 
               
              <td>
                <button class="btn btn-warning btn-sm"><i class="fas fa-edit text-white"></i></button>  
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>  
              </td>

            </tr> -->

          </tbody>

        </table>

      </div>
    </div>

  </section>

</div>

<!--=====================================
    Modal Crear Recorrido
======================================-->

<div class="modal" id="crearRecorrido">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">CREAR RECORRIDO</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="input-group mb-3">
         
          <div class="input-group-append input-group-text">
            <span class="fas fa-suitcase-rolling"></span>
          </div>

          <input type="text" class="form-control" name="tituloRecorrido" placeholder="Ingresa el título del Recorrido" required> 

        </div>

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="220" name="descripcionRecorrido" placeholder="Ingresa la descripción del recorrido" required></textarea>

        </div>

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen Pequeña del Recorrido 

                <input type="file" name="subirImgPeqRecorrido">
               
            </div>

            <img class="previsualizarImgPeqRecorrido img-fluid py-2">

             <p class="help-block small">Dimensiones: 455px x 280px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen Grande del Recorrido 

                <input type="file" name="subirImgGrandeRecorrido">
               
            </div>

            <img class="previsualizarImgGrandeRecorrido img-fluid py-2">

             <p class="help-block small">Dimensiones: 650px x 450px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

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

        $registroRecorrido = new ControladorRecorrido();
        $registroRecorrido -> ctrRegistroRecorrido();

      ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
      Modal Editar Recorrido
======================================-->

<div class="modal" id="editarRecorrido">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">EDITAR RECORRIDO</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <input type="hidden" class="form-control" name="idRecorrido">

        <div class="input-group mb-3">
         
          <div class="input-group-append input-group-text">
            <span class="fas fa-suitcase-rolling"></span>
          </div>

          <input type="text" class="form-control" name="editarRecorrido" required> 

        </div>

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="220" name="editarDescripcionRecorrido" required></textarea>

        </div>

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen Pequeña del Recorrido 

                <input type="file" name="editarImgPeqRecorrido">

                <input type="hidden" name="imgPeqRecorridoActual">
               
            </div>

            <img class="previsualizarImgPeqRecorrido img-fluid py-2">

             <p class="help-block small">Dimensiones: 455px x 280px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen Grande del Recorrido 

                <input type="file" name="editarImgGrandeRecorrido">

                <input type="hidden" name="imgGrandeRecorridoActual">
               
            </div>

            <img class="previsualizarImgGrandeRecorrido img-fluid py-2">

             <p class="help-block small">Dimensiones: 650px x 450px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

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

        $editarRecorrido = new ControladorRecorrido();
        $editarRecorrido -> ctrEditarRecorrido();

      ?>

      </form>

    </div>

  </div>

</div>