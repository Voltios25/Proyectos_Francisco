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
                            <h1 class="box-title">Escritorio</h1>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- centro -->
                        <div class="panel-body">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h4 style="font-size:17px">
                                            <strong>S/0.00</strong>
                                        </h4>
                                        <p>Compras</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Compras <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h4 style="font-size:17px">
                                            <strong>S/0.00</strong>
                                        </h4>
                                        <p>Ventas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                    Compras de los ultimos 10 dias
                                    </div>
                                    <div class="box-body">

                                        <canvas id="compras" width="400" height="300">
                                        
                                        
                                        </canvas>
                                    
                                    
                                    
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--Fin centro -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->








    <!-- Fin modal -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>

<script src="../js/Chart.bundle.min.js"></script>
<script src="../js/Chart.min.js"></script>
