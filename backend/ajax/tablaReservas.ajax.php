<?php

require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";

class TablaReservas{

	/*=============================================
					Tabla Reservass
	=============================================*/ 

	public function mostrarTabla(){

		$reservas = ControladorReservas::ctrMostrarReservas(null, null);

		if(count($reservas)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($reservas as $key => $value) {
			
			/*=============================================
						ACCIONES
			=============================================*/

			$fechaIngreso = new DateTime($value["fecha_ingreso"]);
			$fechaSalida = new DateTime($value["fecha_salida"]);
			$diff = $fechaIngreso->diff($fechaSalida);
			$dias = $diff->days;

			if($value["fecha_ingreso"] != "0000-00-00" && $value["fecha_salida"] != "0000-00-00"){

				$acciones = "<button class='btn btn-warning btn-sm editarReserva' data-toggle='modal' data-target='#editarReserva' idReserva='".$value["id_reserva"]."' idHabitacion='".$value["id_habitacion"]."' fechaIngreso='".$value["fecha_ingreso"]."' fechaSalida='".$value["fecha_salida"]."' descripcion='".$value["descripcion_reserva"]."' diasReserva='".$dias."'><i class='fas fa-edit text-white'></i></button><button class='btn btn-danger btn-sm eliminarReserva' idReserva='".$value["id_reserva"]."'><i class='fas fa-trash-alt'></i></button>";	

		

			}else{

				$acciones = "<button class='btn btn-dark btn-sm'>CANCELADA</button>";	
			}


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["codigo_reserva"].'",
						"'.$value["descripcion_reserva"].'",
						"'.$value["nombre"].'",
						"S/ '.number_format($value["pago_reserva"],  0, ",", ".").'",
						"'.$value["numero_transaccion"].'",
						"'.$value["fecha_ingreso"].'",
						"'.$value["fecha_salida"].'",
						"'.$acciones.'"
						
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
				Tabla Reservas
=============================================*/ 

$tabla = new TablaReservas();
$tabla -> mostrarTabla();
