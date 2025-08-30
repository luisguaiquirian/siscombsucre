 <?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}
    
	include_once $_SESSION['base_url'].'partials/header.php';

    $fecha = date("Y-m-d");
    $fecha1 = date("d-m-Y",strtotime($fecha));

    $fe = date("Y-m-d");
    $fe1 = date("Y-m-d",strtotime($fe));

    $system->table = "bitacora";
    $tvehi = $system->count();
   
    $system->table = "bitacora";
    $system->where = "id_es=".$_SESSION['user_id'];
    $tvehies = $system->count();
   

    
$system->sql = "SELECT COUNT(*) as t FROM bitacora WHERE DATE_FORMAT(fecha_carga,'%Y-%m-%d') = CURDATE() AND id_es='".$_SESSION['user_id']."' ";
            $atenhoy = $system->sql(); 

$fecha = date("Y-m-d");
$fecha1 = date("d-m-Y",strtotime($fecha));

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><?= $tvehi[0]; ?></h3>

              <p>Total Vehiculos Registrados</p>
            </div>
            <div class="icon">
              <a href="list_veh.php" class="ion ion-android-clipboard"></a>
            </div>
            <a href="index.php" class="small-box-footer">Listado de vehículos&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
             <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $tvehies[0]; ?><sup style="font-size: 20px"></sup></h3>

              <p>Total vehículos atendidos</p>
            </div>
            <div class="icon">
              <a href="consulta.php" class="ion ion-android-search"></a>
            </div>
            <a href="consulta.php" class="small-box-footer">Registro de Vehiculos&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $atenhoy[0]->t; ?></h3>

              <p>Vehículos atendidos hoy</p>
            </div>
            <div class="icon">
              <a href="./perfil.php" class="ion ion-person"></a>
            </div>
            <a href="./perfil.php" class="small-box-footer">Perfil del usuario&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

     <?    
	$system->sql = "SELECT
CONCAT(bitacora.nacionalidad,'-',bitacora.cedula) as ced,
bitacora.nombre,
bitacora.placa,
bitacora.fecha_carga,
bitacora.nom_es
FROM    
bitacora
WHERE id_es=".$_SESSION['user_id'];
	$data = $system->sql();
                                                                
	$title ="Vehículos registrados";
	$th = ['Cédula','Nombre','placa','Fecha'];
	$key_body = ['ced','nombre','placa','fecha_carga'];
	echo make_table_es($title,$th,$key_body,$data);


?>   
   </section>      
    <!-- ./col -->
 
          </div>
      <!-- /.row -->

      <!-- /.row (main row) -->

    </section>
   
    <!-- /.content -->
          </div></div>
  <!-- /.content-wrapper -->

  <?    

	include_once $_SESSION['base_url'].'partials/footer.php';
?>