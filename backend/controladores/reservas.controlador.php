<?php

class ControladorReservas{

		/*=============================================
	MOSTRAR USUARIOS-RESERVAS CON INNER JOINs
	=============================================*/

	static public function ctrMostrarReservas($item, $valor){

		$tabla1 = "usuarios";
		$tabla2 = "reservas";

		$respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				Cambiar Reserva
	=============================================*/

	static public function ctrCambiarReserva($datos){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlCambiarReserva($tabla, $datos);

		return $respuesta;

	}

}