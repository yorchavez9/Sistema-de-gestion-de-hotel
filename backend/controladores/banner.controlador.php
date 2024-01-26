<?php

class ControladorBanner {

	/*=============================================
				Mostrar Banner
	=============================================*/

	static public function ctrMostrarBanner($item, $valor){

		$tabla = "banner";

		$respuesta = ModeloBanner::mdlMostrarBanner($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
				Registro de Banner
	=============================================*/

	public function ctrRegistroBanner(){

		if(isset($_FILES["subirBanner"]["tmp_name"]) && !empty($_FILES["subirBanner"]["tmp_name"])){

			list($ancho, $alto) = getimagesize($_FILES["subirBanner"]["tmp_name"]);

			$nuevoAncho = 1440;
			$nuevoAlto = 600;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL BANNER
			=============================================*/

			$directorio = "vistas/img/banner";	

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if($_FILES["subirBanner"]["type"] == "image/jpeg"){

				$aleatorio = mt_rand(100,999);

				$ruta = $directorio."/".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($_FILES["subirBanner"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);	

			}

			else if($_FILES["subirBanner"]["type"] == "image/png"){

				$aleatorio = mt_rand(100,999);

				$ruta = $directorio."/".$aleatorio.".png";

				$origen = imagecreatefrompng($_FILES["subirBanner"]["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagealphablending($destino, FALSE);
	
				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}else{

				echo'<script>

					swal({
							type:"error",
						  	title: "¡CORREGIR!",
						  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

				return;

			}

			$tabla = "banner";

			$respuesta = ModeloBanner::mdlRegistroBanner($tabla, $ruta);

			if($respuesta == "ok"){

				echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La imagen del banner ha sido creada exitosamente!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

			}	

		}

	
	}

	/*=============================================
	Editar Banner
	=============================================*/

	public function ctrEditarBanner(){

		if(isset($_POST["idBanner"])){
			
			if(isset($_FILES["editarBanner"]["tmp_name"]) && !empty($_FILES["editarBanner"]["tmp_name"])){				

				list($ancho, $alto) = getimagesize($_FILES["editarBanner"]["tmp_name"]);

				$nuevoAncho = 1440;
				$nuevoAlto = 600;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL BANNER
				=============================================*/

				$directorio = "vistas/img/banner";
			
				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/

				if(isset($_POST["bannerActual"])){
					
					unlink($_POST["bannerActual"]);

				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["editarBanner"]["type"] == "image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["editarBanner"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);	

				}

				else if($_FILES["editarBanner"]["type"] == "image/png"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["editarBanner"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
		
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}else{

					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

					return;

				}

				$tabla = "banner";
				$id = $_POST["idBanner"];

				$respuesta = ModeloBanner::mdlEditarBanner($tabla, $id, $ruta);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡La imagen del banner ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

			}		

		}	

	}

	/*=============================================
					Eliminar Banner
	=============================================*/

	static public function ctrEliminarBanner($id, $ruta){
		
		unlink("../".$ruta);

		$tabla = "banner";

		$respuesta = ModeloBanner::mdlEliminarBanner($tabla, $id);

		return $respuesta;

	}

}



	