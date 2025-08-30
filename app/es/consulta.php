<?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}
	include_once $_SESSION['base_url'].'partials/header.php';

	$register = null;
    $options_nac = "";
    $options_rif = "";

    $nac = ['V','E'];
	foreach ($nac as $row) 
	{
		// llenado del combo de parroquias
		$selected = $register && $register->nacionalidad === $row ? 'selected=""' : '';

		$options_nac .= "<option value='{$row}' {$selected}>{$row}</option>";
	}

   		$system->table = "bitacora";
        $bita = $system->find(1);
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consulta de vehículos
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
    			<form action="" class="form-horizontal" id="form_consulta" method="POST">
		
				<input type="hidden" id="action" name="action" value="<?= $register ? 'modificar' : 'consultar_placa' ?>">
                        <input type="hidden" id="id_es" name="id_es" value="<?= $_SESSION['user_id'] ?>">
                        <input type="hidden" id="nom_es" name="nom_es" value="<?= $_SESSION['nom_es'] ?>">
                <div class="box-body">
                <div class="form-group">
                      <label class="col-md-2 col-sm-2 control-label" for="nacionalidad">Cédula:</label>
                        <div class="col-md-1">                     
                        <select class="form-control" name="nacionalidad" id="nacionalidad" required="">
				            <?= $options_nac ?>
                        </select>
                      </div>                    
                       <div class="col-md-3">                     
                        <input class="form-control" type="number" id="cedula" placeholder="12345678" name="cedula" maxlength="8" required="" onkeypress="return valida(event)">
                      </div>
                      <label class="col-md-2 col-sm-2 control-label" for="nombre">Nombre:</label>
                      <div class="col-md-4">                     
                        <input class="form-control" id="nombre" onKeyUp="this.value=this.value.toUpperCase();" readonly placeholder="Propietario del vehículo" name="nombre">
                      </div>                
                  </div>
 				
                <div class="form-group">
                  <label for="placa" class="col-sm-2 control-label">Placa del Vehículo</label>
                      <div class="col-md-4">                     
                        <input class="form-control" required id="placa" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Placa del vehículo" name="placa">
                      </div>  
                 <label for="" class="control-label col-md-2 col-sm-2">Tipo de vehículo:</label>
						<div class="col-md-4 col-sm-4">
					<select name="id_tipo_vehiculo" id="id_tipo_vehiculo" required="" class="form-control">
						<option value=""></option>
						<?
							$system->sql = "SELECT * from tipo_vehiculo";
							foreach ($system->sql() as $rs) 
							{

								if($register->id == $rs->id)
								{

									echo '<option value="'.$rs->id.'" selected>'.$rs->tipo_vehiculo.'</option>';	
								}
								else
								{
									echo '<option value="'.$rs->id.'">'.$rs->tipo_vehiculo.'</option>';	
								}

							}
						?>
					</select>
                        </div> 		
                           
                  </div>
                    

                           
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button id="boton_limpiar" type="reset" class="btn btn-default">Limpiar</button>
                <button id="boton_enviar" type="submit" class="btn btn-info pull-right">Consultar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          <div class="box box-info" id="ced" style="display: none">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-xs" data-widget="remove" data-toggle="tooltip"
                        title="Cerrar">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
                    <h3 id="mensaje" class="alert alert-danger text-center" role="alert" style="display: none"></h3>
            </div>
          </div>
          <div class="box box-info" id="ced2" style="display: none">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-xs" data-widget="remove" data-toggle="tooltip"
                        title="Cerrar">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
                    <p><h2 id="mensaje2" class="alert alert-success text-center" role="alert" style="display: none"></h2></p>
            </div>
          </div>          
          </div>
      </div>    
      </section>      
</div>   
 
<?
             	include_once $_SESSION['base_url'].'partials/footer.php';
                               
?>   
<script>

        $(function() {

            $('#form_consulta').submit(function(e) {
                /* Act on the event */
                e.preventDefault()
                $('#mensaje2').hide();
                $('#mensaje').hide();
                $('#ced').hide();
                $('#ced2').hide();

                $.ajax({
                        url: './operaciones.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(this).serialize(),
                    })
                    .done(function(data) {
                        var mensaje = 'Vehículo placa: '+data.placa+' ya surtió combustible en: '+data.es+', puede surtir el: '+data.fechav;
              var pla = document.getElementById("placa").value;
                      var mensaje2 = 'Vehículo placa: '+pla+' puede surtir combustible';
                        if (data.r) {
 					$('#form_consulta')[0].reset()                            
                            $('#mensaje2').show();
                            document.getElementById("mensaje2").innerHTML = mensaje2;
                            $('#ced2').show();

                        } else {
 					$('#form_consulta')[0].reset()
                           $('#mensaje').show()
                            document.getElementById("mensaje").innerHTML = mensaje;
                            $('#ced').show()

                        }
                    })
            });


        })
 
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

				if(action === "consultar_placa")
				{
					$('#form_registrar')[0].reset()
	                //$('#fields_ocultos').hide()
	                //toastr.success('Decreto guardado con éxito!', 'Éxito!')					
                    window.location.replace('./consulta.php')        
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
</script>