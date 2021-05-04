<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Servicios
{
    //Constuctor
    public function __construct()
    {

    }
      //Metodo para insertar registros
      public function insertar($descripcion)
      {
          $sql = "INSERT INTO servicio(descripcion)
          VALUES($descripcion)";
          return ejecutarConsulta($sql);
      }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($idservicio)
    {
        $sql="SELECT * FROM servicio where idservicio='$idservicio'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT*FROM servicio";
        return ejecutarConsulta($sql);
    }
    //Metodo para eliminar registro
    public function eliminar($idservicio)
    {
        $sql="DELETE FROM bus WHERE idservicio='$idservicio'";
        return ejecutarConsulta($sql);
    }

    //Metodo para los selects
    public function selectS()
    {
        $sql="SELECT * FROM servicio";
        return ejecutarConsulta($sql);
    }












}
