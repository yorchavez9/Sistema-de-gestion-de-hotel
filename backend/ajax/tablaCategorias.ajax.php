<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaCategorias{

	/*=============================================
	Tabla Categoríasd
	=============================================*/ 

	public function mostrarTabla(){

		$categorias = ControladorCategorias::ctrMostrarCategorias(null, null);

		if(count($categorias)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($categorias as $key => $value) {

	 		/*=============================================
							COLOR
			=============================================*/	

	 		$color = "<i style='color:".$value["color"]."' class='fas fa-square'></i>";

	 		/*=============================================
							IMAGEN
			=============================================*/	

			$imagen = "<img src='".$value["img"]."' class='img-fluid'>";

			/*=============================================
						CARACTERÍSTICAS
			=============================================*/	

			$caracteristicas = "";

			$jsonIncluye = json_decode($value["incluye"], true);

			foreach ($jsonIncluye as $indice => $valor) {

				$caracteristicas .= "<div class='badge badge-secondary mx-1'><i class='".$valor["icono"]."'></i> ".$valor["item"]."</div>";
			}
	
			/*=============================================
								ACCIONES
			=============================================*/

			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarCategoria' data-toggle='modal' data-target='#editarCategoria' idCategoria='".$value["id"]."'><i class='fas fa-edit text-white'></i></button><button class='btn btn-danger btn-sm eliminarCategoria' idCategoria='".$value["id"]."' imgCategoria='".$value["img"]."' tipoCategoria='".$value["tipo"]."'><i class='fas fa-trash-alt'></i></button></div>";	


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["ruta"].'",
						"'.$color.'",
						"'.$value["tipo"].'",
						"'.$imagen.'",
						"'.$value["descripcion"].'",
						"'.$caracteristicas.'",
						"S/ '.number_format($value["continental_alta"]).'",
						"S/ '.number_format($value["continental_baja"]).'",
						"S/ '.number_format($value["americano_alta"]).'",
						"S/ '.number_format($value["americano_baja"]).'",
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
			Tabla Categorias
=============================================*/ 

$tabla = new TablaCategorias();
$tabla -> mostrarTabla();


