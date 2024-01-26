<div class="content-wrapper" style="min-height: 717px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PAGINA DE RESTAURANTE</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">INICIO</a></li>
            <li class="breadcrumb-item active">GESTOR RESTAURANTE</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <div class="card card-primary card-outline">
       
       <div class="card-header pl-2 pl-sm-3">
        
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearRestaurante">CREAR NUEVO PLATO DE RESTAURANTE</button>

      </div>

      <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaRestaurante" width="100%">
        
          <thead>

            <tr>

              <th style="width:10px">#</th> 
              <th>IMG</th>
              <th>DESCRIPCION</th>
              <th style="width:100px">ACCIONES</th>          

            </tr>   

          </thead>

          <tbody>

           <!-- <tr>
              
              <td>1</td>
               
              <td>
                 <img src="vistas/img/restaurante/plato01.png" class="img-fluid rounded-circle" width="100px">
              </td> 

              <td>
                Lorem ipsum dolor sit amet consectetur.
              </td> 
  
              <td>
                <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt text-white"></i></button>  
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>  
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

<!--=====================================
Modal Crear Restaurante
======================================-->

<div class="modal" id="crearRestaurante">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">Crear Restaurante</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen del plato

                <input type="file" name="subirImgRestaurante">
               
            </div>

            <br>

            <img class="previsualizarImgRestaurante img-fluid py-2">

             <p class="help-block small">Dimensiones: 169px x 169px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>  

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="40" name="descripcionRestaurante" placeholder="Ingresa la descripción del Plato" required></textarea>

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

        $registroRestaurante = new ControladorRestaurante();
        $registroRestaurante -> ctrRegistroRestaurante();

      ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
Modal Editar Restaurante
======================================-->

<div class="modal" id="editarRestaurante">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">Editar Restaurante</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <input type="hidden" class="form-control" name="idRestaurante">

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen del plato

                <input type="file" name="editarImgRestaurante">

                 <input type="hidden" name="imgRestauranteActual">
               
            </div>

            <br>

            <img class="previsualizarImgRestaurante img-fluid py-2">

             <p class="help-block small">Dimensiones: 169px x 169px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>  

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="40" name="editarDescripcionRestaurante" required></textarea>

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

        $EditarRestaurante = new ControladorRestaurante();
        $EditarRestaurante -> ctrEditarRestaurante();

      ?>

      </form>

    </div>

  </div>

</div>