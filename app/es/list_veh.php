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

$fecha = date("Y-m-d");
$fecha1 = date("d-m-Y",strtotime($fecha));

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Listado de Vehículos
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehículos registrados</li>
      </ol>
    </section> 
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
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
                                                                
	$title ="";
	$th = ['Cédula','Nombre','placa','Fecha','Estación de Servicio'];
	$key_body = ['ced','nombre','placa','fecha_carga','nom_es'];
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
<script>

</script>