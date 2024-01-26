<?php

class ControladorInicio{

	/*=============================================
				SUMAR VENTAS
	=============================================*/

	static public function ctrSumarVentas(){

		$tabla = "reservas";

		$respuesta = ModeloInicio::mdlSumarVentas($tabla);
		
		return $respuesta;

	}	

	/*=============================================
					MEJOR HABITACIÓN
	=============================================*/

	static public function ctrMejorHabitacion(){

		$tabla = "reservas";

		$respuesta = ModeloInicio::mdlMejorHabitacion($tabla);
		
		return $respuesta;

	}	

	/*=============================================
					PEOR HABITACIÓN
	=============================================*/

	static public function ctrPeorHabitacion(){

		$tabla = "reservas";

		$respuesta = ModeloInicio::mdlPeorHabitacion($tabla);
		
		return $respuesta;

	}	

	/*=============================================
	TRAER FOTO HABITACIÓN
	=============================================*/

	static public function ctrTraerFotoHabitacion($valor){

		$tabla1 = "reservas";
		$tabla2 = "habitaciones";

		$respuesta = ModeloInicio::mdlTraerFotoHabitacion($tabla1, $tabla2, $valor);
		
		return $respuesta;

	}	

	/*=============================================
	Mostrar notificaciones
	=============================================*/

	static public function ctrMostrarNotificaciones(){

		$tabla = "notificaciones";

		$respuesta = ModeloInicio::mdlMostrarNotificaciones($tabla);
		
		return $respuesta;

	}	

	/*=============================================
	Actualizar notificaciones
	=============================================*/

	static public function ctrActualizarNotificaciones($tipo, $cantidad){

		$tabla = "notificaciones";

		$respuesta = ModeloInicio::mdlActualizarNotificaciones($tabla, $tipo, $cantidad);
		
		return $respuesta;

	}	


}