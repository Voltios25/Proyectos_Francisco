<?php
require_once "../modelo/Itinerario.php";

$itinerario = new Itinerarios();


$id=isset($_POST["id"])? LimpiarCadena($_POST["id"]):"";
$imagen=isset($_POST["imagen"])? LimpiarCadena($_POST["imagen"]):"";
$hora_salida=isset($_POST["hora_salida"])? LimpiarCadena($_POST["hora_salida"]):"";
$fecha_salida=isset($_POST["fecha_salida"])? LimpiarCadena($_POST["fecha_salida"]):"";
$duracion_viaje=isset($_POST["duracion_viaje"])? LimpiarCadena($_POST["duracion_viaje"]):"";
$idconductor=isset($_POST["idconductor"])? LimpiarCadena($_POST["idconductor"]):"";
$idcopiloto=isset($_POST["idcopiloto"])? LimpiarCadena($_POST["idcopiloto"]):"";
$id_terramoza=isset($_POST["id_terramoza"])? LimpiarCadena($_POST["id_terramoza"]):"";
$idbus=isset($_POST["idbus"])? LimpiarCadena($_POST["idbus"]):"";
$id_origen=isset($_POST["id_origen"])? LimpiarCadena($_POST["id_origen"]):"";
$id_destino=isset($_POST["id_destino"])? LimpiarCadena($_POST["id_destino"]):"";
$id_servicio=isset($_POST["id_servicio"])? LimpiarCadena($_POST["id_servicio"]):"";
$precio=isset($_POST["precio"])? LimpiarCadena($_POST["precio"]):"";
$id_estado=isset($_POST["id_estado"])? LimpiarCadena($_POST["id_estado"]):"";



switch($_GET["op"]){
    case 'guardaryeditar':
          if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
          {
        $imagen=$_POST["imagenactual"];
          }
        else
          {
        $ext = explode(".", $_FILES["imagen"]["name"]);
        if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
          {
          $imagen = round(microtime(true)) . '.' . end($ext);
          move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/imagenes/" . $imagen);
          }
        }
        if(empty($id)){
            if($id_origen!=$id_destino and $idcopiloto!=$idconductor){
            $rspta=$itinerario->insertar($fecha_salida, $hora_salida, $duracion_viaje,$idconductor,$idcopiloto,$id_terramoza,$idbus,$id_origen,$id_destino,$id_servicio,$precio,$imagen,$id_estado);
            echo $rspta ? "Itinerario registrado" : "Itinerario no se pudo registrar";
            }
            else{
            $rspta="";
            echo $rspta ? "Error al registrar" : "Debe Ingresar Datos Diferentes";
            }
        }else{
            $rspta=$itinerario->editar($id,$fecha_salida, $hora_salida, $duracion_viaje,$idconductor,$idcopiloto,$id_terramoza,$idbus,$id_origen,$id_destino,$id_servicio,$precio,$imagen,$id_estado);
            echo $rspta ? "Itinerario actualizado" : "Itinerario no se pudo actualizar";
        }
    break;


    case 'mostrar':
        $rspta=$itinerario->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'eliminar':
        $rspta=$itinerario->eliminar($id);
        echo  $rspta ? "Detalle Eliminado" : "Detalle no se pudo eliminar";
    break;

    case 'listar':
        $rspta=$itinerario->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=> ' <button class="btn btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>'
                .' <button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-edit"></i></button>',
                "1"=>"<img src='../files/imagenes/".$reg->img."' height='80px' width='80px' >",
                "2"=>$reg->placa_bus,
                "3"=>$reg->tipos,
                "4"=>$reg->precio,
                "5"=>$reg->origen,
                "6"=>$reg->destino,
                "7"=>$reg->conductor,
                "8"=>$reg->copiloto,
                "9"=>$reg->terramoza,
                "10"=>$reg->fecha,
                "11"=>$reg->hora,
                "12"=>$reg->duracion_viaje,
                "13"=>$reg->estado

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


?>
