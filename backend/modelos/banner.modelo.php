<?php

require_once "conexion.php";

class ModeloBanner{

	/*=============================================
					Mostrar Banner
	=============================================*/

	static public function mdlMostrarBanner($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
				Registro Banner
	=============================================*/

	static public function mdlRegistroBanner($tabla, $ruta){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(img) VALUES (:img)");

		$stmt->bindParam(":img", $ruta, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
					Editar Banner
	=============================================*/

	static public function mdlEditarBanner($tabla, $id, $ruta){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET img = :img WHERE id = :id");

		$stmt->bindParam(":img", $ruta, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
				Eliminar Banner
	=============================================*/

	static public function mdlEliminarBanner($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();

		$stmt = null;

	}

}	