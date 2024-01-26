/*=============================================
Tabla Restaurante
=============================================*/

// $.ajax({

//     "url":"ajax/tablaRestaurante.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaRestaurante").DataTable({
  "ajax":"ajax/tablaRestaurante.ajax.php",
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
Subir imagen del plato Restaurante
=============================================*/

$("input[name='subirImgRestaurante'], input[name='editarImgRestaurante']").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $("input[name='subirImgRestaurante'], input[name='editarImgRestaurante']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $("input[name='subirImgRestaurante'], input[name='editarImgRestaurante']").val("");

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

        $(".previsualizarImgRestaurante").attr("src", rutaImagen);

      })

    }

})

/*=============================================
Editar Restaurante
=============================================*/

$(document).on("click", ".editarRestaurante", function(){

  var idRestaurante = $(this).attr("idRestaurante");

  var datos = new FormData();
  datos.append("idRestaurante", idRestaurante);

  $.ajax({

    url:"ajax/restaurante.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

      $('input[name="idRestaurante"]').val(respuesta["id"]);

      $('textarea[name="editarDescripcionRestaurante"]').val(respuesta["descripcion"]);

      $('input[name="imgRestauranteActual"]').val(respuesta["img"]);

      $('.previsualizarImgRestaurante').attr("src", respuesta["img"]);
     
    }

  })  

})

/*=============================================
Eliminar Restaurante
=============================================*/

$(document).on("click", ".eliminarRestaurante", function(){

  var idRestaurante = $(this).attr("idRestaurante");
  var imgRestaurante = $(this).attr("imgRestaurante");
 
  swal({
    title: '¿Está seguro de eliminar este plato del Restaurante?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar plato!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idRestaurante);
        datos.append("imgRestaurante", imgRestaurante);

        $.ajax({

          url:"ajax/restaurante.ajax.php",
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
                  text: "El Plato del Restaurante ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "restaurante";

                    }
                })

             }

          }

        })

      }

    })

})