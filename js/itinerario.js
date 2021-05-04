var tabla;
//Funcion que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  /*
  //Items para la placa bus
  $.post("../controlador/bus.php?op=selectP",function(r){
             $("#idbus").html(r);
             $('#idbus').selectpicker('refresh');
  });
  */
  //Items para placa bus
  $.post("../controlador/bus.php?op=limpiar_placa", function(r) {
    $("#idbus").html(r);
    $('#idbus').selectpicker('refresh');
  })

  //Items para el nombre del copiloto
  $.post("../controlador/conductores.php?op=limpiar_chofer", function(r) {
    $("#idcopiloto").html(r);
    $('#idcopiloto').selectpicker('refresh');
  });
  //Items para limpiar
  $.post("../controlador/conductores.php?op=limpiar_chofer", function(r) {
    $("#idconductor").html(r);
    $('#idconductor').selectpicker('refresh');
  });

  /*
  /*
       //Items para el nombre del chofer
       $.post("../controlador/conductores.php?op=selectC",function(r){
          $("#conductor").html(r);
          $('#conductor').selectpicker('refresh');
  });

  */
  $.post("../controlador/terramoza.php?op=limpiarT", function(r) {
    $("#id_terramoza").html(r);
    $('#id_terramoza').selectpicker('refresh');
  });

  $.post("../controlador/lugares.php?op=selectS", function(r) {
    $("#id_servicio").html(r);
    $('#id_servicio').selectpicker('refresh');
  });


    $.post("../controlador/lugares.php?op=selectE", function(r) {
      $("#id_estado").html(r);
      $('#id_estado').selectpicker('refresh');
    });



  /*
       //Items para el nombre de la terramoza
       $.post("../controlador/terramoza.php?op=selectT",function(r){
          $("#id_terramoza").html(r);
          $('#id_terramoza').selectpicker('refresh');
  });
  */
  //Items para el nombre del origen
  $.post("../controlador/lugares.php?op=selectOD", function(r) {
    $("#id_origen").html(r);
    $('#id_origen').selectpicker('refresh');
  });
  //Items para el nombre del destino
  $.post("../controlador/lugares.php?op=selectOD", function(r) {
    $("#id_destino").html(r);
    $('#id_destino').selectpicker('refresh');
  });


}
//Funcion Limpiar()
{
  function limpiar() {

    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
    $("#imagen").val("");

  }
}
//Funcion para mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnagregar").hide();
  } else {

    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();

  }
}
//Funcion CancelarForm
function cancelarform() {
  limpiar();
  mostrarform(false);
}

//Funcion Listar
function listar() {
  tabla = $('#tbllistado').dataTable({

    "lengthMenu": [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
    "aProcessing": true, //Activar el procesamiento del datatables
    "aServerSide": true, //Paginacion y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>', //Definimos los elementos del control de la tabla
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax": {
      url: '../controlador/itinerario.php?op=listar',
      type: "get",
      dataType: "json",
      error: function(e) {
        console.log(e.responseText);
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5, //Paginacion
    "order": [
      [0, "desc"]
    ] //Ordenar(columna,orden)

  }).DataTable();

}
//Funcion paa guardar y editar
function guardaryeditar(e) {
  e.preventDefault(); //No se activara la accion predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../controlador/itinerario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      swal({
        title: 'Itinerario',
        type: 'success',
        text: datos
      });
      mostrarform(false);
      tabla.ajax.reload();
    }
  });

  limpiar();

}

function eliminar(id) {

  swal({
    title: "¿Eliminar?",
    text: "¿Está Seguro de eliminar el Itinerario?",
    type: "warning",
    showCancelButton: true,
    cancelButtonText: "No",
    cancelButtonColor: '#FF0000',
    confirmButtonColor: '#008df9',
    confirmButtonText: "Si",
    closeOnConfirm: false,
    closeOnCancel: false,
    showLoaderOnConfirm: true
  }, function(isConfirm) {
    if (isConfirm) {
      $.post("../controlador/itinerario.php?op=eliminar", {
        id: id
      }, function(e) {
        swal('☹', e, '');
        tabla.ajax.reload();
      });
    } else {
      swal("! Cancelado ¡", "Se Cancelo la Eliminacion del Itinerario", "error");
    }
  });
}

function mostrar(id) {

  $.post("../controlador/itinerario.php?op=mostrar", {
      id: id
    }, function(data, status)

    {
      data = JSON.parse(data);
      mostrarform(true);

      $("#id").val(data.id);
      $("#idbus").val(data.idbus);
      $('#idbus').selectpicker('refresh');
      $("#idconductor").val(data.conductor);
      $('#idconductor').selectpicker('refresh');
      $("#idcopiloto").val(data.copiloto);
      $('#idcopiloto').selectpicker('refresh');
      $("#id_terramoza").val(data.id_terramoza);
      $('#id_terramoza').selectpicker('refresh');
      $("#id_origen").val(data.id_origen);
      $('#id_origen').selectpicker('refresh');
      $("#id_destino").val(data.id_destino);
      $('#id_destino').selectpicker('refresh');
      $("#id_servicio").val(data.id_destino);
      $('#id_servicio').selectpicker('refresh');
      $("#id_estado").val(data.id_destino);
      $('#id_estado').selectpicker('refresh');
      $("#imagenmuestra").show();
      $("#imagenmuestra").attr("src","../files/imagenes/"+data.imagen);
      $("#imagenactual").val(data.imagen);
      $("#precio").val(data.fecha_ingreso);
      $("#duracion_viaje").val(data.duracion_viaje);
      $("#hora_salida").val(data.hora_salida);
      $("#fecha_salida").val(data.fecha_salida);


    })
}


init();
