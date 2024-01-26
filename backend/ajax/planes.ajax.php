<?php

require_once "../controladores/planes.controlador.php";
require_once "../modelos/planes.modelo.php";

class AjaxPlanes{

	/*=============================================
				Editar Planes
	=============================================*/	

	public $idPlan;

	public function ajaxMostrarPlanes(){

		$respuesta = ControladorPlanes::ctrMostrarPlanes("id", $this->idPlan);

		echo json_encode($respuesta);

	}

	/*=============================================
	Eliminar Plan
	=============================================*/	

	public $idEliminar;
	public $imgPlan;

	public function ajaxEliminarPlan(){

		$respuesta = ControladorPlanes::ctrEliminarPlan($this->idEliminar, $this->imgPlan);

		echo $respuesta;

	}

}

/*=============================================
			Editar Planes
=============================================*/	

if(isset($_POST["idPlan"])){

	$editar = new AjaxPlanes();
	$editar -> idPlan = $_POST["idPlan"];
	$editar -> ajaxMostrarPlanes();

}

/*=============================================
Eliminar Plan
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxPlanes();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> imgPlan = $_POST["imgPlan"];
	$eliminar -> ajaxEliminarPlan();

}