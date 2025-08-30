<?

function make_table_editable($title,$th,$key_body,$data,$clp) 
	{
		// title = Título de la caja
		// th = array de los th de la tabla
		// key_body = aray de los campos a imprimir
		// data = arreglo q viene de la bd o manual con los datos

		$html = '
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>
		
			<h2 class="panel-title">'.$title.'</h2>
			</header>
			<div class="panel-body">

		<div class="clearfix"></div>
		<table class="table table-bordered table-striped mb-none table-condensed"
			id="datatable-editable"
		>';

		$th_html = "<thead><tr>";

		foreach ($th as $row) 
		{
			$th_html.= '<th class="text-primary text-center">'.ucwords($row).'</th>';
		}


		$th_html.='
					</tr>
				</thead>';
		
		$body_html ='<tbody class="text-center">';

		$con = 0;

		foreach ($data as $row) {
			
			$clase = '';
			switch ($con) {
				case 0:
					$clase = 'gradeX';
				break;
				
				case 1:
					$clase = 'gradeC';
				break;

				default:
					$clase = 'gradeA';
				break;
			}

			$body_html.='<tr class="'.$clase.'">';

			foreach ($key_body as $row1) 
			{
				$body_html.= '<td>'.$row->{$row1}.'</td>';
			}

			$body_html.= '<td class="actions">
							<a href="#" class="hidden on-editing save-row" data-tool="tooltip" title="Guardar">
								<img src="'.$_SESSION['base_url1'].'assets/images/icons/save.jpg'.'" width="20px"/>
							</a>
							<a href="#" class="hidden on-editing cancel-row" data-tool="tooltip" title="Cancelar">
								<img src="'.$_SESSION['base_url1'].'assets/images/icons/cancel.jpg'.'" width="20px"/>
							</a>
							<a href="#" class="on-default edit-row" data-tool="tooltip" title="Modificar">
								<img src="'.$_SESSION['base_url1'].'assets/images/icons/edit.jpg'.'" width="20px"/>
							</a>
							<a href="#" class="on-default remove-row" data-tool="tooltip" title="Eliminar">
								<img src="'.$_SESSION['base_url1'].'assets/images/icons/remove.jpg'.'" width="20px"/>
							</a>							</a>
							<a href="#" class="on-default edit-row" data-tool="tooltip" title="Aprobar">
								<img src="'.$_SESSION['base_url1'].'assets/images/icons/true.png'.'" width="20px"/>
							</a>
						</td>';

			$body_html.= '</tr>';

			$con++;
		}

		$body_html.= '</tbody>';

		$html.= $th_html.$body_html."</table></div></section>";

		$html.= '<div id="dialog" class="modal-block mfp-hide">
					<section class="panel">
						<header class="panel-heading">
							<h2 class="panel-title">¿Está Seguro?</h2>
						</header>
						<div class="panel-body">
							<div class="modal-wrapper">
								<div class="modal-text">
									<p>¿Está seguro de querer eliminar este Registro?</p>
								</div>
							</div>
						</div>						
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-12 text-right">
									<button id="dialogConfirm" class="btn btn-primary">Confirmar</button>
									<button id="dialogCancel" class="btn btn-default">Cancelar</button>
								</div>
							</div>
						</footer>
					</section>
				</div>';

		return $html;
	}


	function make_table($title,$th,$key_body,$data,$editar = true,$eliminar = true,$clear=true)
	{

		// title = Título de la caja
		// th = array de los th de la tabla
		// key_body = aray de los campos a imprimir
		// data = arreglo q viene de la bd o manual con los datos
		// crear = si es true aparece el botón de guardar
		// modificar = si es true aparece el botón de modificar
		// eliminar = si es true aparece el botón de eliminar
		


		$fila_th = '';

        if($editar === true || $eliminar === true|| $clear === true)
		{
			$fila_th = '<th class="text-center text-primary">Acciones</th>';
		}
	
        
		$html = '<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
              <h3 class="box-title">'.$title.'</h3>
            </div>
            <div class="box-body">
              <table id="data-table" class="table table-bordered table-striped">';

		$th_html = "<thead><tr>";

		foreach ($th as $row) 
		{
			$th_html.= '<th class="text-primary text-center">'.ucwords($row).'</th>';
		}

		$th_html.= $fila_th;
		
		$th_html.='
					</tr>
				</thead>';
		
		$body_html ='<tbody class="text-center">';

		$con = 0;

		foreach ($data as $row) {
			


			$body_html.='<tr>';

			foreach ($key_body as $row1) 
			{
				$image = '';
                
                //$row1->{$row1} = number_format($row->{$row1},'2', ',','.');
				
 
				if(empty($image))
				{

					$body_html.= '<td>'.$row->{$row1}.'</td>';
				}
				else
				{
					$body_html.= '<td>'.$image.'</td>';	
				}
                
			}
			$modificar = $editar ? '<a href="./add.php?modificar='.base64_encode($row->id).'" data-tool="tooltip" title="Editar Registro"><img src="'.$_SESSION['base_url1'].'dist/img/icons/edit.jpg'.'" width="20px"/></a>' : '';
			
			$remover   = $eliminar ? '<a href="./operaciones.php?eliminar='.base64_encode($row->id).'&action=remover_es" class="remover_helper" data-tool="tooltip" id="btn_eliminar" title="Eliminar"><img src="'.$_SESSION['base_url1'].'dist/img/icons/remove.jpg'.'"width="20px"/></a>' : '';
            
			$reset   = $clear ? '<a href="./operaciones.php?id='.base64_encode($row->id).'&action=reset_clave" class="reset_helper" data-tool="tooltip" id="btn_eliminar" title="Resetear Password"><img src="'.$_SESSION['base_url1'].'dist/img/icons/cancel.jpg'.'"width="20px"/></a>' : '';			
            
			if(!empty($modificar) || !empty($remover) || !empty($ver))
			{

				$body_html.= '<td class="">
								'.$modificar.'
								'.$remover.'
								'.$reset.'
							</td>';
			}

			$body_html.= '</tr>';

			$con++;
		}

		$body_html.= '</tbody>';

		$html.= $th_html.$body_html."</table></div></section>";

		return $html;
	}


	function make_table_es($title,$th,$key_body,$data)
	{

		// title = Título de la caja
		// th = array de los th de la tabla
		// key_body = aray de los campos a imprimir
		// data = arreglo q viene de la bd o manual con los datos
		// crear = si es true aparece el botón de guardar
		// modificar = si es true aparece el botón de modificar
		// eliminar = si es true aparece el botón de eliminar
		


		$fila_th = '';


	
        
		$html = '<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
              <h3 class="box-title">'.$title.'</h3>
            </div>
            <div class="box-body">
              <table id="data-table" class="table table-bordered table-striped">';

		$th_html = "<thead><tr>";

		foreach ($th as $row) 
		{
			$th_html.= '<th class="text-primary text-center">'.ucwords($row).'</th>';
		}

		$th_html.= $fila_th;
		
		$th_html.='
					</tr>
				</thead>';
		
		$body_html ='<tbody class="text-center">';

		$con = 0;

		foreach ($data as $row) {
			


			$body_html.='<tr>';

			foreach ($key_body as $row1) 
			{
				$image = '';
                
                //$row1->{$row1} = number_format($row->{$row1},'2', ',','.');
				
 
				if(empty($image))
				{

					$body_html.= '<td>'.$row->{$row1}.'</td>';
				}
				else
				{
					$body_html.= '<td>'.$image.'</td>';	
				}
                
			}


			$body_html.= '</tr>';

			$con++;
		}

		$body_html.= '</tbody>';

		$html.= $th_html.$body_html."</table></div></section>";

		return $html;
	}


?>
