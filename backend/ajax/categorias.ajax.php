<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*=============================================
				Editar categoriasd
	=============================================*/	

	public $idCategoria;

	public function ajaxMostrarCategoria(){

		$respuesta = ControladorCategorias::ctrMostrarCategorias("id", $this->idCategoria);

		echo json_encode($respuesta);

	}

	/*=============================================
	Validar existencia de habitaciones en categoría
	=============================================*/	

	public $tipo_h;

	public function ajaxValidarCategoria(){

		$respuesta = ControladorCategorias::ctrValidarCategoria("tipo_h", $this->tipo_h);

		echo json_encode($respuesta);

	}

	/*=============================================
				Eliminar Categoria
	=============================================*/	

	public $idEliminar;
	public $imgCategoria;
	public $tipoCategoria;

	public function ajaxEliminarCategoria(){

		$respuesta = ControladorCategorias::ctrEliminarCategoria($this->idEliminar, $this->imgCategoria, $this->tipoCategoria);

		echo $respuesta;

	}


}

/*=============================================
			Editar categorias
=============================================*/	

if(isset($_POST["idCategoria"])){

	$editar = new AjaxCategorias();
	$editar -> idCategoria = $_POST["idCategoria"];
	$editar -> ajaxMostrarCategoria();

}

/*=============================================
	Validar existencia de habitaciones en categoría
=============================================*/	

if(isset($_POST["tipo_h"])){

	$validar = new AjaxCategorias();
	$validar -> tipo_h = $_POST["tipo_h"];
	$validar -> ajaxValidarCategoria();

}


/*=============================================
			Eliminar Categoria
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxCategorias();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> imgCategoria = $_POST["imgCategoria"];
	$eliminar -> tipoCategoria = $_POST["tipoCategoria"];
	$eliminar -> ajaxEliminarCategoria();

}