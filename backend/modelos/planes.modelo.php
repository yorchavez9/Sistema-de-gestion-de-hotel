<?php

require_once "conexion.php";

class ModeloPlanes{

	/*=============================================
					Mostrar Planess
	=============================================*/

	static public function mdlMostrarPlanes($tabla, $item, $valor){

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
					Registro Plan
	=============================================*/

	static public function mdlRegistroPlan($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo, img, descripcion, precio_alta, precio_baja) VALUES (:tipo, :img, :descripcion, :precio_alta, :precio_baja)");

		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["img"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_alta", $datos["precio_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_baja", $datos["precio_baja"], PDO::PARAM_STR);

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
				Editar Plan
	=============================================*/

	static public function mdlEditarPlan($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo = :tipo, img = :img, descripcion = :descripcion, precio_alta = :precio_alta, precio_baja = :precio_baja  WHERE id = :id");

		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["img"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_alta", $datos["precio_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_baja", $datos["precio_baja"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

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
					Eliminar Plan
	=============================================*/

	static public function mdlEliminarPlan($tabla, $id){

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