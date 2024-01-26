<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios{

	/*=============================================
				Tabla Categoríass
	=============================================*/ 

	public function mostrarTabla(){

		$usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

		if(count($usuarios)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($usuarios as $key => $value) {

	 		/*=============================================
			IMAGEN
			=============================================*/	
			if($value["foto"] != ""){

				$foto = "<img src='".$value["foto"]."' class='rounded-circle' width='50px'>";

			}else{

				$foto = "<img src='vistas/img/usuarios/default/default.png' class='rounded-circle' width='50px'>";
			}

			/*=============================================
			CANTIDAD DE RESERVAS
			=============================================*/	

			$reservas = "<div class='sumarReservas' idUsuario='".$value["id_u"]."'>0</div>";
			$testimonios = "<div class='sumarTestimonios' idUsuario='".$value["id_u"]."'>0</div>";

			
			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$foto.'",
						"'.$value["nombre"].'",
						"'.$value["email"].'",
						"'.$reservas.'",
						"'.$testimonios.'"
					
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
				Tabla Usuarios
=============================================*/ 

$tabla = new TablaUsuarios();
$tabla -> mostrarTabla();

