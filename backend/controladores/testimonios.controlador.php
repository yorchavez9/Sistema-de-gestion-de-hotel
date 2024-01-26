<?php

class ControladorTestimonios{

	/*=============================================
			MOSTRAR TESTIMONIOS
	=============================================*/

	static public function ctrMostrarTestimonios($item, $valor){

		$tabla = "testimonios";

		$respuesta = ModeloTestimonios::mdlMostrarTestimonios($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR TESTIMONIOS-RESERVAS-USUARIOS CON INNER JOIN
	=============================================*/

	static public function ctrMostrarTestimoniosInnerJoin($item, $valor){

		$tabla1 = "testimonios";
		$tabla2 = "reservas";
		$tabla3 = "usuarios";

		$respuesta = ModeloTestimonios::mdlMostrarTestimoniosInnerJoin($tabla1, $tabla2, $tabla3, $item, $valor);

		return $respuesta;

	}

}