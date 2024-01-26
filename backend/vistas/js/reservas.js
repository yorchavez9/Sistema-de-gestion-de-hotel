/*=============================================
Tabla Reservas
=============================================*/

// $.ajax({

//     "url":"ajax/tablaReservas.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaReservas").DataTable({
  "ajax":"ajax/tablaReservas.ajax.php",
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
FECHAS RESERVA
=============================================*/

$('.datepicker.entrada').datepicker({
  startDate: '0d',
  datesDisabled: '0d',
  format: 'yyyy-mm-dd',
  todayHighlight:true
});


/*=============================================
EDITAR RESERVA
=============================================*/

$(document).on("click", ".editarReserva", function(){

  var descripcion = $(this).attr("descripcion");
  var idHabitacion = $(this).attr("idHabitacion");
  var fechaIngreso = $(this).attr("fechaIngreso");
  var fechaSalida = $(this).attr("fechaSalida");
  var idReserva = $(this).attr("idReserva");

  $(".agregarCalendario").html('<div id="calendar"></div>');

  // Agregar descripción al título del modal  
  $(".modal-title span").html(descripcion);

   // Agregar las fechas de reserva al formulario
  $(".datepicker.entrada").val(fechaIngreso);
    $(".datepicker.salida").val(fechaSalida);

    // Agregar id de la habitación al botón ver disponibilidad
    $(".verDisponibilidad").attr("idHabitacion", idHabitacion);

    //Agregar id de la reserva al botón guardar
    $(".guardarNuevaReserva").attr("idReserva", idReserva);

    //Traer las resertvas existentes de la habitación
    var totalEventos = [];
    var datos = new FormData();
    datos.append("idHabitacion", idHabitacion);

    $.ajax({

      url:"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        for(var i = 0; i < respuesta.length; i++){

          if(fechaIngreso != respuesta[i]["fecha_ingreso"]){

            // Agregamos las fechas que ya están reservadas de esa habitación
            totalEventos.push(

              {
                    "start": respuesta[i]["fecha_ingreso"],
                    "end": respuesta[i]["fecha_salida"],
                    "rendering": 'background',
                    "color": '#847059'
                  }

            )

          }

        }

         // Agregamos las fechas de la reserva
         totalEventos.push(
             {
                "start": fechaIngreso,
                "end": fechaSalida,
                "rendering": 'background',
                "color": '#FFCC29'
              }
          )
        

        /*=============================================
          CALENDARIO
          =============================================*/

          $('#calendar').fullCalendar({

            defaultDate:fechaIngreso,
            header: {
              left: 'prev',
              center: 'title',
              right: 'next'
            },
            events:totalEventos

          });

      }

  })

  /*=============================================
  Agregar la misma cantidad de días para la fecha de salida
  =============================================*/

  var diasReserva = $(this).attr("diasReserva");

  $('.datepicker.entrada').change(function(){

    var fechaEntrada = new Date($(this).val());
    fechaEntrada.setDate(fechaEntrada.getDate() + Number(diasReserva)+1);

    mes = ("0"+Number(fechaEntrada.getMonth()+1)).slice(-2);
    dia = ("0"+fechaEntrada.getDate()).slice(-2);

    $('.datepicker.salida').val(fechaEntrada.getFullYear()+"-"+mes+"-"+dia);

  })

})


/*=============================================
VER DISPONIBILIDAD NUEVA RESERVA
=============================================*/

