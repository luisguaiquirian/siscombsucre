<?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}
	include_once $_SESSION['base_url'].'partials/header.php';

	$register = null;
    $options_rif = "null";
    $options_nac = "null";

 $ri = ['J','G'];
	foreach ($ri as $row) 
	{
		// letra del RIF
		$selected = $register && $register->letra_rif === $row ? 'selected=""' : '';

		$options_rif .= "<option value='{$row}' {$selected}>{$row}</option>";
	}

        $nac = ['V','E'];
	foreach ($nac as $row) 
	{
		// llenado del combo de parroquias
		$selected = $register && $register->nacionalidad === $row ? 'selected=""' : '';

		$options_nac .= "<option value='{$row}' {$selected}>{$row}</option>";
	}


		// si existe el where de modificar buscamos el registrp
		$system->table = "users";

		$register = $system->find($_SESSION['user_id']);
        
        

		$system->sql = "SELECT id_municipio,municipio,id_estado from municipios where id_estado = $register->estado";
		
		$municipios = $system->sql();
  
?>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil del usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Perfil del usuario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= $_SESSION['base_url1'].'dist/img/fotos/'.$_SESSION['foto'] ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $_SESSION['nom_es']; ?></h3>

              <p class="text-muted text-center"><?= $_SESSION['nom_perfil']; ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item text-center">
                  <b class="text-danger">Cargue una foto de perfil</b>
                </li>
              </ul>
										<div>
                                        <form name="foto_perfil" method="post" action="./operacion_foto.php" enctype="multipart/form-data">
                                        <input type="hidden" id="action" name="action" value="<?= $register ? 'update_foto' : '' ?>">
                                        <input type="hidden" name="foto" value="<?= $register->usuario ?>">
                                        <input type="hidden" name="id_modificar" value="<?= $register ? $register->id : '' ?>">
                                        
                                           <div class="form-group">
                                            <input class="input-file" type="file" name="tempo" required>
                                            </div>
                                           <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <button type="submit" class="btn btn-info btn-block">Cargar&nbsp;<i class="fa fa-send"></i></button>
                                            </div>                                            
                                            </div>
                                        </form>   

										</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Perfil</a></li>
              <li><a href="#cambiar_clave" data-toggle="tab">Cambio de Clave</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="profile">
                <!-- Post -->
                 <div class="tab-pane" id="settings">
                <form name="perfil1" class="form-horizontal" method="post" action="./operaciones.php">
                <input type="hidden" name="action" value="update_datos_usuario">
                <input type="hidden" name="id_modificar" value="<?= $register ? $register->id : '' ?>">
                
                <div class="box-body">
                <div class="form-group">
                      <label class="col-md-2 col-sm-2 control-label" for="rif">RIF:</label>                   
                       <div class="col-md-4">                     
                        <input class="form-control" id="rif" placeholder="123456789" name="rif" maxlength="9" required="" onkeypress="return valida(event)" value="<?= $register ? $register->letra_rif.'-'.$register->rif : '' ?>" readonly>
                      </div>
                      <label class="col-md-2 col-sm-2 control-label" for="usuario">Usuario:</label>
                      <div class="col-md-4">                     
                        <input class="form-control" id="usuario" readonly placeholder="" name="usuario" value="<?= $register ? $register->usuario : '' ?>">
                      </div>                
                  </div>
 					<div class="form-group">
 						<label for="" class="control-label col-md-2 col-sm-2">Estado:</label>
						<div class="col-md-4 col-sm-4">
					<select name="estado" id="estado" required="" class="form-control" readonly>
						<option value=""></option>
						<?
							$system->sql = "SELECT * from estados";
							foreach ($system->sql() as $rs) 
							{

								if($register->estado == $rs->id)
								{

									echo '<option value="'.$rs->id.'" selected>'.$rs->estado.'</option>';	
								}
								else
								{
									echo '<option value="'.$rs->id.'">'.$rs->estado.'</option>';	
								}

							}
						?>
					</select>
                        </div> 						
                        <label for="municipio" class="control-label col-md-2 col-sm-2">Municipio:</label>
						<div class="col-md-4 col-sm-4">
					<select name="municipio" id="municipio" required="" class="form-control" readonly>
						<option value=""></option>
						<?
							if($municipios)
							{
								foreach ($municipios as $rs) 
								{
									if($register->municipio == $rs->id_municipio)
									{
										echo '<option value="'.$rs->id_municipio.'" selected>'.$rs->municipio.'</option>';	
									}
									else
									{
										echo '<option value="'.$rs->id_municipio.'">'.$rs->municipio.'</option>';		
									}
								}
							}
						?>
					</select>
                        </div>
                 </div>
                <div class="form-group">
                  <label for="nombre_es" class="col-sm-2 control-label">Nombre E/S</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="nombre_es" id="nombre_es" placeholder="Nombre de la estación de servicio" onKeyUp="this.value=this.value.toUpperCase();" value="<?= $register ? $register->nombre_es : '' ?>" readonly>
                  </div>
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-md-4">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese correo electrónico" onKeyUp="this.value=this.value.toLowerCase();" value="<?= $register ? $register->email : '' ?>">
                  </div>
                           
                  </div>
                <div class="form-group">
                  <label for="direccion" class="col-sm-2 control-label">Dirección E/S</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de la estación de servicio" onKeyUp="this.value=this.value.toUpperCase();" value="<?= $register ? $register->direccion : '' ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                      <label class="col-md-2 col-sm-2 control-label" for="nacionalidad">Cédula:</label>                   
                       <div class="col-md-4">                     
                        <input class="form-control" id="cedula" placeholder="12345678" name="cedula" maxlength="8" required="" onkeypress="return valida(event)" value="<?= $register ? $register->nacionalidad.'-'.$register->cedula : '' ?>" readonly>
                      </div>
                      <label class="col-md-2 col-sm-2 control-label" for="nombre">Nombre:</label>
                      <div class="col-md-4">                     
                        <input class="form-control" id="nombre" onKeyUp="this.value=this.value.toUpperCase();" readonly placeholder="Nombre del representante" name="nombre" value="<?= $register ? $register->nombre : '' ?>">
                      </div>                
                  </div>              
                <div class="form-group">
                  <label for="nombre_es" class="col-sm-2 control-label">Apellido</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" onKeyUp="this.value=this.value.toUpperCase();" id="apellido" name="apellido" readonly placeholder="Apellido del representante" value="<?= $register ? $register->apellido : '' ?>">
                  </div>
                  <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-md-4">
                    <input class="form-control" id="telefono" placeholder="Número de Teléfono" maxlength="11" name="telefono" onkeypress="return valida(event)" value="<?= $register ? $register->telefono : '' ?>">                  
                </div>
                           
                  </div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button id="boton_enviar" type="submit" class="btn btn-info pull-right">Actualizar</button>
              </div>
              <!-- /.box-footer -->
            </form>
              </div>
              <!-- /.tab-pane -->
            </div>
               <div class="tab-pane" id="cambiar_clave">
                <form class="form-horizontal" action="./operaciones" autocomplete="off" id="form_cambiar_clave" method="post" name="form_cambiar_clave">
                    <input type="hidden" name="action" value="change_password">
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Nueva clave</label>

                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password_repeat" class="col-sm-2 control-label">Repita la nueva clave</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_repeat" name="password_repeat" required="">
                    </div>
                  </div>               
                  <div class="form-group text-center">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Cambiar clave</button>
                    </div>
                  </div>
                </form>
              </div>.
           <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <!-- Control Sidebar -->


