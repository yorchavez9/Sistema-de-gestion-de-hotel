/*=============================================
Tabla Usuarioss
=============================================*/

// $.ajax({

//     "url":"ajax/tablaUsuarios.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaUsuarios").DataTable({
  "ajax":"ajax/tablaUsuarios.ajax.php",
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
          SUMAR RESERVAS
=============================================*/

$(".tablaUsuarios").on("draw.dt", function(){

  var sumarReservas = $(".sumarReservas");
  var idUsuario = [];
  var sumar = [];

  for(var i = 0; i < sumarReservas.length; i++){

    idUsuario.push($(sumarReservas[i]).attr("idUsuario"));

    var datos = new FormData();
    datos.append("idUsuarioR", idUsuario[i]);

    $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){ 
        
         sumar.push(respuesta.length);
         
         for(var f = 0; f < sumar.length; f++){

           $(sumarReservas[f]).html(sumar[f]);

         }
      
      }

    })  
   
  }

})

/*=============================================
SUMAR TESTIMONIOS
=============================================*/

$(".tablaUsuarios").on("draw.dt", function(){

  var sumarTestimonios = $(".sumarTestimonios");
  var idUsuario = [];
  var sumar = [];

  for(var i = 0; i < sumarTestimonios.length; i++){

    idUsuario.push($(sumarTestimonios[i]).attr("idUsuario"));

    var datos = new FormData();
    datos.append("idUsuarioT", idUsuario[i]);

    $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){      

        sumar.push(respuesta.length);

        for(var f = 0; f < sumar.length; f++){

          $(sumarTestimonios[f]).html(sumar[f]);
        
        }
    
      }

    })

  }

})
