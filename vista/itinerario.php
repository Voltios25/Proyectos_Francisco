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
              <h1 class="box-title">itinerario <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>Imagen</th>
                  <th>Placa</th>
                  <th>Tipo Servicio</th>
                  <th>Precio</th>
                  <th>Origen</th>
                  <th>Destino</th>
                  <th>Conductor</th>
                  <th>Copiloto</th>
                  <th>Terramoza</th>
                  <th>Fecha Salida</th>
                  <th>Hora Salida</th>
                  <th>Tiempo Estimado</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th>Imagen</th>
                  <th>Placa</th>
                  <th>Tipo Servicio</th>
                  <th>Precio</th>
                  <th>Origen</th>
                  <th>Destino</th>
                  <th>Conductor</th>
                  <th>Copiloto</th>
                  <th>Terramoza</th>
                  <th>Fecha Salida</th>
                  <th>Hora Salida</th>
                  <th>Tiempo Estimado</th>
                  <th>Estado</th>
                </tfoot>
              </table>
            </div>
            <div class="panel-body" style="height: 650px;" id="formularioregistros">
                              <form name="formulario" id="formulario" method="POST">

                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Placa Bus:</label>
                              <input type="hidden" name="id" id="id">
                              <select class="form-control selectpicker" data-Live-search="true" name="idbus" id="idbus" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Servicio:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="id_servicio" id="id_servicio" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Precio:</label>
                              <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio" required="">
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Conductor:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="idconductor" id="idconductor" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Copiloto:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="idcopiloto" id="idcopiloto" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Terramoza:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="id_terramoza" id="id_terramoza" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Salida:</label>
                              <input class="form-control" type="date" name="fecha_salida" id="fecha_salida" required=""></input>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hora Salida:</label>
                              <input class="form-control" type="time" name="hora_salida" id="hora_salida" required=""></input>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Origen:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="id_origen" id="id_origen" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Destino:</label>
                              <select class="form-control selectpicker" data-Live-search="true" name="id_destino" id="id_destino" required=""></select>
                            </div>
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tiempo Estimado:</label>
                            <input class="form-control" type="text" name="duracion_viaje" id="duracion_viaje" required=""></input>
                          </div>
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Estado Viaje:</label>
                                  <select class="form-control selectpicker" data-Live-search="true" name="id_estado" id="id_estado" required=""></select>
                                </div>
                              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Imagen:</label>
                                  <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                                  <input type="hidden" name="imagenactual" id="imagenactual">
                                  <img src="" width="150px" height="120px" id="imagenmuestra">
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

<script type="text/javascript" src="../js/itinerario.js"></script>
