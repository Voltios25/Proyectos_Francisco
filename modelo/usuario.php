<?php
include_once 'conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Loguearse($user,$pass){
        $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where usuario_nom=:user and contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':user'=>$user,':pass'=>$pass));
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    function obtener_datos($id){
        $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and idusuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql="UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional where idusuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono, ':residencia'=>$residencia, ':correo'=>$correo, ':sexo'=>$sexo, ':adicional'=>$adicional));
    }
    function cambiar_contra($id_usuario,$oldpass,$newpass){
        $sql="SELECT * FROM usuario where idusuario=:id and contrasena_us=:oldpass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos = $query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE usuario SET contrasena_us=:newpass where idusuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo 'update';
        }
        else{
            echo 'noupdate';
        }
    }
    function cambiar_photo($id_usuario,$nombre){
        $sql="SELECT avatar FROM usuario where idusuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos = $query->fetchall();
        
            $sql="UPDATE usuario SET avatar=:nombre where idusuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        return $this->objetos;
    }
    function verificar($correo){
        $sql = "SELECT*FROM usuario where correo_us=:correo"; 
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':correo'=>$correo));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){

            if($query->rowCount()==1){
                echo 'encontrado';

            }
            else{

                echo 'noencontrado';

            }


        }
        else{

            echo 'noencontrado';

        }

    }
    function reemplazar($codigo,$correo){
     $sql = "UPDATE usuario SET contrasena_us=:codigo where correo_us=:correo";
     $query = $this->acceso->prepare($sql);
     $query->execute(array (':codigo'=>$codigo,':correo'=>$correo));
     //echo 'reemplazado';





    }
}

?>

