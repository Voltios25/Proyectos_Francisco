<?php
require_once "../modelo/Conductores.php";

$conductores = new Conductores();

$id_conductor=isset($_POST["id_conductor"])? LimpiarCadena($_POST["id_conductor"]):"";
$dni=isset($_POST["dni"])? LimpiarCadena($_POST["dni"]):"";
$nombres=isset($_POST["nombres"])? LimpiarCadena($_POST["nombres"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? LimpiarCadena($_POST["fecha_nacimiento"]):"";
$contacto=isset($_POST["contacto"])? LimpiarCadena($_POST["contacto"]):"";
$licencia=isset($_POST["licencia"])? LimpiarCadena($_POST["licencia"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? LimpiarCadena($_POST["fecha_ingreso"]):"";
$nro_seguro_social=isset($_POST["nro_seguro_social"])? LimpiarCadena($_POST["nro_seguro_social"]):"";

switch($_GET["op"]){
    case 'guardaryeditar':
        if(empty($id_conductor)){
            $rspta=$conductores->insertar($dni,$nombres,$fecha_nacimiento,$contacto,$licencia,$fecha_ingreso,$nro_seguro_social);
            echo $rspta ? "Conductor registrado" : "Conductor no se pudo registrar";

        }else{
            $rspta=$conductores->editar($id_conductor,$dni,$nombres,$fecha_nacimiento,$contacto,$licencia,$fecha_ingreso,$nro_seguro_social);
            echo $rspta ? "Conductor actualizado" : "Conductor no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta=$conductores->desactivar($id_conductor);
        echo $rspta ? "CONDUCTOR OCUPADO" : "Conductor no se pudo desactivar";
    break;

    case 'activar':
        $rspta=$conductores->activar($id_conductor);
        echo $rspta ? "CONDUCTOR DISPONIBLE" : "Conductor no se pudo desactivar";

    break;
    case 'despedir':
        $rspta=$conductores->despedir($id_conductor);
        echo $rspta ? "CONDUCTOR DESPEDIDO" : "Conductor no se pudo despedir";

    break;

    case 'mostrar':
        $rspta=$conductores->mostrar($id_conductor);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'listar':
        $rspta=$conductores->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->estadoconductores)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_conductor.')" ><i  class="fa fa-edit"></i></button>'
                .' <button class="btn btn-success" onclick="despedir('.$reg->id_conductor.')"><i class="fa fa-trash"></i></button>'
                .' <button class="btn btn-danger" onclick="desactivar('.$reg->id_conductor.')"><i class="fa fa-wrench"></i></button>':
                ' <button class="btn btn-warning" onclick="mostrar('.$reg->id_conductor.')"><i class="fa fa-edit"></i></button>'
                .' <button class="btn btn-primary" onclick="activar('.$reg->id_conductor.')"><i class="fa fa-bus"></i></button>'
                ,
                "1"=>$reg->dni,
                "2"=>$reg->nombres,
                "3"=>$reg->fecha_nacimiento,
                "4"=>$reg->contacto,
                "5"=>$reg->licencia,
                "6"=>$reg->fecha_ingreso,
                "7"=>$reg->nro_seguro_social,
                "8"=>($reg->estadoconductores)?'<span class="label bg-green">Disponible</span>':'<span class="label bg-red">Ocupado</span>'
            );
        }
        $results =  array(
        "sEcho"=>1,//Imformacion para el datatables
        "iTotalRecords"=>count($data),//Enviamos el total de registros al datatables
        "iTotalDisplayRecord"=>count($data),//Enviamos el total de registros a vizualizar
        "aaData"=>$data);
        echo json_encode($results);

    break;

/*
    case "selectC":
        require_once "../modelo/Conductores.php";
        $conductores = new Conductores();

        $rspta=$conductores->selectC();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_conductor.'>'.$reg->nombres.'</option>';
        }
    break;
    */
    case "limpiar_chofer":
        require_once "../modelo/Conductores.php";
        $conductores = new Conductores();

        $rspta=$conductores->limpiar_chofer();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_conductor.'>'.$reg->nombres.'</option>';
        }
    break;
    case "limpiar_copiloto":
        require_once "../modelo/Conductores.php";
        $conductores = new Conductores();

        $rspta=$conductores->limpiar_copiloto();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_conductor.'>'.$reg->nombres.'</option>';
        }
    break;





}


?>
