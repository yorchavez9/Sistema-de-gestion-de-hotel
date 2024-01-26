<?php

require_once "../controladores/recorrido.controlador.php";
require_once "../modelos/recorrido.modelo.php";

class AjaxRecorrido{

	/*=============================================
					Editar Recorrido
	=============================================*/	

	public $idRecorrido;

	public function ajaxMostrarRecorrido(){

		$respuesta = ControladorRecorrido::ctrMostrarRecorrido("id", $this->idRecorrido);

		echo json_encode($respuesta);

	}

	/*=============================================
				Eliminar Recorrido
	=============================================*/	

	public $idEliminar;
	public $imgPeqRecorrido;
	public $imgGrandeRecorrido;

	public function ajaxEliminarRecorrido(){

		$respuesta = ControladorRecorrido::ctrEliminarRecorrido($this->idEliminar, $this->imgPeqRecorrido, $this->imgGrandeRecorrido);

		echo $respuesta;

	}
}

/*=============================================
			Editar Recorrido
=============================================*/	

if(isset($_POST["idRecorrido"])){

	$editar = new AjaxRecorrido();
	$editar -> idRecorrido = $_POST["idRecorrido"];
	$editar -> ajaxMostrarRecorrido();

}

/*=============================================
			Eliminar Recorrido
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxRecorrido();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> imgPeqRecorrido = $_POST["imgPeqRecorrido"];
	$eliminar -> imgGrandeRecorrido = $_POST["imgGrandeRecorrido"];
	$eliminar -> ajaxEliminarRecorrido();

}