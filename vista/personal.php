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
              <h1 class="box-title">Conductores Retirados </button><a target="_blank" href="../reportes/rptConductor.php"> <button class="btn btn-info"> Reporte</button></a></h1>
              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>DNI</th>
                  <th>Nombres</th>
                  <th>Contacto</th>
                  <th>Fecha Ingreso</th>
                  <th>Fecha Salida</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th>DNI</th>
                  <th>Nombres</th>
                  <th>Contacto</th>
                  <th>Fecha Ingreso</th>
                  <th>Fecha Salida</th>
                  <th>Estado</th>
                </tfoot>
              </table>
            </div>
            <div class="panel-body" style="height: 400px;" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>DNI:</label>
                            <input type="text"  class="form-control" name="dni" id="dni" placeholder="DNI" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contacto:</label>
                            <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Contacto" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Ingreso:</label>
                            <input type="text" class="form-control" name="fecha_ingreso" id="fecha_ingreso" placeholder="Fecha Ingreso" required="">
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Salida:</label>
                            <input type="text" class="form-control" name="fecha_salida" id="fecha_salida" placeholder="Fecha Salida" required="">
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
<script type="text/javascript" src="../js/personal.js"></script>
