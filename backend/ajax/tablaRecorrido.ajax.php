<?php

require_once "../controladores/recorrido.controlador.php";
require_once "../modelos/recorrido.modelo.php";

class TablaRecorrido{

	/*=============================================
			Tabla Recorrido
	=============================================*/ 

	public function mostrarTabla(){

		$recorrido = ControladorRecorrido::ctrMostrarRecorrido(null, null);

		if(count($recorrido)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($recorrido as $key => $value) {

	 		/*=============================================
						FOTO GRANDE
			=============================================*/	

			$foto_grande = "<img src='".$value["foto_grande"]."' class='img-fluid'>";

	 		/*=============================================
						FOTO PEQUEÑA
			=============================================*/	

			$foto_peq = "<img src='".$value["foto_peq"]."' class='img-fluid'>";
			
			/*=============================================
							ACCIONES
			=============================================*/

			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarRecorrido' data-toggle='modal' data-target='#editarRecorrido' idRecorrido='".$value["id"]."'><i class='fas fa-edit text-white'></i></button><button class='btn btn-danger btn-sm eliminarRecorrido' idRecorrido='".$value["id"]."' imgGrandeRecorrido='".$value["foto_grande"]."' imgPeqRecorrido='".$value["foto_peq"]."'><i class='fas fa-trash-alt'></i></button></div>";	


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["titulo"].'",
						"'.$value["descripcion"].'",
						"'.$foto_grande.'",
						"'.$foto_peq.'",
						"'.$acciones.'"
						
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
			Tabla Recorrido
=============================================*/ 

$tabla = new TablaRecorrido();
$tabla -> mostrarTabla();
