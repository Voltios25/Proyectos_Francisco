<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Buses
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para insertar registros
    public function insertar($placa,$año_de_fabricacion,$asientos_totales,$nro_ejes,$fecha_adquisicion,$fabricante)
    {
        $sql = "INSERT INTO bus(placa,año_de_fabricacion,asientos_totales,nro_ejes,fecha_adquisicion,fabricante,estado)
        VALUES($placa','$año_de_fabricacion','$asientos_totales','$nro_ejes','$fecha_adquisicion','$fabricante',1)";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    public function editar($id_bus,$placa, $año_de_fabricacion, $asientos_totales, $nro_ejes,$fecha_adquisicion,$fabricante)
    {
        $sql = "UPDATE bus SET placa='$placa',año_de_fabricacion='$año_de_fabricacion',asientos_totales='$asientos_totales',nro_ejes='$nro_ejes',
        fecha_adquisicion='$fecha_adquisicion',fabricante='$fabricante'
        WHERE id_bus='$id_bus'";
        return ejecutarConsulta($sql);
    }
    //Metodo para desactivar el bus
    public function desactivar($id_bus)
    {
        $sql = "UPDATE bus SET estado='0' WHERE id_bus='$id_bus'";
        return ejecutarConsulta($sql);
    }
    //Metodo para activar conductores
    public function activar($id_bus)
    {
        $sql = "UPDATE bus SET estado='1' WHERE id_bus='$id_bus'";
        return ejecutarConsulta($sql);
    }

    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id_bus)
    {
        $sql="SELECT * FROM bus where id_bus='$id_bus'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * FROM bus";
        return ejecutarConsulta($sql);
    }
    //Metodo para eliminar registro
    public function eliminar($id_bus)
    {
        $sql="DELETE FROM bus WHERE id_bus='$id_bus'";
        return ejecutarConsulta($sql);
    }

    //Metodo para los selects
    public function selectP()
    {
        $sql="SELECT * FROM bus where estado=1";
        return ejecutarConsulta($sql);
    }
    public function limpiar_placa()
    {
        $sql="SELECT * from bus where estado=1 AND  id_bus not in (SELECT idbus FROM itinerario)";
        return ejecutarConsulta($sql);
    }









}
