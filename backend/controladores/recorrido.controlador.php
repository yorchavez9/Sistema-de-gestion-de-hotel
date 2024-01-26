<?php

class ControladorRecorrido{

	/*=============================================
				Mostrar Recorrido
	=============================================*/

	static public function ctrMostrarRecorrido($item, $valor){

		$tabla = "recorrido";

		$respuesta = ModeloRecorrido::mdlMostrarRecorrido($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Registro Recorrido
	=============================================*/

	public function ctrRegistroRecorrido(){

		if(isset($_POST["tituloRecorrido"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloRecorrido"]) && 
			   preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionRecorrido"])){

				if(isset($_FILES["subirImgPeqRecorrido"]["tmp_name"]) && !empty($_FILES["subirImgPeqRecorrido"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["subirImgPeqRecorrido"]["tmp_name"]);

					$nuevoAncho = 455;
					$nuevoAlto = 280;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/

					$directorio = "vistas/img/recorrido";		

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgPeqRecorrido"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$rutaImgPeq = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["subirImgPeqRecorrido"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaImgPeq);	

					}

					else if($_FILES["subirImgPeqRecorrido"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$rutaImgPeq = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["subirImgPeqRecorrido"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaImgPeq);

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

				if(isset($_FILES["subirImgGrandeRecorrido"]["tmp_name"]) && !empty($_FILES["subirImgGrandeRecorrido"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["subirImgGrandeRecorrido"]["tmp_name"]);

					$nuevoAncho = 650;
					$nuevoAlto = 450;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/

					$directorio = "vistas/img/recorrido";		

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgGrandeRecorrido"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$rutaImgGrande = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["subirImgGrandeRecorrido"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaImgGrande);	

					}

					else if($_FILES["subirImgGrandeRecorrido"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$rutaImgGrande = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["subirImgGrandeRecorrido"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaImgGrande);

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

				$tabla = "recorrido";

				$datos = array("titulo" => strtoupper($_POST["tituloRecorrido"]),
							   "descripcion" => $_POST["descripcionRecorrido"],
							   "foto_peq" => $rutaImgPeq,
							   "foto_grande" => $rutaImgGrande);

				$respuesta = ModeloRecorrido::mdlRegistroRecorrido($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El recorrido ha sido creado exitosamente!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    window.location = "recorrido";
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

							window.location = "recorrido";

						}

					});	

				</script>';

			}

		}

	}

	/*=============================================
					Editar Recorrido
	=============================================*/

	public function ctrEditarRecorrido(){

		if(isset($_POST["idRecorrido"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRecorrido"]) && 
			   preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionRecorrido"])){

			   	$rutaImgPeq = $_POST["imgPeqRecorridoActual"];
			   	$rutaImgGrande = $_POST["imgGrandeRecorridoActual"];
			
				if(isset($_FILES["editarImgPeqRecorrido"]["tmp_name"]) && !empty($_FILES["editarImgPeqRecorrido"]["tmp_name"])){				

					list($ancho, $alto) = getimagesize($_FILES["editarImgPeqRecorridoActual"]["tmp_name"]);

					$nuevoAncho = 455;
					$nuevoAlto = 280;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/recorrido";
				
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgPeqRecorridoActual"])){
						
						unlink($_POST["imgPeqRecorridoActual"]);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgPeqRecorridoActual"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$rutaImgPeq = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgPeqRecorridoActual"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaImgPeq);	

					}

					else if($_FILES["editarImgPeqRecorridoActual"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$rutaImgPeq = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImgPeqRecorridoActual"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaImgPeq);

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

				if(isset($_FILES["editarImgGrandeRecorrido"]["tmp_name"]) && !empty($_FILES["editarImgGrandeRecorrido"]["tmp_name"])){				

					list($ancho, $alto) = getimagesize($_FILES["editarImgGrandeRecorridoActual"]["tmp_name"]);

					$nuevoAncho = 455;
					$nuevoAlto = 280;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/recorrido";
				
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgGrandeRecorridoActual"])){
						
						unlink($_POST["imgGrandeRecorridoActual"]);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgGrandeRecorridoActual"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$rutaImgGrande = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgGrandeRecorridoActual"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaImgGrande);	

					}

					else if($_FILES["editarImgGrandeRecorridoActual"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$rutaImgGrande = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImgGrandeRecorridoActual"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaImgGrande);

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

				$tabla = "recorrido";

				$datos = array("id"=> $_POST["idRecorrido"],
					           "titulo" => $_POST["editarRecorrido"],
							   "descripcion" => $_POST["editarDescripcionRecorrido"],
							   "foto_peq" => $rutaImgPeq,
							   "foto_grande" => $rutaImgGrande);

				$respuesta = ModeloRecorrido::mdlEditarRecorrido($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El Recorrido ha sido actualizado!",
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
					Eliminar Recorrido
	=============================================*/

	static public function ctrEliminarRecorrido($id, $rutaPeq, $rutaGrande){
		
		unlink("../".$rutaPeq);

		unlink("../".$rutaGrande);

		$tabla = "recorrido";

		$respuesta = ModeloRecorrido::mdlEliminarRecorrido($tabla, $id);

		return $respuesta;

	}

}

	