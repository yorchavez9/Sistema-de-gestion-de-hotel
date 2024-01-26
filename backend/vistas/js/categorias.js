/*=============================================
      Tabla Categorias
=============================================*/

 //$.ajax({

   //"url":"ajax/tablaCategorias.ajax.php",
   //success: function(respuesta){f
      
     //console.log("respuesta", respuesta);

    //}

 //})

$(".tablaCategorias").DataTable({
  "ajax":"ajax/tablaCategorias.ajax.php",
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
    Subir imagen temporal Categoria
=============================================*/

$("input[name='subirImgCategoria'], input[name='editarImgCategoria']").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");

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

        $(".previsualizarImgCategoria").attr("src", rutaImagen);

      })

    }

})

/*=============================================
          Ruta Categorias
=============================================*/

function limpiarUrl(texto){

  var texto = texto.toLowerCase();
  texto = texto.replace(/[á]/g, 'a');
  texto = texto.replace(/[é]/g, 'e');
  texto = texto.replace(/[í]/g, 'i');
  texto = texto.replace(/[ó]/g, 'o');
  texto = texto.replace(/[ú]/g, 'u');
  texto = texto.replace(/[ñ]/g, 'n');
  texto = texto.replace(/ /g, '-');

  return texto;

}

$(document).on("keyup", "input[name='rutaCategoria']", function(){

  $("input[name='rutaCategoria']").val(

    limpiarUrl($("input[name='rutaCategoria']").val())

  )

})

/*=============================================
              Escoger Color
=============================================*/

$(".colorPicker").colorpicker();

/*=============================================
    Escoger Características con ICHECK
=============================================*/

$('input[type="checkbox"], input[type="radio"]').iCheck({

  checkboxClass: 'icheckbox_flat-blue',
  radioClass   : 'iradio_flat-blue'
})

var caracteristicasCategoria = [];
var editarCaracteristicasCategoria = [];

$(".checkbox, .editarCheckbox").on("ifChecked", function(){

  var item = $(this).val().split(",")[0];
  var icono = $(this).val().split(",")[1];

  caracteristicasCategoria.push({

    "item": item,
    "icono": icono

  })

  $("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria));

   editarCaracteristicasCategoria.push({

    "item": item,
    "icono": icono

  })

  $("input[name='editarCaracteristicasCategoria']").val(JSON.stringify( editarCaracteristicasCategoria));

})

$(".checkbox, .editarCheckbox").on("ifUnchecked", function(){

  var item = $(this).val().split(",")[0];
  var icono = $(this).val().split(",")[1];

  for(var i = 0; i < caracteristicasCategoria.length; i++){

    if(caracteristicasCategoria[i]["item"] == item){

      caracteristicasCategoria.splice(i, 1);

      $("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria));

    }

  }

  for(var i = 0; i < editarCaracteristicasCategoria.length; i++){

    if(editarCaracteristicasCategoria[i]["item"] == item){

        editarCaracteristicasCategoria.splice(i, 1);

        $("input[name='editarCaracteristicasCategoria']").val(JSON.stringify(editarCaracteristicasCategoria));

      }

  }

})

/*=============================================
              Editar Categoria
=============================================*/

$(document).on("click", ".editarCategoria", function(){

  var idCategoria = $(this).attr("idCategoria");

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({

    url:"ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

        // console.log("respuesta", respuesta);

        $('input[name="idCategoria"]').val(respuesta["id"]);

        $('input[name="editarRutaCategoria"]').val(respuesta["ruta"]);

        $('input[name="editarColorCategoria"]').val(respuesta["color"]);

        $(".colorPicker i").css({"background-color":respuesta["color"]})

        $('input[name="editarTipoCategoria"]').val(respuesta["tipo"]);

        $('input[name="imgCategoriaActual"]').val(respuesta["img"]);

        $('.previsualizarImgCategoria').attr("src", respuesta["img"]);

        $('textarea[name="editarDescripcionCategoria"]').val(respuesta["descripcion"]);

        $('input[name="editar_continental_alta"]').val(respuesta["continental_alta"]);

        $('input[name="editar_continental_baja"]').val(respuesta["continental_baja"]);

        $('input[name="editar_americano_alta"]').val(respuesta["americano_alta"]);

        $('input[name="editar_americano_baja"]').val(respuesta["americano_baja"]);

        $('input[name="editarCaracteristicasCategoria"]').val(respuesta["incluye"]);

        var editarCheckbox = $(".editarCheckbox");

        var incluye = JSON.parse(respuesta["incluye"]);

        for(var i = 0; i < editarCheckbox.length; i++){

            $(editarCheckbox[i]).iCheck('uncheck');

           for(var f = 0; f < incluye.length; f++){

              if( incluye[f]["item"] == $(editarCheckbox[i]).val().split(",")[0]){

                 $(editarCheckbox[i]).iCheck('check');

              }
            
          }

        }

      }

  })  

})

/*=============================================
            Eliminar Categoria
=============================================*/

$(document).on("click", ".eliminarCategoria", function(){

  var idCategoria = $(this).attr("idCategoria");
  var imgCategoria = $(this).attr("imgCategoria");
  var tipoCategoria = $(this).attr("tipoCategoria");

  var datos = new FormData();
  datos.append("tipo_h", idCategoria);

   $.ajax({

        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          if(respuesta.length != 0){

           swal({
              title: "Esta categoría no se puede borrar",
              text: "¡Tiene habitaciones vinculadas!",
              type: "error",
              confirmButtonText: "¡Cerrar!"
            });

            return;

          }
      
        }

   })
 
  swal({
    title: '¿Está seguro de eliminar este Categoría?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar Categoría!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idCategoria);
        datos.append("imgCategoria", imgCategoria);
        datos.append("tipoCategoria", tipoCategoria);

        $.ajax({

          url:"ajax/categorias.ajax.php",
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
                  text: "La categoria ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "categorias";

                    }
                })

             }

          }

        })

      }

    })

})




