<?php

require_once "../controladores/restaurante.controlador.php";
require_once "../modelos/restaurante.modelo.php";

class AjaxRestaurante{

	/*=============================================
	Editar Restaurante
	=============================================*/	

	public $idRestaurante;

	public function ajaxMostrarRestaurante(){

		$respuesta = ControladorRestaurante::ctrMostrarRestaurante("id", $this->idRestaurante);

		echo json_encode($respuesta);

	}

	/*=============================================
	Eliminar Restaurante
	=============================================*/	

	public $idEliminar;
	public $imgRestaurante;


	public function ajaxEliminarRestaurante(){

		$respuesta = ControladorRestaurante::ctrEliminarRestaurante($this->idEliminar, $this->imgRestaurante);

		echo $respuesta;

	}
}

/*=============================================
Editar Restaurante
=============================================*/	

if(isset($_POST["idRestaurante"])){

	$editar = new AjaxRestaurante();
	$editar -> idRestaurante = $_POST["idRestaurante"];
	$editar -> ajaxMostrarRestaurante();

}

/*=============================================
Eliminar Restaurante
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxRestaurante();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> imgRestaurante = $_POST["imgRestaurante"];
	$eliminar -> ajaxEliminarRestaurante();

}