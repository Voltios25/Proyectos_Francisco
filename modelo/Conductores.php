<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Conductores
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para insertar registros
    public function insertar($dni, $nombres, $fecha_nacimiento, $contacto, $licencia, $fecha_ingreso, $nro_seguro_social)
    {
        $sql = "INSERT INTO conductores(dni,nombres,fecha_nacimiento,contacto,licencia,fecha_ingreso,nro_seguro_social,estadoconductores)
        VALUES('$dni','$nombres','$fecha_nacimiento','$contacto','$licencia','$fecha_ingreso','$nro_seguro_social','1')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    public function editar($id_conductor,$dni,$nombres,$fecha_nacimiento,$contacto,$licencia,$fecha_ingreso,$nro_seguro_social)
    {
        $sql = "UPDATE conductores SET dni='$dni' ,nombres='$nombres',fecha_nacimiento='$fecha_nacimiento',contacto='$contacto',licencia='$licencia',
        fecha_ingreso='$fecha_ingreso',nro_seguro_social='$nro_seguro_social' WHERE id_conductor='$id_conductor'";
        return ejecutarConsulta($sql);
    }
    //Metodo para desactivar conductores
    public function desactivar($id_conductor)
    {
        $sql = "UPDATE conductores SET estadoconductores='0'WHERE id_conductor='$id_conductor'";
        return ejecutarConsulta($sql);
    }
    //Metodo para activar conductores
    public function activar($id_conductor)
    {
        $sql = "UPDATE conductores SET estadoconductores='1' WHERE id_conductor='$id_conductor'";
        return ejecutarConsulta($sql);
    }
    public function despedir($id_conductor)
    {
        $sql = "UPDATE conductores SET fecha_salida=NOW() WHERE id_conductor='$id_conductor'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_conductor)
    {
        $sql="SELECT * FROM conductores where id_conductor='$id_conductor'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT*FROM conductores where fecha_salida='0'";
        return ejecutarConsulta($sql);
    }


    public function limpiar_chofer()
    {
        $sql="SELECT * from conductores where (estadoconductores=1) and fecha_salida='0' AND id_conductor not in (SELECT idconductor FROM itinerario)";
        return ejecutarConsulta($sql);
    }

    public function limpiar_copiloto()
    {
        $sql="SELECT * from conductores where (estadoconductores=1) and fecha_salida='0' AND id_conductor not in (SELECT idcopiloto FROM itinerario)";
        return ejecutarConsulta($sql);
    }

    //Metodo para eliminar registro
    /*
    public function eliminar($idconductores)
    {
        $sql="DELETE FROM conductores WHERE idconductores='$idconductores'";
        return ejecutarConsulta($sql);
    }

    //Metodo para los selects
    public function selectC()
    {
        $sql="SELECT * FROM conductores where estadoconductores=1";
        return ejecutarConsulta($sql);
    }


    */

}
