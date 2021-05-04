<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Personal
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para activar personal
    public function activar($id_conductor)
    {
      $sql = "UPDATE conductores SET fecha_salida='0',fecha_ingreso=CURDATE() WHERE id_conductor='$id_conductor'";
      return ejecutarConsulta($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT*FROM conductores where fecha_salida!='0'";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    /*
    public function editar($id_conductor,$dni, $nombres, $contacto, $fecha_ingreso, $fecha_salida)
    {
        $sql = "UPDATE conductores SET dni='$dni', nombres='$nombres',contacto='$contacto',fecha_ingreso='$fecha_ingreso',fecha_salida='$fecha_salida'
        WHERE  id_conductor='$id_conductor'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_conductor)
    {
        $sql="SELECT * FROM conductores where id_conductor='$id_conductor'";
        return ejecutarConsultaSimpleFila($sql);
    }
    */
}
