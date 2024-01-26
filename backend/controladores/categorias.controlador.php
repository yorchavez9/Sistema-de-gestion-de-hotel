<?php

class ControladorCategorias{

	/*=============================================
				Mostrar Categorías
	=============================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				Registro de Categorías
	=============================================*/

	public function ctrRegistroCategoria(){

		if(isset($_POST["rutaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["rutaCategoria"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["tipoCategoria"]) && 
			   preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionCategoria"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["continental_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["continental_baja"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["americano_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["americano_baja"])){

				if(isset($_FILES["subirImgCategoria"]["tmp_name"]) && !empty($_FILES["subirImgCategoria"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["subirImgCategoria"]["tmp_name"]);

					$nuevoAncho = 359;
					$nuevoAlto = 254;

					/*=============================================
					Creamos el directorio donde vamos a guardar la imagen
					=============================================*/

					$directorio = "vistas/img/".strtolower($_POST["tipoCategoria"]);	

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgCategoria"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/portada.jpg";

						$origen = imagecreatefromjpeg($_FILES["subirImgCategoria"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["subirImgCategoria"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/portada.png";

						$origen = imagecreatefrompng($_FILES["subirImgCategoria"]["tmp_name"]);						

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

					$tabla = "categorias";

					$datos = array("ruta" => $_POST["rutaCategoria"],
								   "color" => $_POST["colorCategoria"],
								   "tipo" => $_POST["tipoCategoria"],
								   "img" => $ruta,
								   "descripcion" => $_POST["descripcionCategoria"],
								   "incluye" => $_POST["caracteristicasCategoria"],
								   "continental_alta" => $_POST["continental_alta"],
								   "continental_baja" => $_POST["continental_baja"],
								   "americano_alta" => $_POST["americano_alta"],
								   "americano_baja" => $_POST["americano_baja"]);

					$respuesta = ModeloCategorias::mdlRegistroCategoria($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({
								type:"success",
							  	title: "¡CORRECTO!",
							  	text: "¡La Categoria ha sido creada exitosamente!",
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
					Editar Categoria
	=============================================*/

	public function ctrEditarCategoria(){

		if(isset($_POST["idCategoria"])){

			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["editarRutaCategoria"]) &&
			   preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCategoria"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_continental_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_continental_baja"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_americano_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editar_americano_baja"])){

			   	$ruta = $_POST["imgCategoriaActual"];
			
				if(isset($_FILES["editarImgCategoria"]["tmp_name"]) && !empty($_FILES["editarImgCategoria"]["tmp_name"])){				
					list($ancho, $alto) = getimagesize($_FILES["editarImgCategoria"]["tmp_name"]);

					$nuevoAncho = 359;
					$nuevoAlto = 254;

					$directorio = "vistas/img/".strtolower($_POST["editarTipoCategoria"]);	
				
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgCategoriaActual"])){
						
						unlink($_POST["imgCategoriaActual"]);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgCategoria"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgCategoria"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);	

					}

					else if($_FILES["editarImgCategoria"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImgCategoria"]["tmp_name"]);						

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

				$tabla = "categorias";

			   	$datos = array("id"=> $_POST["idCategoria"],
			   		           "ruta" => $_POST["editarRutaCategoria"],
							   "color" => $_POST["editarColorCategoria"],
							   "tipo" => $_POST["editarTipoCategoria"],
							   "img" => $ruta,
							   "descripcion" => $_POST["editarDescripcionCategoria"],
							   "incluye" => $_POST["editarCaracteristicasCategoria"],
							   "continental_alta" => $_POST["editar_continental_alta"],
							   "continental_baja" => $_POST["editar_continental_baja"],
							   "americano_alta" => $_POST["editar_americano_alta"],
							   "americano_baja" => $_POST["editar_americano_baja"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡la Categoria ha sido actualizada!",
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
	Validar existencia de habitaciones en categoría
	=============================================*/

	static public function ctrValidarCategoria($item, $valor){

		$tabla = "habitaciones";

		$respuesta = ModeloCategorias::mdlValidarCategoria($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				Eliminar Categoria
	=============================================*/

	static public function ctrEliminarCategoria($id, $ruta, $tipo){
		
		unlink("../".$ruta);
		rmdir("../vistas/img/".strtolower($tipo));

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlEliminarCategoria($tabla, $id);

		return $respuesta;

	}

}