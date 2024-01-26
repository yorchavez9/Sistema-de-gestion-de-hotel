/*=============================================
			360 GRADOS
=============================================*/

$(".360Antiguo").pano({
	img: $(".360Antiguo").attr("back")
});

/*=============================================
			Plugin ckEditors
=============================================*/

ClassicEditor.create(document.querySelector('#descripcionHabitacion'), {

   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor) {
  
    $(".ck-content").css({"height":"400px"})

}).catch(function (error) {

 console.log("error", error);

})

/*=============================================
Tabla Habitaciones
=============================================*/

 // $.ajax({

//     "url":"ajax/tablaHabitaciones.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaHabitaciones").DataTable({
  "ajax":"ajax/tablaHabitaciones.ajax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

     "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

})

/*=============================================
	ARRASTRAR VARIAS IMAGENES GALERÍA
=============================================*/

var archivosTemporales = [];

$(".subirGaleria").on("dragenter", function(e){

	e.preventDefault();
  	e.stopPropagation();

  	$(".subirGaleria").css({"background":"url(vistas/img/plantilla/pattern.jpg)"})

})

$(".subirGaleria").on("dragleave", function(e){

  e.preventDefault();
  e.stopPropagation();

  $(".subirGaleria").css({"background":""})

})

$(".subirGaleria").on("dragover", function(e){

  e.preventDefault();
  e.stopPropagation();

})

$("#galeria").change(function(){

	var archivos = this.files;

	multiplesArchivos(archivos);

})

$(".subirGaleria").on("drop", function(e){

  e.preventDefault();
  e.stopPropagation();

  $(".subirGaleria").css({"background":""})

  var archivos = e.originalEvent.dataTransfer.files;
  
  multiplesArchivos(archivos);

})

