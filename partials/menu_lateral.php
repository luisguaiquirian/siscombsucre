<?
    include_once $_SESSION['base_url'].'/class/system.php';
    $system = new System;
    
?>	    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $_SESSION['base_url1'].'dist/img/fotos/'.$_SESSION['foto'].'" class="img-circle' ?>" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['nom'].' '.$_SESSION['ape'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En lìnea</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <li>
          <a href="../">
            <i class="fa fa-home"></i> <span>inicio</span>
          </a>
        </li>        
<? if($_SESSION["nivel"] < 2){ // Menú administrativo?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Estaciones de Servicio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $_SESSION['base_url1'].'app/admin/add.php' ?>"><i class="fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
 <? } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Vehículos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $_SESSION['base_url1'].'app/admin/consulta.php' ?>"><i class="fa fa-circle-o"></i> Consulta</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
