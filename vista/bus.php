<?php
session_start();
if ($_SESSION['us_tipo'] == 1) {
  include_once 'layouts/header.php';
?>


  <!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title">Buses <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                      <a target="_blank" href="../reportes/rptBus.php"> <button class="btn btn-info"> Reportes</button></a></h1></h1>
              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>Placa</th>
                  <th>Año Fabricacion</th>
                  <th>Asientos Totales</th>
                  <th>Nro Ejes</th>
                  <th>Fecha Adquisicion</th>
                  <th>Fabricante</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th>Placa</th>
                  <th>Año Fabricacion</th>
                  <th>Asientos Totales</th>
                  <th>Nro Ejes</th>
                  <th>Fecha Adquisicion</th>
                  <th>Fabricante</th>
                  <th>Estado</th>
                </tfoot>
              </table>
            </div>
            <div class="panel-body" style="height: 400px;" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Placa Bus:</label>
                            <input type="hidden" name="id_bus" id="id_bus">
                            <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Año Fabricacion:</label>
                            <input type="text" class="form-control" name="año_de_fabricacion" id="año_de_fabricacion" placeholder="Año Fabricacion" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Asientos:</label>
                            <input type="number" class="form-control" name="asientos_totales" id="asientos_totales" placeholder="Asientos" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nro Ejes:</label>
                            <input type="text" class="form-control" name="nro_ejes" id="nro_ejes" placeholder="Nro Ejes" required=""></input>
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha adquisicion:</label>
                            <input type="date" class="form-control" name="fecha_adquisicion" id="fecha_adquisicion" placeholder="Fecha Adquisicion" required=""></input>
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fabricante:</label>
                            <input type="text" class="form-control" name="fabricante" id="fabricante" placeholder="fabricante" required=""></input>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
            </div>
            <!--Fin centro -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->

  </div><!-- /.content-wrapper -->
<?php
  include_once 'layouts/footer.php';
} else {
  header('Location: ../index.php');
}
?>
<script type="text/javascript" src="../js/bus.js"></script>
