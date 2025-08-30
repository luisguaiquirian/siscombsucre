<?
  include_once $_SESSION['base_url'].'/class/system.php';
  include_once $_SESSION['base_url'].'/helpers/view_functions.php';
    $_SESSION['base_perfil'] = $_SESSION['base_url1'].explode('/',$_SERVER['REQUEST_URI'])[2].'/'.explode('/',$_SERVER['REQUEST_URI'])[3].'/';

  System::validar_logueo();
  
  $system = new System; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisCom Sucre</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/bootstrap/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/Ionicons/css/ionicons.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'dist/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'dist/css/skins/_all-skins.min.css' ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/morrisjs/morris.css' ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/jvectormap/jquery-jvectormap.css' ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/bootstrap-daterangepicker/daterangepicker.css' ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' ?>">
  
    <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css' ?>">

    <link rel="stylesheet" href="<?= $_SESSION['base_url1'].'dist/css/toastr.min.css' ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>CS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sis</b>COMB Sucre</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene 0 mensajes</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <!--<a href="#">
                      <div class="pull-left">
                        <img src="<?= $_SESSION['base_url1'].'dist/img/fotos/'.$_SESSION['foto'] ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todos los Mensajes</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene 0 notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>-->
              <li class="footer"><a href="#">Ver todas</a></li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $_SESSION['base_url1'].'dist/img/fotos/'.$_SESSION['foto'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['nom'].' '.$_SESSION['ape'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $_SESSION['base_url1'].'dist/img/fotos/'.$_SESSION['foto'] ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $_SESSION['nom'].' '.$_SESSION['ape'].' - '.$_SESSION['nom_perfil'] ?>
                  <!--<small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="./perfil.php " class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <? $ruta_logout = substr($_SESSION['base_url1'], 0, strlen($_SESSION['base_url1']) -1); ?>                 
                  <a href="<?= $ruta_logout.'?logout=1' ?>" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
      <?
        include_once 'menu_lateral.php';
      ?>  