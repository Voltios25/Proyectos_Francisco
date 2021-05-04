<?php

require_once __DIR__ . '../../vendor/autoload.php';

$html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Itinerario </title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo_sizesin.png"style="width:100px"/>
      </div>
      <h1>Reporte Bus</h1>

    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service" style="text-align:center;">#</th>
            <th class="desc" style="text-align:center;">Placa</th>
            <th class="desc" style="text-align:center;">Tipo Servicio</th>
            <th class="desc" style="text-align:center;">Precio</th>
            <th class="desc" style="text-align:center;">Origen</th>
            <th class="desc" style="text-align:center;">Destino</th>
            <th class="desc" style="text-align:center;">Conductor</th>
            <th class="desc" style="text-align:center;">Copiloto</th>
            <th class="desc" style="text-align:center;">Terramoza</th>
            <th class="desc" style="text-align:center;">Hora Salida</th>
            <th class="desc" style="text-align:center;">Tiempo Estimado</th>
            <th class="desc" style="text-align:center;">Estado</th>
          </tr>
        </thead>
        <tbody>';
        $conexion = new mysqli("localhost", "root","","bd_ovnibus");
        $consulta ="select * from bus";
        $resultado = $conexion -> query($consulta);
        $contador=0;
        while($filas = $resultado ->fetch_assoc()){
          $contador++;
    $html.='<tr>
            <td class="service" style="text-align:center;">'.$contador.'</td>
            <td class="qty" style="text-align:center;">'.$filas['placa'].'</td>
            <td class="qty" style="text-align:center;">'.$filas['año_de_fabricacion'].'</td>
            <td class="total" style="text-align:center;">'.$filas['asientos_totales'].'</td>
            <td class="total" style="text-align:center;">'.$filas['nro_ejes'].'</td>
            <td class="total" style="text-align:center;">'.$filas['fecha_adquisicion'].'</td>
            <td class="total" style="text-align:center;">'.$filas['fabricante'].'</td>
                              ';
            }

    $html.='</tr>
        </tbody>
      </table>
    </main>
    <footer>
    Empresa Transportes Ovnibus
    </footer>
  </body>
</html>';
$mpdf = new \Mpdf\Mpdf();
$css = file_get_contents('../css/reportes.css');
$mpdf ->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();
