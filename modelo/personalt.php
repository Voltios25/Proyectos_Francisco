<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Personalt
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para activar personalt
    public function activar($id_terramoza)
    {
      $sql = "UPDATE terramoza SET fecha_salida='0',fecha_ingreso=CURDATE() WHERE id_terramoza='$id_terramoza'";
      return ejecutarConsulta($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT*FROM terramoza where fecha_salida!='0'";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    /*
    public function editar($id_terramoza,$dni, $nombres, $contacto, $fecha_ingreso, $fecha_salida)
    {
        $sql = "UPDATE terramozas SET dni='$dni', nombres='$nombres',contacto='$contacto',fecha_ingreso='$fecha_ingreso',fecha_salida='$fecha_salida'
        WHERE  id_terramoza='$id_terramoza'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_terramoza)
    {
        $sql="SELECT * FROM terramozas where id_terramoza='$id_terramoza'";
        return ejecutarConsultaSimpleFila($sql);
    }
    */
}
