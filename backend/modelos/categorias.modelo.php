<?php

require_once "conexion.php";

class ModeloCategorias{

	/*=============================================
				Mostrar Categoríass
	=============================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

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
					Registro Categoria
	=============================================*/

	static public function mdlRegistroCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ruta, color, tipo, img, descripcion, incluye,  continental_alta, continental_baja, americano_alta, americano_baja) VALUES (:ruta, :color, :tipo, :img, :descripcion, :incluye, :continental_alta, :continental_baja, :americano_alta, :americano_baja)");

		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["img"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":incluye", $datos["incluye"], PDO::PARAM_STR);
		$stmt->bindParam(":continental_alta", $datos["continental_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":continental_baja", $datos["continental_baja"], PDO::PARAM_STR);
		$stmt->bindParam(":americano_alta", $datos["americano_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":americano_baja", $datos["americano_baja"], PDO::PARAM_STR);

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
					Editar Categoria
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ruta = :ruta, color = :color, tipo = :tipo, img = :img, descripcion = :descripcion, incluye = :incluye, continental_alta = :continental_alta, continental_baja = :continental_baja, americano_alta = :americano_alta, americano_baja = :americano_baja  WHERE id = :id");

		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["img"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":incluye", $datos["incluye"], PDO::PARAM_STR);
		$stmt->bindParam(":continental_alta", $datos["continental_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":continental_baja", $datos["continental_baja"], PDO::PARAM_STR);
		$stmt->bindParam(":americano_alta", $datos["americano_alta"], PDO::PARAM_STR);
		$stmt->bindParam(":americano_baja", $datos["americano_baja"], PDO::PARAM_STR);
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
	Validar existencia de habitaciones en categoría
	=============================================*/

	static public function mdlValidarCategoria($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
				Eliminar Categoria
	=============================================*/

	static public function mdlEliminarCategoria($tabla, $id){

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