function multiplesArchivos(archivos){

	for(var i = 0; i < archivos.length; i++){

		var imagen = archivos[i];
		
		if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

			swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen debe estar en formato JPG o PNG!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else if(imagen["size"] > 2000000){

			swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen no debe pesar más de 2MB!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else{

			var datosImagen = new FileReader;
      		datosImagen.readAsDataURL(imagen);

      		$(datosImagen).on("load", function(event){

      			var rutaImagen = event.target.result;

      			$(".vistaGaleria").append(`

					<li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                      
	                    <img class="card-img-top" src="`+rutaImagen+`">

	                    <div class="card-img-overlay p-0 pr-3">
	                      
	                       <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoNueva" temporal>
	                         
	                         <i class="fas fa-trash"></i>

	                       </button>

	                    </div>

	                </li>

      			`)


        		if(archivosTemporales.length != 0){

        			archivosTemporales = JSON.parse($(".inputNuevaGaleria").val());

        		}

        		archivosTemporales.push(rutaImagen);    

        		$(".inputNuevaGaleria").val(JSON.stringify(archivosTemporales)) 		

      		})

		}	

	}	

}

/*=============================================
		QUITAR IMAGEN DE LA GALERÍA
=============================================*/

$(document).on("click", ".quitarFotoNueva", function(){

	var listaFotosNuevas = $(".quitarFotoNueva"); 
	
	var listaTemporales = JSON.parse($(".inputNuevaGaleria").val());

	for(var i = 0; i < listaFotosNuevas.length; i++){

		$(listaFotosNuevas[i]).attr("temporal", listaTemporales[i]);

		var quitarImagen = $(this).attr("temporal");

		if(quitarImagen == listaTemporales[i]){

			listaTemporales.splice(i, 1);

			$(".inputNuevaGaleria").val(JSON.stringify(listaTemporales));

			 $(this).parent().parent().remove();

		}

	}

})

/*=============================================
AGREGAR VIDEO
=============================================*/

$(".agregarVideo").change(function(){

	var codigoVideo = $(this).val();

	$(".vistaVideo").html(
    
    `<iframe width="100%" height="320" src="https://www.youtube.com/embed/`+codigoVideo+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`

  )


})

/*=============================================
			AGREGAR IMAGEN 360
=============================================*/

$("#imagen360").change(function(){

	var imagen = this.files[0];

	/*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$("#imagen360").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else if(imagen["size"] > 2000000){

		$("#imagen360").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			 $(".ver360").html(

			 	`<div class="pano 360Nuevo" back="`+rutaImagen+`">

                    <div class="controls">
                      <a href="#" class="left">&laquo;</a>
                      <a href="#" class="right">&raquo;</a>
                    </div>

                  </div>`

				)

			$(".360Nuevo").pano({
		        img: $(".360Nuevo").attr("back")
		    });

		})

	}

})

/*=============================================
		QUITAR IMAGEN VIEJA GALERÍA
=============================================*/

$(document).on("click", ".quitarFotoAntigua", function(){

	var listaFotosAntiguas = $(".quitarFotoAntigua"); 

	var listaTemporales = $(".inputAntiguaGaleria").val().split(",");

	for(var i = 0; i < listaFotosAntiguas.length; i++){

		quitarImagen = $(this).attr("temporal");

		if(quitarImagen == listaTemporales[i]){

			listaTemporales.splice(i, 1);

			$(".inputAntiguaGaleria").val(listaTemporales.toString());

			$(this).parent().parent().remove();

		}

	}
})

/*=============================================
		GUARDAR HABITACIÓN
=============================================*/

$(".guardarHabitacion").click(function(){

	var idHabitacion = $(".idHabitacion").val();

	var tipo = $(".seleccionarTipo").val().split(",")[1];
	var tipo_h = $(".seleccionarTipo").val().split(",")[0];

	var estilo = $(".seleccionarEstilo").val();

	var galeria = $(".inputNuevaGaleria").val();
	var galeriaAntigua = $(".inputAntiguaGaleria").val();

	var video = $(".agregarVideo").val();

	var recorrido_virtual = $(".360Nuevo").attr("back");
	var antiguoRecorrido = $(".antiguoRecorrido").val();

	var descripcion = $(".ck-content").html();


	if(tipo == "" || tipo_h == ""){

		swal({
	        title: "Error al guardar",
	        text: "El campo 'Elija Categoría' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

    	return;

	}else if(estilo == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo 'Nombre habitación' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

	}else if(video == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo de 'Vídeo' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

	}else if(descripcion == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo de 'Descripción' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

  	}else{

    	var datos = new FormData();
    	datos.append("idHabitacion", idHabitacion);
    	datos.append("tipo_h", tipo_h);
    	datos.append("tipo", tipo);
    	datos.append("estilo", estilo);
    	datos.append("galeria", galeria);
    	datos.append("galeriaAntigua", galeriaAntigua);
    	datos.append("video", video);
    	datos.append("recorrido_virtual", recorrido_virtual);
    	datos.append("antiguoRecorrido", antiguoRecorrido);
    	datos.append("descripcion", descripcion);

    	 $.ajax({

		    url:"ajax/habitaciones.ajax.php",
		    method: "POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
		    xhr: function(){
	        
		    	var xhr = $.ajaxSettings.xhr();

		    	xhr.onprogress = function(evt){ 

		    		var porcentaje = Math.floor((evt.loaded/evt.total*100));

		    		$(".preload").before(`

		    			<div class="progress mt-3" style="height:2px">
		    			<div class="progress-bar" style="width: `+porcentaje+`%;"></div>
		    			</div>`
		    			)

		    	};

		    	return xhr;
		          
		    },
	      	success:function(respuesta){

      			if(respuesta == "ok"){

      				swal({
		                type:"success",
		                  title: "¡CORRECTO!",
		                  text: "¡La habitación ha sido guardada exitosamente!",
		                  showConfirmButton: true,
		                confirmButtonText: "Cerrar"
		                
		              }).then(function(result){

		                  if(result.value){

		                    window.location = "habitaciones";

		                  }

		              });

      			}

      		}

      	})

        
    }


})

/*=============================================
			Eliminar Habitacion
=============================================*/

$(document).on("click", ".eliminarHabitacion", function(){

  var idEliminar = $(this).attr("idEliminar");

  var galeriaHabitacion = $(this).attr("galeriaHabitacion");

  var recorridoHabitacion = $(this).attr("recorridoHabitacion");

  swal({
    title: '¿Está seguro de eliminar esta Habitación?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar Habitación!'
  }).then(function(result){

    if(result.value){

        var datos = new FormData();
        datos.append("idEliminar", idEliminar);
        datos.append("galeriaHabitacion", galeriaHabitacion);
        datos.append("recorridoHabitacion", recorridoHabitacion);

        $.ajax({

          url:"ajax/habitaciones.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success:function(respuesta){

             if(respuesta == "ok"){
               swal({
                  type: "success",
                  title: "¡CORRECTO!",
                  text: "La habitación ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "habitaciones";

                    }
                })

             }

          }

        })
    }
  
  })

})




