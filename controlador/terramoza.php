<?php
require_once "../modelo/terramoza.php";

$terramoza = new Terramoza();

$id_terramoza=isset($_POST["id_terramoza"])? LimpiarCadena($_POST["id_terramoza"]):"";
$dni_terramoza=isset($_POST["dni_terramoza"])? LimpiarCadena($_POST["dni_terramoza"]):"";
$nombrest=isset($_POST["nombrest"])? LimpiarCadena($_POST["nombrest"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? LimpiarCadena($_POST["fecha_nacimiento"]):"";
$contacto=isset($_POST["contacto"])? LimpiarCadena($_POST["contacto"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? LimpiarCadena($_POST["fecha_ingreso"]):"";
$nro_seguro_social=isset($_POST["nro_seguro_social"])? LimpiarCadena($_POST["nro_seguro_social"]):"";

switch($_GET["op"]){
    case 'guardaryeditar':
        if(empty($id_terramoza)){
            $rspta=$terramoza->insertar($dni_terramoza,$nombrest,$fecha_nacimiento,$contacto,$fecha_ingreso,$nro_seguro_social);
            echo $rspta ? "Terramoza registrada" : "terramoza no se pudo registrar";

        }else{
            $rspta=$terramoza->editar($id_terramoza,$dni_terramoza,$nombrest,$fecha_nacimiento,$contacto,$fecha_ingreso,$nro_seguro_social);
            echo $rspta ? "Terramoza actualizada" : "terramoza no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta=$terramoza->desactivar($id_terramoza);
        echo $rspta ? "TERRAMOZA OCUPADA" : "terramoza no se pudo desactivar";
    break;

    case 'activar':
        $rspta=$terramoza->activar($id_terramoza);
        echo $rspta ? "TERRAMOZA DISPONIBLE" : "terramoza no se pudo desactivar";

    break;

    case 'mostrar':
        $rspta=$terramoza->mostrar($id_terramoza);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'despedir':
        $rspta=$terramoza->despedir($id_terramoza);
        echo  $rspta ? "Terramoza Despedida" : "Terramoza no se pudo Despedir";
    break;

    case 'listar':
        $rspta=$terramoza->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_terramoza.')" ><i  class="fa fa-edit"></i></button>'
                .' <button class="btn btn-success" onclick="despedir('.$reg->id_terramoza.')"><i class="fa fa-trash"></i></button>'
                .' <button class="btn btn-danger" onclick="desactivar('.$reg->id_terramoza.')"><i class="fa fa-wrench"></i></button>':
                ' <button class="btn btn-warning" onclick="mostrar('.$reg->id_terramoza.')"><i class="fa fa-edit"></i></button>'
                .' <button class="btn btn-primary" onclick="activar('.$reg->id_terramoza.')"><i class="fa fa-bus"></i></button>'
                ,
                "1"=>$reg->dni_terramoza,
                "2"=>$reg->nombrest,
                "3"=>$reg->fecha_nacimiento,
                "4"=>$reg->contacto,
                "5"=>$reg->fecha_ingreso,
                "6"=>$reg->nro_seguro_social,
                "7"=>($reg->estado)?'<span class="label bg-green">Habilitado</span>':'<span class="label bg-red">Desabilitado</span>'
            );
        }
        $results =  array(
        "sEcho"=>1,//Imformacion para el datatables
        "iTotalRecords"=>count($data),//Enviamos el total de registros al datatables
        "iTotalDisplayRecord"=>count($data),//Enviamos el total de registros a vizualizar
        "aaData"=>$data);
        echo json_encode($results);

    break;
    case "selectT":
        require_once "../modelo/terramoza.php";
        $terramoza = new Terramoza();

        $rspta=$terramoza->selectT();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_terramoza.'>'.$reg->nombrest.'</option>';
        }
    break;
    case "selectT":
        require_once "../modelo/terramoza.php";
        $terramoza = new Terramoza();

        $rspta=$terramoza->selectT();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_terramoza.'>'.$reg->nombrest.'</option>';
        }
    break;
    case "limpiarT":
        require_once "../modelo/terramoza.php";
        $terramoza = new Terramoza();

        $rspta=$terramoza->limpiarT();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_terramoza.'>'.$reg->nombrest.'</option>';
        }
    break;




}


?>
