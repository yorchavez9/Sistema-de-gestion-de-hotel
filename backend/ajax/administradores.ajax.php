<?php

require_once "../controladores/administradores.controlador.php";
require_once "../modelos/administradores.modelo.php";

class AjaxAdministradores{

	/*=============================================
			Editar Administrador
	=============================================*/	

	public $idAdministrador;

	public function ajaxMostrarAdministradores(){

		$item = "id";
		$valor = $this->idAdministrador;

		$respuesta = ControladorAdministradores::ctrMostrarAdministradores($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
		Activar o desactivar administrador
	=============================================*/	

	public $idAdmin;
	public $estadoAdmin;

	public function ajaxActivarAdministrador(){

		$tabla = "administradores";

		$item1 = "id";
		$valor1 = $this->idAdmin;

		$item2 = "estado";
		$valor2 = $this->estadoAdmin;

		$respuesta = ModeloAdministradores::mdlActualizarAdministrador($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
				Eliminar Administrador
	=============================================*/	

	public $idEliminar;

	public function ajaxEliminarAdministrador(){

		$respuesta = ControladorAdministradores::ctrEliminarAdministrador($this->idEliminar);

		echo $respuesta;

	}

}

/*=============================================
			Editar Administrador
=============================================*/
if(isset($_POST["idAdministrador"])){

	$editar = new AjaxAdministradores();
	$editar -> idAdministrador = $_POST["idAdministrador"];
	$editar -> ajaxMostrarAdministradores();

}

/*=============================================
		Activar o desactivar administrador
=============================================*/	

if(isset($_POST["estadoAdmin"])){

	$activarAdmin = new AjaxAdministradores();
	$activarAdmin -> idAdmin = $_POST["idAdmin"];
	$activarAdmin -> estadoAdmin = $_POST["estadoAdmin"];
	$activarAdmin -> ajaxActivarAdministrador();

}

/*=============================================
			Eliminar Administrador
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxAdministradores();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> ajaxEliminarAdministrador();

}