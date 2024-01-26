<?php

class ControladorPlanes{

	/*=============================================
				Mostrar Planess
	=============================================*/

	static public function ctrMostrarPlanes($item, $valor){

		$tabla = "planes";

		$respuesta = ModeloPlanes::mdlMostrarPlanes($tabla, $item, $valor);

		return $respuesta;

	}

/*=============================================
			Registro de Plan
	=============================================*/

	public function ctrRegistroPlan(){

		if(isset($_POST["tipoPlan"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tipoPlan"]) && 
			   preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\$\\|\\-\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionPlan"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["precio_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["precio_baja"])){

				if(isset($_FILES["subirImgPlan"]["tmp_name"]) && !empty($_FILES["subirImgPlan"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["subirImgPlan"]["tmp_name"]);

					$nuevoAncho = 480;
					$nuevoAlto = 382;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PLAN
					=============================================*/

					$directorio = "vistas/img/planes";		

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgPlan"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["subirImgPlan"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["subirImgPlan"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["subirImgPlan"]["tmp_name"]);						

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

					$tabla = "planes";

					$datos = array("tipo" => $_POST["tipoPlan"],
								   "img" => $ruta,
								   "descripcion" => $_POST["descripcionPlan"],
								   "precio_alta" => $_POST["precio_alta"],
								   "precio_baja" => $_POST["precio_baja"]);

					$respuesta = ModeloPlanes::mdlRegistroPlan($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({
								type:"success",
							  	title: "¡CORRECTO!",
							  	text: "¡El plan ha sido creado exitosamente!",
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

			}else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
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
					Editar Plan
	=============================================*/

	public function ctrEditarPlan(){

		if(isset($_POST["idPlan"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPlan"]) && 
			   preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\$\\|\\-\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionPlan"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_precio_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_precio_baja"])){

			   	$ruta = $_POST["imgPlanActual"];
			
				if(isset($_FILES["editarImgPlan"]["tmp_name"]) && !empty($_FILES["editarImgPlan"]["tmp_name"])){				

					list($ancho, $alto) = getimagesize($_FILES["editarImgPlan"]["tmp_name"]);

					$nuevoAncho = 480;
					$nuevoAlto = 382;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/planes";
				
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgPlanActual"])){
						
						unlink($_POST["imgPlanActual"]);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgPlan"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgPlan"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["editarImgPlan"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImgPlan"]["tmp_name"]);						

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

				}

				$tabla = "planes";

				$datos = array("id"=> $_POST["idPlan"],
					           "tipo" => $_POST["editarPlan"],
							   "img" => $ruta,
							   "descripcion" => $_POST["editarDescripcionPlan"],
							   "precio_alta" => $_POST["editar_precio_alta"],
							   "precio_baja" => $_POST["editar_precio_baja"]);

				$respuesta = ModeloPlanes::mdlEditarPlan($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El plan ha sido actualizado!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';
					
				}	

			}else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
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
					Eliminar Plan
	=============================================*/

	static public function ctrEliminarPlan($id, $ruta){
		
		unlink("../".$ruta);

		$tabla = "planes";

		$respuesta = ModeloPlanes::mdlEliminarPlan($tabla, $id);

		return $respuesta;

	}


}