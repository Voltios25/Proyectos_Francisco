<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class terramoza
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para insertar registros
    public function insertar($dni_terramoza,$nombrest,$fecha_nacimiento,$contacto,$fecha_ingreso,$nro_seguro_social)
    {
        $sql = "INSERT INTO terramoza(dni_terramoza,nombrest,fecha_nacimiento,contacto,fecha_ingreso,nro_seguro_social,estado)
        VALUES('$dni_terramoza','$nombrest','$fecha_nacimiento','$contacto','$fecha_ingreso','$nro_seguro_social','1')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    public function editar($id_terramoza,$dni_terramoza,$nombrest,$fecha_nacimiento,$contacto,$fecha_ingreso,$nro_seguro_social)
    {
        $sql = "UPDATE terramoza SET dni_terramoza='$dni_terramoza',nombrest='$nombrest',fecha_nacimiento='$fecha_nacimiento',
        contacto='$contacto',fecha_ingreso='$fecha_ingreso',nro_seguro_social='$nro_seguro_social'WHERE id_terramoza='$id_terramoza'";
        return ejecutarConsulta($sql);
    }
    //Metodo para desactivar terramoza
    public function desactivar($id_terramoza)
    {
        $sql = "UPDATE terramoza SET estado='0' WHERE id_terramoza='$id_terramoza'";
        return ejecutarConsulta($sql);
    }
    //Metodo para activar terramoza
    public function activar($id_terramoza)
    {
        $sql = "UPDATE terramoza SET estado='1' WHERE id_terramoza='$id_terramoza'";
        return ejecutarConsulta($sql);
    }

    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_terramoza)
    {
        $sql="SELECT * FROM terramoza where id_terramoza='$id_terramoza'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * FROM terramoza WHERE fecha_salida=0";
        return ejecutarConsulta($sql);
    }
    //Metodo para despedir registro
    public function despedir($id_terramoza)
    {
        $sql = "UPDATE terramoza SET fecha_salida=NOW() WHERE id_terramoza='$id_terramoza'";
        return ejecutarConsulta($sql);
    }
    //Metodo para los selects
      public function selectT()
    {
        $sql="SELECT * FROM terramoza where estado=1";
        return ejecutarConsulta($sql);
    }
        //Metodo para los selects
        public function limpiarT()
        {
            $sql="SELECT * from terramoza where estado=1 AND id_terramoza not in (SELECT id_terramoza FROM itinerario)";
            return ejecutarConsulta($sql);
        }


}
