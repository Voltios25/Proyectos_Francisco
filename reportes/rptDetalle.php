<?php

require_once __DIR__ . '../../vendor/autoload.php';

$html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Detalle Viaje</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo_sizesin.png" style="width:100px"/>
      </div>
      <h1>Reporte Detalle Viaje</h1>

    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service" style="text-align:center;">#</th>
            <th class="desc" style="text-align:center;">Placa Bus</th>
            <th class="desc" style="text-align:center;">Conductor</th>
            <th class="desc" style="text-align:center;">Copiloto</th>
            <th class="desc" style="text-align:center;">Terramoza</th>
            <th class="desc" style="text-align:center;">Origen</th>
            <th class="desc" style="text-align:center;">Destino</th>
          </tr>
        </thead>
        <tbody>';
        $conexion = new mysqli("localhost", "root","","bd_ovnibus");
        $consulta ="SELECT bus.placa as placaBus,c1.nombres as chofer , c2.nombres as copiloto,terramoza.nombret as terramoza,l1.nombre as origen , l2.nombre as destino FROM detalle_viaje
        INNER JOIN conductores c1 on c1.idconductores = detalle_viaje.conductor
        INNER JOIN conductores c2 on c2.idconductores = detalle_viaje.copiloto
        INNER JOIN terramoza on terramoza.idterramoza = detalle_viaje.id_terramoza
        INNER JOIN lugares l1 on l1.id_lugares = detalle_viaje.id_origen
        INNER JOIN lugares l2 on l2.id_lugares = detalle_viaje.id_destino
        INNER JOIN bus on bus.id_bus = detalle_viaje.idbus";
        $resultado = $conexion -> query($consulta);
        $contador=0;
        while($filas = $resultado ->fetch_assoc()){
          $contador++;
    $html.='<tr>
            <td class="service" style="text-align:center;">'.$contador.'</td>
            <td class="qty" style="text-align:center;">'.$filas['placaBus'].'</td>
            <td class="total" style="text-align:center;">'.$filas['chofer'].'</td>
            <td class="total" style="text-align:center;">'.$filas['copiloto'].'</td>
            <td class="total" style="text-align:center;">'.$filas['terramoza'].'</td>
            <td class="total" style="text-align:center;">'.$filas['origen'].'</td>
            <td class="total" style="text-align:center;">'.$filas['destino'].'</td>';
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
