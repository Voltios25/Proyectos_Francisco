var tabla;
//Funcion que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  //Items para la placa bus
  $.post("../controlador/bus.php?op=selectS", function(r) {
    $("#id_servicio").html(r);
    $('#id_servicio').selectpicker('refresh');
  });


}
//Funcion Limpiar()
{
  function limpiar() {

    $("#placa").val("");
    $("#año_de_fabricacion").val("");
    $("#asientos_totales").val("");
    $("#nro_ejes").val("");
    $("#fecha_adquisicion").val("");
    $("#fabricante").val("");

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
      url: '../controlador/bus.php?op=listar',
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
    url: "../controlador/bus.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      swal({
        title: 'Buses',
        type: 'success',
        text: datos
      });
      mostrarform(false);
      tabla.ajax.reload();
    }
  });

  limpiar();

}

function eliminar(id_bus) {

  swal({
    title: "¿Eliminar?",
    text: "¿Está Seguro de eliminar el Bus?",
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
      $.post("../controlador/bus.php?op=eliminar", {
        id_bus: id_bus
      }, function(e) {
        swal('☹', e, '');
        tabla.ajax.reload();
      });
    } else {
      swal("! Cancelado ¡", "Se Cancelo la Eliminacion del Bus", "error");
    }
  });
}

function mostrar(id_bus) {

  $.post("../controlador/bus.php?op=mostrar", {
      id_bus: id_bus
    }, function(data, status)

    {
      data = JSON.parse(data);
      mostrarform(true);

      $("#id_bus").val(data.id_bus);
      $("#placa").val(data.placa);
      $("#año_de_fabricacion").val(data.año_de_fabricacion);
      $("#asientos_totales").val(data.asientos_totales);
      $("#nro_ejes").val(data.nro_ejes);
      $('#fecha_adquisicion').val(data.fecha_adquisicion);
      $('#fabricante').val(data.fabricante);

    })
}



//Función para activar registros
function activar(id_bus) {
  bootbox.confirm("¿ESTÁ SEGURO DE ACTIVAR ESTE REGISTRO?", function(result) {
    if (result) {
      $.post("../controlador/bus.php?op=activar", {
        id_bus: id_bus
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}
//Funcion para desactivar regitros
function desactivar(id_bus) {
  bootbox.confirm("¿ESTÁ SEGURO DE DESACTIVAR ESTE REGISTRO?", function(result) {
    if (result) {
      $.post("../controlador/bus.php?op=desactivar", {
        id_bus: id_bus
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}




init();
