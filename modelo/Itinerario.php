<?php
//Incluir la conexion a la base de datos
require "../conexionDB/Conexion.php";

class Itinerarios
{
    //Constuctor
    public function __construct()
    {

    }

    //Metodo para insertar registros
    public function insertar($fecha_salida, $hora_salida, $duracion_viaje,$idconductor,$idcopiloto,$id_terramoza,$idbus,$id_origen,$id_destino,$id_servicio,$precio,$imagen,$id_estado)
    {
        $sql = "INSERT INTO itinerario(fecha_salida,hora_salida,duracion_viaje,idconductor,idcopiloto,id_terramoza,idbus,id_origen,id_destino,id_servicio,precio,imagen,id_estado)
        VALUES('$fecha_salida', '$hora_salida','$duracion_viaje', '$idconductor',
        '$idcopiloto', '$id_terramoza', '$idbus', '$id_origen', '$id_destino', '$id_servicio',
        '$precio', '$imagen' ,'$id_estado')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar registro
    public function editar($id, $fecha_salida, $hora_salida,$duracion_viaje, $idconductor,
    $idcopiloto, $id_terramoza, $idbus, $id_origen, $id_destino, $id_servicio,
    $precio, $imagen ,$id_estado)
    {
        $sql = "UPDATE itinerario SET fecha_salida = '$fecha_salida', hora_salida =  '$hora_salida',
        duracion_viaje = '$duracion_viaje' , idconductor='$idconductor', id_terramoza='$id_terramoza', idbus='$idbus',
        id_origen ='$id_origen', id_destino= '$id_destino', id_servicio= '$id_servicio', precio='$precio', imagen='$imagen',
        id_estado='$id_estado'
        WHERE id='$id'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar los datos de un registro a modificar
    public function mostrar($id)
    {
        $sql="SELECT * FROM itinerario where id='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT id, itinerario.imagen as img,precio,l1.nombre as origen,l2.nombre as destino,c1.nombres as conductor,c2.nombres as copiloto,
        itinerario.hora_salida as hora,duracion_viaje,terramoza.nombrest as terramoza, itinerario.fecha_salida as fecha,duracion_viaje,
        estado_viaje.descripcion_e as estado,bus.placa as  placa_bus,servicio.descripcion as tipos

        FROM itinerario

        INNER JOIN lugares l1 on l1.id_lugares = itinerario.id_origen
        INNER JOIN lugares l2 on l2.id_lugares = itinerario.id_destino
        INNER JOIN conductores c1 on c1.id_conductor = itinerario.idconductor
        INNER JOIN conductores c2 on c2.id_conductor = itinerario.idcopiloto
        INNER JOIN terramoza  on terramoza.id_terramoza = itinerario.id_terramoza
        INNER JOIN estado_viaje on estado_viaje.idestado = itinerario.id_estado
        INNER JOIN bus on bus.id_bus = itinerario.idbus
        INNER JOIN servicio on servicio.idservicio = itinerario.id_destino";
        return ejecutarConsulta($sql);
    }
    //Metodo para eliminar registro
    public function eliminar($id)
    {
        $sql="DELETE FROM itinerario WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

}
