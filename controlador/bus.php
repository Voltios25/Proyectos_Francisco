<?php
require_once "../modelo/Bus.php";

$bus = new Buses();

$id_bus=isset($_POST["id_bus"])? LimpiarCadena($_POST["id_bus"]):"";
$placa=isset($_POST["placa"])? LimpiarCadena($_POST["placa"]):"";
$año_de_fabricacion=isset($_POST["año_de_fabricacion"])? LimpiarCadena($_POST["año_de_fabricacion"]):"";
$asientos_totales=isset($_POST["asientos_totales"])? LimpiarCadena($_POST["asientos_totales"]):"";
$nro_ejes=isset($_POST["nro_ejes"])? LimpiarCadena($_POST["nro_ejes"]):"";
$fecha_adquisicion=isset($_POST["fecha_adquisicion"])? LimpiarCadena($_POST["fecha_adquisicion"]):"";
$fabricante=isset($_POST["fabricante"])? LimpiarCadena($_POST["fabricante"]):"";


switch($_GET["op"]){
    case 'guardaryeditar':
        if(empty($id_bus)){
            $rspta=$bus->insertar($placa,$año_de_fabricacion,$asientos_totales,$nro_ejes,$fecha_adquisicion,$fabricante);
            echo $rspta ? "Bus registrado" : "Bus no se pudo registrar";

        }else{
            $rspta=$bus->editar($id_bus,$placa,$año_de_fabricacion,$asientos_totales,$nro_ejes,$fecha_adquisicion,$fabricante);
            echo $rspta ? "Bus actualizado" : "Bus no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta=$bus->desactivar($id_bus);
        echo $rspta ? "BUS OCUPADO" : "Bus no se pudo desactivar";
    break;

    case 'activar':
        $rspta=$bus->activar($id_bus);
        echo $rspta ? "BUS DISPONIBLE" : "Bus no se pudo desactivar";

    break;

    case 'mostrar':
        $rspta=$bus->mostrar($id_bus);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'eliminar':
        $rspta=$bus->eliminar($id_bus);
        echo  $rspta ? "Bus Eliminado" : "Bus no se pudo borrar";
    break;

    case 'listar':
        $rspta=$bus->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_bus.')" ><i  class="fa fa-edit"></i></button>'
                .' <button class="btn btn-success" onclick="eliminar('.$reg->id_bus.')"><i class="fa fa-trash"></i></button>'
                .' <button class="btn btn-danger" onclick="desactivar('.$reg->id_bus.')"><i class="fa fa-wrench"></i></button>':
                ' <button class="btn btn-warning" onclick="mostrar('.$reg->id_bus.')"><i class="fa fa-edit"></i></button>'
                .' <button class="btn btn-primary" onclick="activar('.$reg->id_bus.')"><i class="fa fa-bus"></i></button>'
                ,
                "1"=>$reg->placa,
                "2"=>$reg->año_de_fabricacion,
                "3"=>$reg->asientos_totales,
                "4"=>$reg->nro_ejes,
                "5"=>$reg->fecha_adquisicion,
                "6"=>$reg->fabricante,
                "7"=>($reg->estado)?'<span class="label bg-green">Disponible</span>':'<span class="label bg-red">Deshabilitado</span>'
            );
        }
        $results =  array(
        "sEcho"=>1,//Imformacion para el datatables
        "iTotalRecords"=>count($data),//Enviamos el total de registros al datatables
        "iTotalDisplayRecord"=>count($data),//Enviamos el total de registros a vizualizar
        "aaData"=>$data);
        echo json_encode($results);

    break;
    case "selectP":
        require_once "../modelo/Bus.php";
        $bus = new Buses();

        $rspta=$bus->selectP();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_bus.'>'.$reg->placa.'</option>';
        }
    break;

    case "selectS":
        require_once "../modelo/servicios.php";
        $bus = new Buses();

        $rspta=$bus->selectS();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idservicio.'>'.$reg->descripcion.'</option>';
        }
    break;

    case "limpiar_placa":
        require_once "../modelo/bus.php";
        $bus = new Buses();

        $rspta=$bus->limpiar_placa();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_bus.'>'.$reg->placa.'</option>';
        }
    break;





    }
