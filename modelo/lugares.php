<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class lugares
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para insertar registros
    public function insertar($imagen, $nombre, $descripcion)
    {
        $sql = "INSERT INTO lugares(imagen,nombre,descripcion)
        VALUES('$imagen','$nombre','$descripcion')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    public function editar($id_lugares, $imagen, $nombre, $descripcion)
    {
        $sql = "UPDATE lugares SET imagen='$imagen',nombre='$nombre',descripcion='$descripcion'WHERE id_lugares='$id_lugares'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_lugares)
    {
        $sql="SELECT * FROM lugares where id_lugares='$id_lugares'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * FROM lugares";
        return ejecutarConsulta($sql);
    }
    //Metodo para eliminar registro
    public function eliminar($id_lugares)
    {
        $sql="DELETE FROM lugares WHERE id_lugares='$id_lugares'";
        return ejecutarConsulta($sql);
    }
      //Metodo para los selects
      public function selectOD()
      {
          $sql="SELECT * FROM lugares";
          return ejecutarConsulta($sql);
      }


          //Metodo para los selects Estado
          public function selectE()
          {
              $sql="SELECT * FROM estado_viaje";
              return ejecutarConsulta($sql);
          }


}
