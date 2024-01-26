/*=============================================
Tabla Recorrido
=============================================*/

// $.ajax({

//     "url":"ajax/tablaRecorrido.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaRecorrido").DataTable({
  "ajax":"ajax/tablaRecorrido.ajax.php",
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

});

/*=============================================
Subir imagen Peuqeña Recorrido
=============================================*/

$("input[name='subirImgPeqRecorrido'], input[name='editarImgPeqRecorrido']").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $("input[name='subirImgPeqRecorrido'], input[name='editarImgPeqRecorrido']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $("input[name='subirImgPeqRecorrido'], input[name='editarImgPeqRecorrido']").val("");

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

        $(".previsualizarImgPeqRecorrido").attr("src", rutaImagen);

      })

    }

})

/*=============================================
Subir imagen Grande Recorrido
=============================================*/

$("input[name='subirImgGrandeRecorrido'], input[name='editarImgGrandeRecorrido']").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $("input[name='subirImgGrandeRecorrido'], input[name='editarImgGrandeRecorrido']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $("input[name='subirImgGrandeRecorrido'], input[name='editarImgGrandeRecorrido']").val("");

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

        $(".previsualizarImgGrandeRecorrido").attr("src", rutaImagen);

      })

    }

})

/*=============================================
Editar Recorrido
=============================================*/

$(document).on("click", ".editarRecorrido", function(){

  var idRecorrido = $(this).attr("idRecorrido");

  var datos = new FormData();
  datos.append("idRecorrido", idRecorrido);

  $.ajax({

    url:"ajax/recorrido.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

        $('input[name="idRecorrido"]').val(respuesta["id"]);
        $('input[name="editarRecorrido"]').val(respuesta["titulo"]);
 
        $('textarea[name="editarDescripcionRecorrido"]').val(respuesta["descripcion"]);

        $('input[name="imgPeqRecorridoActual"]').val(respuesta["foto_peq"]);

        $('.previsualizarImgPeqRecorrido').attr("src", respuesta["foto_peq"]);

        $('input[name="imgGrandeRecorridoActual"]').val(respuesta["foto_grande"]);

        $('.previsualizarImgGrandeRecorrido').attr("src", respuesta["foto_grande"]);
        
    }

  })  

})

/*=============================================
        Eliminar Recorrido
=============================================*/

$(document).on("click", ".eliminarRecorrido", function(){

  var idRecorrido = $(this).attr("idRecorrido");
  var imgPeqRecorrido = $(this).attr("imgPeqRecorrido");
  var imgGrandeRecorrido = $(this).attr("imgGrandeRecorrido");
 
  swal({
    title: '¿Está seguro de eliminar este Recorrido?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar Recorrido!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idRecorrido);
        datos.append("imgPeqRecorrido", imgPeqRecorrido);
        datos.append("imgGrandeRecorrido", imgGrandeRecorrido);

        $.ajax({

          url:"ajax/recorrido.ajax.php",
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
                  text: "El Recorrido ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "recorrido";

                    }
                })

             }

          }

        })

      }

    })

})


