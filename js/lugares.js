var tabla;
//Funcion que se ejecuta al inicio
function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
    });
    	$("#imagenmuestra").hide();

}
//Funcion Limpiar()
{
function limpiar(){

    $("#id_lugares").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
    $("#imagen").val("");

    }
}
//Funcion para mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if(flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else{

		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();

    }
}
//Funcion CancelarForm
function cancelarform()
{
    limpiar();
    mostrarform(false);
}

//Funcion Listar
function listar()
{
    tabla=$('#tbllistado').dataTable({

        "lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
        "aProcessing":true,//Activar el procesamiento del datatables
        "aServerSide":true,//Paginacion y filtrado realizados por el servidor
        dom:'<Bl<f>rtip>',//Definimos los elementos del control de la tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
        {
            url:'../controlador/lugares.php?op=listar',
            type:"get",
            dataType:"json",
            error:function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy":true,
        "iDisplayLength":5,//Paginacion
        "order":[[0,"desc"]]//Ordenar(columna,orden)

    }).DataTable();

}
//Funcion paa guardar y editar
function guardaryeditar(e)
{
    e.preventDefault();//No se activara la accion predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url:"../controlador/lugares.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,

        success: function(datos)
        {
           swal({
               title: 'Lugares',
               type: 'success',
               text:datos
           });
                    mostrarform(false);
                    tabla.ajax.reload();
            }
    });

    limpiar();

}
function eliminar(id_lugares){

    swal({
        title: "¿Eliminar?",
        text: "¿Está Seguro de eliminar la Lugares?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        confirmButtonColor: '#008df9',
        confirmButtonText: "Si",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
        },function(isConfirm){
        if (isConfirm){
            $.post("../controlador/lugares.php?op=eliminar", {id_lugares : id_lugares}, function(e){
                swal('☹',e,'');
                    tabla.ajax.reload();
            });
        }else {
        swal("! Cancelado ¡", "Se Cancelo la Eliminacion de la Lugares", "error");
     }
    });
}
function mostrar(id_lugares)
{

    $.post("../controlador/lugares.php?op=mostrar",{id_lugares:id_lugares},function(data,status)

    {
        data=JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#id_lugares").val(data.id_lugares);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/imagenes/"+data.imagen);
        $("#imagenactual").val(data.imagen);

    })
}

//Función para desactivar registros
function desactivar(id_lugares)
{

    bootbox.confirm("¿Está Seguro de desactivar este registro?", function(result){
		if(result)
        {
        	$.post("../controlador/lugares.php?op=desactivar", {id_lugares : id_lugares}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


//Función para activar registros
function activar(id_lugares)
{
	bootbox.confirm("¿ESTÁ SEGURO DE ACTIVAR ESTE REGISTRO?", function(result){
		if(result)
        {
        	$.post("../controlador/lugares.php?op=activar", {id_lugares : id_lugares}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}
//Funcion para desactivar regitros
function desactivar(id_lugares)
{
	bootbox.confirm("¿ESTÁ SEGURO DE DESACTIVAR ESTE REGISTRO?", function(result){
		if(result)
        {
        	$.post("../controlador/lugares.php?op=desactivar", {id_lugares : id_lugares}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}




init();