$(document).on("click",".verDisponibilidad", function(){

  var fechaIngreso = $(".datepicker.entrada").val();
    var fechaSalida = $(".datepicker.salida").val();
    var idHabitacion = $(this).attr("idHabitacion");

    // Reiniciar Calendario cada vez que busque disponibilidad
    $(".agregarCalendario").html('<div id="calendar"></div>');

    var totalEventos = [];
    var opcion1 = [];
    var opcion2 = [];
    var opcion3 = [];
    var validarDisponibilidad = false;

    var datos = new FormData();
    datos.append("idHabitacion", idHabitacion);

    $.ajax({

      url:"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){

        for(var i = 0; i < respuesta.length; i++){

          /* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */         

          if(fechaIngreso == respuesta[i]["fecha_ingreso"]){

            opcion1[i] = false;            

          }else{

            opcion1[i] = true;

          }

          /* VALIDAR CRUCE DE FECHAS OPCIÓN 2 */         

          if(fechaIngreso > respuesta[i]["fecha_ingreso"] && fechaIngreso < respuesta[i]["fecha_salida"]){

            opcion2[i] = false;            

          }else{

            opcion2[i] = true;

          }

          /* VALIDAR CRUCE DE FECHAS OPCIÓN 3 */         

          if(fechaIngreso < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){

            opcion3[i] = false;            

          }else{

            opcion3[i] = true;

          }

           /* VALIDAR DISPONIBILIDAD */    

            if(opcion1[i] == false || opcion2[i] == false || opcion3[i] == false){

              validarDisponibilidad = false;
            
            }else{

              validarDisponibilidad = true;
             
            }

            if(!validarDisponibilidad){

              totalEventos.push(
                {
                  "start": respuesta[i]["fecha_ingreso"],
                  "end": respuesta[i]["fecha_salida"],
                  "rendering": 'background',
                  "color": '#847059'
                }
              )

              $(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>');

              $(".guardarNuevaReserva").attr("fechaIngreso", "");
                $(".guardarNuevaReserva").attr("fechaSalida", "");

              break;

            }else{

              totalEventos.push(
                {
                  "start": respuesta[i]["fecha_ingreso"],
                  "end": respuesta[i]["fecha_salida"],
                  "rendering": 'background',
                  "color": '#847059'
                }

              )

              $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>');

             $(".guardarNuevaReserva").attr("fechaIngreso", fechaIngreso);
             $(".guardarNuevaReserva").attr("fechaSalida", fechaSalida); 

            }


        }// FIN CICLO FOR

        if(validarDisponibilidad){

            totalEventos.push(
               {
                  "start": fechaIngreso,
                  "end": fechaSalida,
                  "rendering": 'background',
                  "color": '#FFCC29'
                }
            )

        }

        $('#calendar').fullCalendar({
            defaultDate:fechaIngreso,
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events:totalEventos

        });

      }

  })

})

/*=============================================
        Guardar nueva reserva
=============================================*/

$(document).on("click",".guardarNuevaReserva", function(){

  var fechaIngreso = $(this).attr("fechaIngreso");
    var fechaSalida = $(this).attr("fechaSalida");
    var idReserva = $(this).attr("idReserva");

    if(fechaIngreso == "" || fechaSalida == ""){

       swal({
            title: "Error al guardar",
            text: "¡No ha seleccionado fechas válidas!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

       return;

    }

    var datos = new FormData();
    datos.append("idReserva", idReserva);
    datos.append("fechaIngreso", fechaIngreso);
    datos.append("fechaSalida", fechaSalida);

    $.ajax({

      url:"ajax/reservas.ajax.php",
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
            text: "La reserva ha sido modificada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function(result){

            if(result.value){

              window.location = "reservas";

            }
          })

         }

      }

  })

})

/*=============================================
              Cancelar reserva
=============================================*/

$(document).on("click",".eliminarReserva", function(){

  var idReserva = $(this).attr("idReserva");

  swal({
    title: '¿Está seguro de cancelar esta reserva?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, cancelar reserva!'
  }).then(function(result){

    if(result.value){

      var datos = new FormData();
      datos.append("idReserva", idReserva);
      datos.append("fechaIngreso", null);
      datos.append("fechaSalida", null);

      $.ajax({

        url:"ajax/reservas.ajax.php",
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
              text: "La reserva ha sido cancelada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
            }).then(function(result){

              if(result.value){

                window.location = "reservas";

              }
            })

          }

        }

      })  

    }

  })

})
