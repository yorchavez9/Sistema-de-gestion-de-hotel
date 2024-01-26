<?php 

$traerReservas = ControladorReservas::ctrMostrarReservas(null, null);

$descripcion = array();
$fechaIngreso = array();
$fechaSalida = array();

foreach ($traerReservas as $key => $value) {
	
	array_push($descripcion, $value["descripcion_reserva"]);	
	array_push($fechaIngreso, $value["fecha_ingreso"]);
	array_push($fechaSalida, $value["fecha_salida"]);
}

?>


<div class="card card-primary card-outline">

	<div class="card-header">

		<h5 class="m-0"><strong>RESERVAS DEL MES</strong></h5>

	</div>

	<div class="card-body">

		<div id="calendarIndex"></div>

		<a href="reservas" class="btn btn-primary mt-3">VER RESERVAS</a>

	</div>

</div>

<script>

var fechaActual = new Date();
var mes = ("0"+Number(fechaActual.getMonth()+1)).slice(-2);
var dia = ("0"+fechaActual.getDate()).slice(-2);
	
	 $('#calendarIndex').fullCalendar({
	    defaultDate:fechaActual.getFullYear()+"-"+mes+"-"+dia,
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        events:[

		<?php

			for($i = 0; $i < count($descripcion); $i++){

				echo '{"title":"'.$descripcion[$i].'",
					   "start":"'.$fechaIngreso[$i].'",
					   "end":"'.$fechaSalida[$i].'",
					   "color": "#FFCC29"},';

			}

		?>

        ]


      });


</script>
