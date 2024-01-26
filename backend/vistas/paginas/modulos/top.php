<?php 

/*=============================================
Sumar ventas
=============================================*/

$sumaVentas = ControladorInicio::ctrSumarVentas();

/*=============================================
Total Reservas
=============================================*/

$totalReservas = ControladorReservas::ctrMostrarReservas(null, null);

/*=============================================
Total Usuarios
=============================================*/

$totalUsuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

/*=============================================
Total Testimonios
=============================================*/

$totalTestimonios = ControladorTestimonios::ctrMostrarTestimonios(null, null);

?>

<!--=====================================
		Sumar ventas
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-success">

    <div class="inner">

      <h3>S/ <span><?php echo number_format($sumaVentas["total"], 0, ",", "."); ?></span></h3>

      <p class="text-uppercase"><strong>VENTAS TOTALES</strong></p>

    </div>

    <div class="icon">

      <i class="fas fa-dollar-sign"></i>

    </div>

    <a href="reservas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div>

<!--=====================================
			Total Reservas
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-primary">

    <div class="inner">

      <h3><?php echo count($totalReservas); ?></h3>

      <p class="text-uppercase"><strong>RESERVAS</strong></p>

    </div>

    <div class="icon">

      <i class="far fa-calendar-alt"></i>

    </div>

    <a href="reservas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div>

<!--=====================================
			Total Usuarios
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-warning">

    <div class="inner">

      <h3><?php echo count($totalUsuarios); ?></h3>

      <p class="text-uppercase"><strong>USUARIOS</strong></p>

    </div>

    <div class="icon">

      <i class="fas fa-users"></i>

    </div>

    <a href="usuarios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div>

<!--=====================================
			Total Testimonios
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-danger">

    <div class="inner">

      <h3><?php echo count($totalTestimonios); ?></h3>

      <p class="text-uppercase"><strong>TESTIMONIOS</strong></p>

    </div>

    <div class="icon">

      <i class="fas fa-user-check"></i>

    </div>

    <a href="testimonios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div> 


