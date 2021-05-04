var tabla;
//Funcion que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

}
//Funcion Limpiar()
{
  function limpiar() {


    $("#dni").val("");
    $("#nombres").val("");
    $("#contacto").val("");
    $("#licencia").val("");
    $("#nro_seguro_social").val("");
    $("#fecha_nacimiento").val("");
    $("#fecha_ingreso").val("");

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
      url: '../controlador/conductores.php?op=listar',
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
    url: "../controlador/conductores.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      swal({
        title: 'Conductores',
        type: 'success',
        text: datos
      });
      mostrarform(false);
      tabla.ajax.reload();
    }
  });

  limpiar();

}

function despedir(id_conductor) {

  swal({
    title: "¿Eliminar?",
    text: "¿Está Seguro de eliminar el Conductor?",
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
      $.post("../controlador/conductores.php?op=despedir", {
        id_conductor: id_conductor
      }, function(e) {
        swal('☹', e, '');
        tabla.ajax.reload();
      });
    } else {
      swal("! Cancelado ¡", "Se Cancelo la Eliminacion del Conductor", "error");
    }
  });
}

function mostrar(id_conductor) {

  $.post("../controlador/conductores.php?op=mostrar", {
      id_conductor: id_conductor
    }, function(data, status)

    {
      data = JSON.parse(data);
      mostrarform(true);

      $("#id_conductor").val(data.id_conductor);
      $("#dni").val(data.dni);
      $("#nombres").val(data.nombres);
      $("#fecha_nacimiento").val(data.fecha_nacimiento);
      $("#contacto").val(data.contacto);
      $("#licencia").val(data.licencia);
      $("#fecha_ingreso").val(data.fecha_ingreso);
      $("#nro_seguro_social").val(data.nro_seguro_social);

    })
}

//Función para desactivar registros
function desactivar(id_conductor) {

  bootbox.confirm("¿Está Seguro de desactivar este registro?", function(result) {
    if (result) {
      $.post("../controlador/conductores.php?op=desactivar", {
        id_conductor: id_conductor
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}


//Función para activar registros
function activar(id_conductor) {
  bootbox.confirm("¿ESTÁ SEGURO DE ACTIVAR ESTE REGISTRO?", function(result) {
    if (result) {
      $.post("../controlador/conductores.php?op=activar", {
        id_conductor: id_conductor
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}
init();
/*
//Funcion para desactivar regitros
function desactivar(idconductores) {
  bootbox.confirm("¿ESTÁ SEGURO DE DESACTIVAR ESTE REGISTRO?", function(result) {
    if (result) {
      $.post("../controlador/conductores.php?op=desactivar", {
        idconductores: idconductores
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}
*/
