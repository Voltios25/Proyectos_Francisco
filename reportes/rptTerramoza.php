<?php

require_once __DIR__ . '../../vendor/autoload.php';

$html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Terramoza</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo_sizesin.png"style="width:100px"/>
      </div>
      <h1>Reporte Terramoza</h1>

    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service" style="text-align:center;">#</th>
            <th class="desc" style="text-align:center;">Nombres</th>
            <th class="desc" style="text-align:center;">Edad</th>
            <th class="desc" style="text-align:center;">Direccion</th>
            <th class="desc" style="text-align:center;">Estado</th>
          </tr>
        </thead>
        <tbody>';
        $conexion = new mysqli("localhost", "root","","bd_ovnibus");
        $consulta ="select nombret,edad,direccion,estado from terramoza";
        $resultado = $conexion -> query($consulta);
        $contador=0;
        while($filas = $resultado ->fetch_assoc()){
          $contador++;
    $html.='<tr>
            <td class="service" style="text-align:center;">'.$contador.'</td>
            <td class="qty" style="text-align:center;">'.$filas['nombret'].'</td>
            <td class="total" style="text-align:center;">'.$filas['edad'].'</td>
            <td class="total" style="text-align:center;">'.$filas['direccion'].'</td>
            <td class="total" style="text-align:center;">'.$filas['estado'].'</td>';
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
