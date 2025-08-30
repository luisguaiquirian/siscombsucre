 <?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}
    
	include_once $_SESSION['base_url'].'partials/header.php';

    $system->table = "users";
    $system->where = "perfil = 4";
    $tusers = $system->count();
   
    $system->table = "bitacora";
      $tbitacora = $system->count();

$system->sql = "SELECT COUNT(*) as t FROM bitacora WHERE DATE_FORMAT(fecha_carga,'%Y-%m-%d') = CURDATE() ";
            $atenhoy = $system->sql(); 

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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><?= $tbitacora[0]; ?></h3>

              <p>Listado</p>
            </div>
            <div class="icon">
              <a href="list_veh.php" class="ion ion-android-clipboard"></a>
            </div>
            <a href="list_veh.php" class="small-box-footer">Total vehiculos Registrados&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $atenhoy[0]->t; ?><sup style="font-size: 20px"></sup></h3>

              <p>Atendidos Hoy</p>
            </div>
            <div class="icon">
              <a href="consulta.php" class="ion ion-android-send"></a>
            </div>
            <a href="consulta.php" class="small-box-footer">Registro de Vehiculos&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $tusers[0]; ?></h3>

              <p>E/S registradas</p>
            </div>
            <div class="icon">
              <a href="./add.php" class="ion ion-android-add"></a>
            </div>
            <a href="./add.php" class="small-box-footer">Agregar Estación de Servicio&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Perfil</p>
            </div>
            <div class="icon">
              <a href="./perfil.php" class="ion ion-person"></a>
            </div>
            <a href="perfil.php" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

     <?    
	$system->sql = "SELECT users.id, users.email,
                    users.usuario,
                    perfiles.nombre,
                    CONCAT(users.nacionalidad,'-',users.cedula) as ced,
                    CONCAT(users.nombre,' ',users.apellido) as nomb,
                    users.telefono,
                    users.nombre_es
                    FROM
                    users
                    INNER JOIN perfiles ON perfiles.id = users.perfil
                    WHERE perfil = 4";
	$data = $system->sql();
                                                                
	$title ="Usuarios";
	$th = ['Usuario','Nombre E/S','Cédula','Nombre','Teléfono','E-mail'];
	$key_body = ['usuario','nombre_es','ced','nomb','telefono','email'];
	echo make_table($title,$th,$key_body,$data);


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
<script>

</script>