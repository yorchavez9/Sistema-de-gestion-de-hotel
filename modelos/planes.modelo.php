<?php

require_once "conexion.php";

Class ModeloPlanes{

	/*=============================================
			mostrar Planes
	=============================================*/
	
	static public function mdlMostrarPlanes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC LIMIT 4");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}