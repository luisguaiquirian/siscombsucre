<?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}
	include_once $_SESSION['base_url'].'partials/header.php';

	$register = null;
    $options_nac = "";
    $options_rif = "";
if(isset($_GET['modificar']))
	{
		// si existe el where de modificar buscamos el registrp
		$system->table = "users";

		$register = $system->find(base64_decode($_GET['modificar']));
    
		$system->sql = "SELECT id_municipio,municipio,id_estado from municipios where id_estado = $register->estado";
		
		$municipios = $system->sql();	
        
        
	}
    $nac = ['V','E'];
	foreach ($nac as $row) 
	{
		// llenado del combo de parroquias
		$selected = $register && $register->nacionalidad === $row ? 'selected=""' : '';

		$options_nac .= "<option value='{$row}' {$selected}>{$row}</option>";
	}

    $ri = ['J','G'];
	foreach ($ri as $row) 
	{
		// llenado del combo de parroquias
		$selected = $register && $register->letra_rif === $row ? 'selected=""' : '';

		$options_rif .= "<option value='{$row}' {$selected}>{$row}</option>";
	}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar nueva estación de servicio
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Admin</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
    			<form action="./operaciones.php" class="form-horizontal" id="form_registrar" method="POST">
		
				<input type="hidden" name="id_modificar" value="<?= $register ? $register->id : '' ?>">
				<input id="foto" type="hidden" name="foto" value="fototemp.png">
				<input id="perfil" type="hidden" name="perfil" value="4">
				<input id="activo" type="hidden" name="activo" value="1">
				<input id="password_activo" type="hidden" name="password_activo" value="0">
				<input id="password" type="hidden" name="password" value="<?= password_hash('123456789',PASSWORD_DEFAULT) ?>">
				<input type="hidden" id="action" name="action" value="<?= $register ? 'modificar' : 'grabar' ?>">
                
                <div class="box-body">
                <div class="form-group">
                      <label class="col-md-2 col-sm-2 control-label" for="letra">RIF:</label>
                        <div class="col-md-1">                     
                        <select class="form-control" name="letra_rif" id="letra_rif" required="">
                        <?= $options_rif ?>
                        </select>
                      </div>                    
                       <div class="col-md-3">                     
                        <input class="form-control" id="rif" placeholder="123456789" name="rif" maxlength="9" required="" onkeypress="return valida(event)" value="<?= $register ? $register->rif : '' ?>">
                      </div>
                      <label class="col-md-2 col-sm-2 control-label" for="usuario">Usuario:</label>
                      <div class="col-md-4">                     
                        <input class="form-control" id="usuario" readonly placeholder="" name="usuario" value="<?= $register ? $register->usuario : '' ?>">
                      </div>                
                  </div>
 					<div class="form-group">
 						<label for="" class="control-label col-md-2 col-sm-2">Estado:</label>
						<div class="col-md-4 col-sm-4">
					<select name="estado" id="estado" required="" class="form-control">
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
					<select name="municipio" id="municipio" required="" class="form-control">
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
                    <input type="text" class="form-control" name="nombre_es" id="nombre_es" placeholder="Nombre de la estación de servicio" onKeyUp="this.value=this.value.toUpperCase();" value="<?= $register ? $register->nombre_es : '' ?>">
                  </div>
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-md-4">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese correo electrónico" onKeyUp="this.value=this.value.toLowerCase();" value="<?= $register ? $register->email : '' ?>">
                  </div>
                           
                  </div>
                <div class="form-group">
                  <label for="direccion" class="col-sm-2 control-label">Dirección E/S</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de la estación de servicio" onKeyUp="this.value=this.value.toUpperCase();" value="<?= $register ? $register->direccion : '' ?>">
                  </div>
                </div>
                <div class="form-group">
                      <label class="col-md-2 col-sm-2 control-label" for="nacionalidad">Cédula:</label>
                        <div class="col-md-1">                     
                        <select class="form-control" name="nacionalidad" id="nacionalidad" required="">
				            <?= $options_nac ?>
                        </select>
                      </div>                    
                       <div class="col-md-3">                     
                        <input class="form-control" id="cedula" placeholder="12345678" name="cedula" maxlength="8" required="" onkeypress="return valida(event)" value="<?= $register ? $register->cedula : '' ?>">
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
                <button id="boton_limpiar" type="reset" class="btn btn-default">Limpiar</button>
                <button id="boton_enviar" type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
      </div>    
      </section>      
</div>    
<?
             	include_once $_SESSION['base_url'].'partials/footer.php';
                               
?>   
<script>
function Modificar(){
    
var rif = document.getElementById("rif").value;
    
    if(rif.length > 0){
    
					$("#letra_rif").prop('disabled',true);
					$("#rif").prop('readonly',true);
					$("#nombre").prop('readonly',false)
					$("#apellido").prop('readonly',false)
                    $("#email").prop('readonly',false)
                    $("#telefono").prop('readonly',false)
                    $("#boton_enviar").prop('disabled',false)
                    $("#boton_limpiar").prop('disabled',false)	    }

}
    window.onload = Modificar;
    
    $("#rif").blur(function(){
        
			var rif = $(this).val()
            var letra = document.getElementById("letra_rif").value;

                    var usu = letra+'-'+$("#rif").val();

                

                        
					$("#usuario").val(usu).prop('readonly',true)


		});

    $("#cedula").blur(function(){
        
			var ced = $(this).val()
            var naci = document.getElementById("nacionalidad").value;
        
        $.getJSON('./operaciones.php',{ced: ced, naci: naci, action: 'buscar_persona'}, function(data)
			{	
				if(Object.keys(data).length  > 0)
				
				{

					$("#nombre").val(data[0].nombre).prop('readonly',true)
					$("#apellido").val(data[0].apellido).prop('readonly',true)

                        
                    }else{
			         $("#nombre").val("")
                    $("#apellido").val("");    					
					$("#nombre").prop('readonly',false)
					$("#apellido").prop('readonly',false)
                    }
	
			})
		})
    
    $('#form_registrar').submit(function(e) {
		e.preventDefault()

		$.ajax({
			url: './operaciones.php',
			type: 'POST',
			dataType: 'JSON',
			data: $(this).serialize(),
		})
		.done(function(data) {
			if(data.r)
			{
				let action = $('#action').val()

				if(action === "grabar")
				{
					$('#form_registrar')[0].reset()
	                //$('#fields_ocultos').hide()
                    window.location.replace('./add.php')        
	                toastr.success('Estacion de servicio guardada!', 'Éxito!')					
				}
				if(action === "modificar")
				{
	                //toastr.success('Datos actualizados con éxito!', 'Éxito!')					
                    window.location.replace('./index.php')        
				}
	                
			}
			else
			{    
                $('#form_registrar')[0].reset()
                toastr.error('Esta estación de servicio ya se encuentra registrada', 'Error!')
			}
		})
		
	})
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