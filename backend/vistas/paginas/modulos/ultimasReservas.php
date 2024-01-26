<?php 

$reservas = ControladorReservas::ctrMostrarReservas(null, null);


?>


<div class="card card-danger card-outline">

  <div class="card-header">

    <h3 class="card-title"><strong>ULTIMAS RESERVAS</strong></h3>

  </div>
  <!-- /.card-header -->

  <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">

      <?php foreach (limit($reservas, 3) as $key => $value): ?>

        <?php if ($value["foto"] != ""){

          $foto = $value["foto"];

        }else{

          $foto = "vistas/img/usuarios/default/default.png";

        }

        ?>

       <li class="item">
        <div class="product-img">
            <img src="<?php echo $foto?>" alt="Product Image" class="img-size-50 rounded-circle">
        </div>
        <div class="product-info">
          <h6 class="product-title"><?php echo $value["codigo_reserva"]." - ".$value["nombre"]; ?></h6>
            <span class="product-description">
              <?php echo $value["descripcion_reserva"]; ?>
            </span>
          </div>
        </li>

      <?php endforeach ?>

      </ul>
  </div>
      <!-- /.card-body -->
  <div class="card-footer text-right">
    <a href="reservas" class="btn btn-info mt-3">VER RESERVAS</a>
  </div>
      <!-- /.card-footer -->
</div>