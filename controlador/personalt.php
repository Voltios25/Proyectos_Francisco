<?php
require_once "../modelo/personalt.php";

$personalt = new personalt();

$id_terramoza=isset($_POST["id_terramoza"])? LimpiarCadena($_POST["id_terramoza"]):"";
$dni_terramoza=isset($_POST["dni_terramoza"])? LimpiarCadena($_POST["dni_terramoza"]):"";
$nombrest=isset($_POST["nombrest"])? LimpiarCadena($_POST["nombrest"]):"";
$contacto=isset($_POST["contacto"])? LimpiarCadena($_POST["contacto"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? LimpiarCadena($_POST["fecha_ingreso"]):"";
$fecha_salida=isset($_POST["fecha_salida"])? LimpiarCadena($_POST["fecha_salida"]):"";


switch($_GET["op"]){
    case 'guardaryeditar':
            $rspta=$personalt->editar($id_terramoza,$dni_terramoza,$nombrest,$contacto,$fecha_ingreso,$fecha_salida);
            echo $rspta ? "Terramoza Editada" : "Terramoza no se pudo editar";
    break;

    case 'activar':
        $rspta=$personalt->activar($id_terramoza);
        echo $rspta ? "TERRAMOZA DISPONIBLE" : "Terramoza no se pudo desactivar";

    break;

    case 'mostrar':
        $rspta=$personalt->mostrar($id_terramoza);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'listar':
        $rspta=$personalt->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
              "0"=>($reg->estado)?'<button class="btn btn-success" onclick="activar('.$reg->id_terramoza.')" ><i  class="fa fa-check"></i></button>'
              :' <button class="btn btn-success" onclick="activar('.$reg->id_terramoza.')"><i class="fa fa-check"></i></button>'

              ,
                "1"=>$reg->dni_terramoza,
                "2"=>$reg->nombrest,
                "3"=>$reg->contacto,
                "4"=>$reg->fecha_ingreso,
                "5"=>$reg->fecha_salida,
                "6"=>($reg->estado)?'<span class="label bg-red">Retirada</span>':'<span class="label bg-red">Contratada</span>'
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