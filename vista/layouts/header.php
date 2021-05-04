<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ovnibus | www.ovnibus.com</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
  <link rel="shortcut icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css">
  <link rel="stylesheet" href="../css/bootstrap-select.min.css">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="../public/css/sweetalert.min.css" />

  <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">



</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>OV</b>NIVUS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ovnibus</b></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../files/imagenes/1618952971.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['usuario_nom']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../files/imagenes/1618952971.jpg" class="img-circle" alt="User Image">
                  <p>
                  <?php echo $_SESSION['usuario_nom']; ?>
                    <small>Transportes Ovnibus</small>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">

                  <div class="pull-right">
                    <a href="../controlador/Logout.php" class="btn btn-default btn-flat">Cerrar</a>
                  </div>
                </li>
              </ul>
            </li>

          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>
          <li>
            <a href="#">
              <i class="fa fa-tasks"></i> <span>Escritorio</span>
            </a>
          </li>
          <li>
            <a href="account_settings.php">
              <i class="fa fa-tasks"></i> <span>Datos Personales</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Trabajadores</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="conductores.php"><i class="fa fa-circle-o"></i> Conductores</a></li>
              <li><a href="terramoza.php"><i class="fa fa-circle-o"></i> Terramozas</a></li>
              <li><a href="personal.php"><i class="fa fa-circle-o"></i> Conductores Retirados</a></li>
              <li><a href="personalt.php"><i class="fa fa-circle-o"></i>Terramozas Retirados</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Viajes</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="itinerario.php"><i class="fa fa-circle-o"></i> itinerario</a></li>
              <li><a href="bus.php"><i class="fa fa-circle-o"></i> Bus</a></li>
              <li><a href="lugares.php"><i class="fa fa-circle-o"></i> Lugares</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Ventas</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
              <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Acceso</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="itinerario.php"><i class="fa fa-circle-o"></i>itinerario</a></li>
              <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>

            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              <small class="label pull-right bg-red">PDF</small>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
              <small class="label pull-right bg-yellow">IT</small>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
