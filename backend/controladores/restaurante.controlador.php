<?php

class ControladorRestaurante{

	/*=============================================
	Mostrar Restaurante
	=============================================*/

	static public function ctrMostrarRestaurante($item, $valor){

		$tabla = "restaurante";

		$respuesta = ModeloRestaurante::mdlMostrarRestaurante($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Registro Restaurante
	=============================================*/

	public function ctrRegistroRestaurante(){

		if(isset($_POST["descripcionRestaurante"])){

			if(preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionRestaurante"])){

				if(isset($_FILES["subirImgRestaurante"]["tmp_name"]) && !empty($_FILES["subirImgRestaurante"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["subirImgRestaurante"]["tmp_name"]);

					$nuevoAncho = 169;
					$nuevoAlto = 169;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/

					$directorio = "vistas/img/restaurante";		

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgRestaurante"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["subirImgRestaurante"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["subirImgRestaurante"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["subirImgRestaurante"]["tmp_name"]);						

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

				$tabla = "restaurante";

				$datos = array("descripcion" => $_POST["descripcionRestaurante"],
							   "img" => $ruta);

				$respuesta = ModeloRestaurante::mdlRegistroRestaurante($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El plato del restaurante ha sido creado exitosamente!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    window.location = "restaurante";
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

							window.location = "restaurante";

						}

					});	

				</script>';

			}

		}

	}

	/*=============================================
	Editar Restaurante
	=============================================*/

	public function ctrEditarRestaurante(){

		if(isset($_POST["idRestaurante"])){

			if(preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionRestaurante"])){

				if(isset($_FILES["editarImgRestaurante"]["tmp_name"]) && !empty($_FILES["editarImgRestaurante"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImgRestaurante"]["tmp_name"]);

					$nuevoAncho = 169;
					$nuevoAlto = 169;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/

					$directorio = "vistas/img/restaurante";		

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgRestaurante"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgRestaurante"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["editarImgRestaurante"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImgRestaurante"]["tmp_name"]);						

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

				$tabla = "restaurante";

				$datos = array("id" => $_POST["idRestaurante"],
								"descripcion" => $_POST["editarDescripcionRestaurante"],
							   "img" => $ruta);

				$respuesta = ModeloRestaurante::mdlEditarRestaurante($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El plato del restaurante ha sido editado exitosamente!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    window.location = "restaurante";
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

							window.location = "restaurante";

						}

					});	

				</script>';

			}

		}

	}

	/*=============================================
				Eliminar Restaurante
	=============================================*/

	static public function ctrEliminarRestaurante($id, $ruta){
		
		unlink("../".$ruta);

		$tabla = "restaurante";

		$respuesta = ModeloRestaurante::mdlEliminarRestaurante($tabla, $id);

		return $respuesta;

	}

}