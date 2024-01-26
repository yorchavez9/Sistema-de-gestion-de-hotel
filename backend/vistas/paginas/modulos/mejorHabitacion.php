<?php 

$mejorHabitacion = ControladorInicio::ctrMejorHabitacion();

$traerFoto = ControladorInicio::ctrTraerFotoHabitacion($mejorHabitacion["mejor"]);

$traerFotoArray = json_decode($traerFoto["galeria"], true);

?>


<div class="card card-success card-outline">

	<div class="card-header">
		<h5 class="m-0"><strong>HABITACION MAS RESERVADA</strong></h5>
	</div>

	<div class="card-body">

		<img src="<?php echo $traerFotoArray[0]; ?>" class="img-thumbnail">

		<h6 class="card-title py-3"><?php echo $mejorHabitacion["mejor"]; ?></h6>

		<a href="reservas" class="btn btn-success">VER RESERVAS</a>

	</div>

</div>