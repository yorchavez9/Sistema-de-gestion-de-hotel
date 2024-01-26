<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class AjaxBanner{

	/*=============================================
				Editar Banner
	=============================================*/	

	public $idBanner;

	public function ajaxMostrarBanner(){

		$respuesta = ControladorBanner::ctrMostrarBanner("id", $this->idBanner);

		echo json_encode($respuesta);

	}

	/*=============================================
				Eliminar Banner
	=============================================*/	

	public $idEliminar;
	public $rutaBanner;

	public function ajaxEliminarBanner(){

		$respuesta = ControladorBanner::ctrEliminarBanner($this->idEliminar, $this->rutaBanner);

		echo $respuesta;

	}


}

/*=============================================
		Editar Banner
=============================================*/	

if(isset($_POST["idBanner"])){

	$editar = new AjaxBanner();
	$editar -> idBanner = $_POST["idBanner"];
	$editar -> ajaxMostrarBanner();

}

/*=============================================
			Eliminar Banner
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxBanner();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> rutaBanner = $_POST["rutaBanner"];
	$eliminar -> ajaxEliminarBanner();

}