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

    $("#dni_terramoza").val("");
    $("#nombrest").val("");
    $("#contacto").val("");
    $("#fecha_ingreso").val("");
    $("#fecha_salida").val("");
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
      url: '../controlador/personalt.php?op=listar',
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
    url: "../controlador/personalt.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      swal({
        title: 'Personal Actualizado',
        type: 'success',
        text: datos
      });
      mostrarform(false);
      tabla.ajax.reload();
    }
  });

  limpiar();

}

function mostrar(id_terramoza) {

  $.post("../controlador/personalt.php?op=mostrar", {
      id_terramoza: id_terramoza
    }, function(data, status)

    {
      data = JSON.parse(data);
      mostrarform(true);

      $("#dni_terramoza").val(data.dni_terramoza);
      $("#nombrest").val(data.nombrest);
      $("#fecha_nacimiento").val(data.fecha_nacimiento);
      $("#contacto").val(data.contacto);
      $("#fecha_ingreso").val(data.fecha_ingreso);
      $("#fecha_salida").val(data.fecha_salida);


    })
}

//Función para activar registros
function activar(id_terramoza) {
  bootbox.confirm("¿ESTÁ SEGURO DE ACTIVAR ESTE REGISTRO?", function(result) {
    if (result) {
      $.post("../controlador/personalt.php?op=activar", {
        id_terramoza: id_terramoza
      }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}

init();