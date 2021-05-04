<?php

require_once __DIR__ . '../../vendor/autoload.php';

$html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Conductores </title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo_sizesin.png"style="width:100px"/>
      </div>
      <h1>Reporte Conductor</h1>

    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service" style="text-align:center;">#</th>
            <th class="desc" style="text-align:center;">DNI</th>
            <th class="desc" style="text-align:center;">Nombres</th>
            <th class="desc" style="text-align:center;">Fecha Nacimiento</th>
            <th class="desc" style="text-align:center;">Contacto</th>
            <th class="desc" style="text-align:center;">Licencia</th>
            <th class="desc" style="text-align:center;">Fecha Ingreso</th>
            <th class="desc" style="text-align:center;">Nro Seguro Social</th>
          </tr>
        </thead>
        <tbody>';
        $conexion = new mysqli("localhost", "root","","bd_ovnibus");
        $consulta ="select dni,nombres,fecha_nacimiento,contacto,licencia,fecha_ingreso,nro_seguro_social from conductores where fecha_salida=0";
        $resultado = $conexion -> query($consulta);
        $contador=0;
        while($filas = $resultado ->fetch_assoc()){
          $contador++;
    $html.='<tr>
            <td class="service" style="text-align:center;">'.$contador.'</td>
            <td class="qty" style="text-align:center;">'.$filas['dni'].'</td>
            <td class="qty" style="text-align:center;">'.$filas['nombres'].'</td>
            <td class="total" style="text-align:center;">'.$filas['fecha_nacimiento'].'</td>
            <td class="total" style="text-align:center;">'.$filas['contacto'].'</td>
            <td class="total" style="text-align:center;">'.$filas['licencia'].'</td>
            <td class="total" style="text-align:center;">'.$filas['fecha_ingreso'].'</td>
            <td class="total" style="text-align:center;">'.$filas['nro_seguro_social'].'</td>
            <td class="total" style="text-align:center;">'.$filas['estadoconductores'].'</td>';
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
