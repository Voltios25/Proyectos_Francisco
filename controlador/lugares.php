<?php
require_once "../modelo/lugares.php";

$lugares = new Lugares();

$id_lugares=isset($_POST["id_lugares"])? LimpiarCadena($_POST["id_lugares"]):"";
$imagen=isset($_POST["imagen"])? LimpiarCadena($_POST["imagen"]):"";
$nombre=isset($_POST["nombre"])? LimpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? LimpiarCadena($_POST["descripcion"]):"";

$descripcion_e=isset($_POST["descripcion"])? LimpiarCadena($_POST["descripcion_e"]):"";

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
        if(empty($id_lugares)){
            $rspta=$lugares->insertar($imagen,$nombre,$descripcion);
            echo $rspta ? "lugares registrada" : "lugares no se pudo registrar";

        }else{
            $rspta=$lugares->editar($id_lugares,$imagen,$nombre,$descripcion);
            echo $rspta ? "lugares actualizada" : "lugares no se pudo actualizar";
        }
    break;

    case 'mostrar':
        $rspta=$lugares->mostrar($id_lugares);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'eliminar':
        $rspta=$lugares->eliminar($id_lugares);
        echo  $rspta ? "Lugar Eliminado" : "Lugares no se pudo eliminar";
    break;

    case 'listar':
        $rspta=$lugares->listar();
        //Declarar un array
        $data = Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_lugares.')"><i class="fa fa-pencil"></i></button>'.
                  ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_lugares.')"><i class="fa fa-trash"></i></button>',
                "1"=>"<img src='../files/imagenes/".$reg->imagen."' height='80px' width='80px' >",
                "2"=>$reg->nombre,
                "3"=>$reg->descripcion

            );
        }
        $results =  array(
        "sEcho"=>1,//Imformacion para el datatables
        "iTotalRecords"=>count($data),//Enviamos el total de registros al datatables
        "iTotalDisplayRecord"=>count($data),//Enviamos el total de registros a vizualizar
        "aaData"=>$data);
        echo json_encode($results);

    break;

//Combo Origen Destino
    case "selectOD":
        require_once "../modelo/lugares.php";
        $lugares = new Lugares();

        $rspta=$lugares->selectOD();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->id_lugares.'>'.$reg->nombre.'</option>';
        }
    break;


    //Combo Servicios

    case "selectS":
        require_once "../modelo/servicios.php";
        $lugares = new Servicios();

        $rspta=$lugares->selectS();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idservicio.'>'.$reg->descripcion.'</option>';
        }
    break;

    //Combo Estado

    case "selectE":
        require_once "../modelo/lugares.php";
        $lugares = new lugares();

        $rspta=$lugares->selectE();

        while($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idestado.'>'.$reg->descripcion_e.'</option>';
        }
    break;


}


?>
