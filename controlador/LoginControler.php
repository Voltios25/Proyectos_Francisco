<?php
include_once '../modelo/usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();

//Permisos
//Empty(Verifica si la variable esta vacia)
//Si las variables usario y objetos no esta vacia
if(!empty($_SESSION['us_tipo'])){
 
    switch($_SESSION['us_tipo']){
        case 1:
            header('Location: ../vista/conductores.php');
            break;

        case 2:
                header('Location: ../vista/asistente.php');
            break;
    }
}
else{

    $usuario->Loguearse($user,$pass);
    if(!empty($usuario->objetos))
{
    foreach ($usuario->objetos as $objeto) {
        //Variable session contendra 
        $_SESSION['usuario']=$objeto->idusuario;
        $_SESSION['us_tipo']=$objeto->us_tipo;
        $_SESSION['usuario_nom']=$objeto->usuario_nom;

    }
    //Para verificar que tipo de usuario a iniciado sesion
    switch($_SESSION['us_tipo']){
        case 1:
            header('Location: ../vista/conductores.php');
            break;

        case 2:
                header('Location: ../vista/asistente.php');
            break;
    }
}
else{
    header('Location: ../index.php');
}



    

}


?>