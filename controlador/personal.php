<?php
require_once "../modelo/personal.php";

$personal = new Personal();

$id_conductor=isset($_POST["id_conductor"])? LimpiarCadena($_POST["id_conductor"]):"";
$dni=isset($_POST["dni"])? LimpiarCadena($_POST["dni"]):"";
$nombres=isset($_POST["nombres"])? LimpiarCadena($_POST["nombres"]):"";
$contacto=isset($_POST["contacto"])? LimpiarCadena($_POST["contacto"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? LimpiarCadena($_POST["fecha_ingreso"]):"";
$fecha_salida=isset($_POST["fecha_salida"])? LimpiarCadena($_POST["fecha_salida"]):"";


switch($_GET["op"]){
    case 'guardaryeditar':
            $rspta=$personal->editar($id_conductor,$dni,$nombres,$contacto,$fecha_ingreso,$fecha_salida);
            echo $rspta ? "Conductor Editado" : "Conductor no se pudo editar";
    break;

    case 'activar':
        $rspta=$personal->activar($id_conductor);
        echo $rspta ? "CONDUCTOR DISPONIBLE" : "Conductor no se pudo desactivar";

    break;

    case 'mostrar':
        $rspta=$personal->mostrar($id_conductor);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'listar':
        $rspta=$personal->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
              "0"=>($reg->estadoconductores)?'<button class="btn btn-success" onclick="activar('.$reg->id_conductor.')" ><i  class="fa fa-check"></i></button>'
              :' <button class="btn btn-success" onclick="activar('.$reg->id_conductor.')"><i class="fa fa-check"></i></button>'

              ,
                "1"=>$reg->dni,
                "2"=>$reg->nombres,
                "3"=>$reg->contacto,
                "4"=>$reg->fecha_ingreso,
                "5"=>$reg->fecha_salida,
                "6"=>($reg->estadoconductores)?'<span class="label bg-red">Retirado</span>':'<span class="label bg-red">Contratado</span>'
            );
        }
        $results =  array(
        "sEcho"=>1,//Imformacion para el datatables
        "iTotalRecords"=>count($data),//Enviamos el total de registros al datatables
        "iTotalDisplayRecord"=>count($data),//Enviamos el total de registros a vizualizar
        "aaData"=>$data);
        echo json_encode($results);

    break;
}