<?
             	include_once $_SESSION['base_url'].'partials/footer.php';
                               
?>
<script>
         $('#form_cambiar_clave').submit(function(e) {
            e.preventDefault()

            let password = $('#password').val(),
                repeat = $('#password_repeat').val()
           
            if (password !== repeat) {
                toastr.error('Las contraseñas no coinciden', 'Error!')
                return false
            }
             $.ajax({
                    url: 'operaciones.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                })
                .done(function(data) {
                    if (data.r) {
                        //toastr.success('Sus datos han sido actualizados', 'Éxito!')
                        location.reload();
                    } else {
                        toastr.error('Ha ocurrido un error al tratar de ejecutar la operación', 'Error!')
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

        });             
$(function(){
        $("input[name='tempo']").on("change", function(){
            var formData = new FormData($("#foto_perfil")[0]);
            var ruta = "admin/operacion_foto.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                    location.reload();

                }
            });
        });
     });
    
$("#cedula").blur(function(){
        
			var ced = $(this).val()
            var naci = document.getElementById("nacionalidad").value;
        
        $.getJSON('./operaciones.php',{ced: ced, naci: naci, action: 'buscar_persona'}, function(data)
			{	
				if(Object.keys(data).length  > 0)
				
				{
                    var nom = data[0].nombre;
                    var ape = data[0].apellido;
                    var nombre = nom+' '+ape;
					$("#nombre").val(nombre).prop('readonly',true)
					

                        
                    }else{
			         $("#nombre").val("")
					$("#nombre").prop('readonly',false)
                    }
	
			})
		})
    $('#perfil1').submit(function(e) {
            e.preventDefault()

            $.ajax({
                    url: './operaciones.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                })
                .done(function(data) {
                    if (data.r) {
                        toastr.success('Sus datos han sido actualizados', 'Éxito!')
                        location.reload();
                    } else {
                        toastr.error('Ha ocurrido un error al tratar de ejecutar la operación', 'Error!')
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

        });  
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 || tecla==9 || tecla==0){
        return true;
    }    

        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
    
 		$("#estado").change(function(event) {
			$("#municipio").empty()
//			var municipio = $(this).val()
            var	estado = $("#estado").val(),
            datos = {
					action : 'buscar_municipio',
					estado: estado,
				}
			$.getJSON('operaciones.php',datos, function(data){
				var filas = '<option></option>'

				$.grep(data, function(i,e){
					filas += '<option value="'+i.id_municipio+'">'+i.municipio+'</option>'
				})

				$("#municipio").html(filas)
			})
		})
</script>
