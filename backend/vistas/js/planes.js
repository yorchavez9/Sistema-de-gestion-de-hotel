
/*=============================================
		TABLA PLANES
=============================================*/
 //$.ajax({

   //  "url":"ajax/tablaPlanes.ajax.php",
     //success: function(respuesta){
      
      //console.log("respuesta", respuesta);

     //}

 //})

 $(".tablaPlanes").DataTable({
  "ajax":"ajax/tablaPlanes.ajax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

     "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0",
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
      Subir imagen temporal ImgPlan
=============================================*/
$("input[name='subirImgPlan'], input[name='editarImgPlan']").change(function(){

  var imagen = this.files[0];
  
    /*=============================================
  VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  =============================================*/

  if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    $("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

  }else if(imagen["size"] > 2000000){

    $("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

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

      $(".previsualizarImgPlan").attr("src", rutaImagen);

    })

  }

})

/*=============================================
              Plugin ckEditor
=============================================*/

ClassicEditor.create(document.querySelector('#descripcionPlan'), {

   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor) {
  
    $(".ck-content").css({"height":"200px"})

}).catch(function (error) {

  // console.log("error", error);

})

/*=============================================
                Editar Plan
=============================================*/

$(document).on("click", ".editarPlan", function(){

  var idPlan = $(this).attr("idPlan");

  var datos = new FormData();
  datos.append("idPlan", idPlan);

  $.ajax({

    url:"ajax/planes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

        $('input[name="idPlan"]').val(respuesta["id"]);
        $('input[name="editarPlan"]').val(respuesta["tipo"]);
        $('input[name="imgPlanActual"]').val(respuesta["img"]);
        $('.previsualizarImgPlan').attr("src", respuesta["img"]);
        $('#editarDescripcionPlan').val(respuesta["descripcion"]);
        $('input[name="editar_precio_alta"]').val(respuesta["precio_alta"]);
        $('input[name="editar_precio_baja"]').val(respuesta["precio_baja"]);

        ClassicEditor.create(document.querySelector('#editarDescripcionPlan'), {

          toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

        }).then(function (editor) {
          
          $(".ck-content").css({"height":"200px"})

        }).catch(function (error) {

           // console.log("error", error);
        
        })
           
    }

  })  

})

/*=============================================
            Eliminar Plan
=============================================*/

$(document).on("click", ".eliminarPlan", function(){

  var idPlan = $(this).attr("idPlan");
  var imgPlan = $(this).attr("imgPlan");
 
  swal({
    title: '¿Está seguro de eliminar este plan?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar plan!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idPlan);
        datos.append("imgPlan", imgPlan);

        $.ajax({

          url:"ajax/planes.ajax.php",
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
                  text: "El plan ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "planes";

                    }
                })

             }

          }

        })

      }

    })

})


