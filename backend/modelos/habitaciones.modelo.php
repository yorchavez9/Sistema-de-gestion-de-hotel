<?php

require_once "conexion.php";

class ModeloHabitaciones{

	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function mdlMostrarHabitaciones($tabla1, $tabla2, $valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id = $tabla2.tipo_h WHERE id_h = :id_h");

			$stmt -> bindParam(":id_h", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id = $tabla2.tipo_h ORDER BY $tabla2.id_h DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
				Nueva habitación
	=============================================*/

	static public function mdlNuevaHabitacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_h, estilo, galeria, video, recorrido_virtual, descripcion_h) VALUES (:tipo_h, :estilo, :galeria, :video, :recorrido_virtual, :descripcion_h)");

		$stmt->bindParam(":tipo_h", $datos["tipo_h"], PDO::PARAM_STR);
		$stmt->bindParam(":estilo", $datos["estilo"], PDO::PARAM_STR);
		$stmt->bindParam(":galeria", $datos["galeria"], PDO::PARAM_STR);
		$stmt->bindParam(":video", $datos["video"], PDO::PARAM_STR);
		$stmt->bindParam(":recorrido_virtual", $datos["recorrido_virtual"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_h", $datos["descripcion_h"], PDO::PARAM_STR);

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
	Editar habitación
	=============================================*/

	static public function mdlEditarHabitacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_h = :tipo_h, estilo = :estilo, galeria = :galeria, video = :video, recorrido_virtual = :recorrido_virtual, descripcion_h = :descripcion_h WHERE id_h = :id_h");

		$stmt->bindParam(":id_h", $datos["id_h"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_h", $datos["tipo_h"], PDO::PARAM_STR);
		$stmt->bindParam(":estilo", $datos["estilo"], PDO::PARAM_STR);
		$stmt->bindParam(":galeria", $datos["galeria"], PDO::PARAM_STR);
		$stmt->bindParam(":video", $datos["video"], PDO::PARAM_STR);
		$stmt->bindParam(":recorrido_virtual", $datos["recorrido_virtual"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_h", $datos["descripcion_h"], PDO::PARAM_STR);

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
					Eliminar habitacion
	=============================================*/

	static public function mdlEliminarHabitacion($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_h = :id_h");

		$stmt -> bindParam(":id_h", $id, PDO::PARAM_INT);

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