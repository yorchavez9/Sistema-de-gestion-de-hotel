<?php

require_once "../controladores/testimonios.controlador.php";
require_once "../modelos/testimonios.modelo.php";

class AjaxTestimonios{


	/*=============================================
	Aprobar o desaprobar testimonio
	=============================================*/	

	public $idTestimonio;
	public $estadoTestimonio;

	public function ajaxAprobarTestimonio(){

		$tabla = "testimonios";

		$item1 = "id_testimonio";
		$valor1 = $this->idTestimonio;

		$item2 = "aprobado";
		$valor2 = $this->estadoTestimonio;

		$respuesta = ModeloTestimonios::mdlAprobarTestimonio($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

}


/*=============================================
		Activar o desactivar Testimonio
=============================================*/	

if(isset($_POST["estadoTestimonio"])){

	$aprobarTestimonios = new AjaxTestimonios();
	$aprobarTestimonios -> idTestimonio = $_POST["idTestimonio"];
	$aprobarTestimonios -> estadoTestimonio = $_POST["estadoTestimonio"];
	$aprobarTestimonios -> ajaxAprobarTestimonio();

}
