<?
	if(!isset($_SESSION))
  	{
    	session_start();
  	}

	include_once $_SESSION['base_url'].'/class/system.php';
	$system = new System;


	switch ($_REQUEST['action']) {
            
        case 'consultar_placa':
            
        $placa = trim($_POST['placa']," ");    

            
$system->sql = "SELECT count(*) as t,
bitacora.id,
bitacora.placa,
bitacora.fecha_carga,
users.nombre_es,
tipo_vehiculo.dias
FROM
users
INNER JOIN bitacora ON users.id = bitacora.id_es
INNER JOIN tipo_vehiculo ON bitacora.id_tipo_vehiculo = tipo_vehiculo.id
WHERE
bitacora.placa  ='".$placa."'
limit 1";
            $resp = $system->sql(); 
            
            $count = $resp[0]->t;
             $hoy = new DateTime();            
            $dias = $resp[0]->dias;
            $fech = new DateTime($resp[0]->fecha_carga);
            $fechv = date("d-m-Y",strtotime($resp[0]->fecha_carga."+ ".$dias." days")); 
            $es = $resp[0]->nombre_es;
            $id = $resp[0]->id;
            $resta = $hoy->diff($fech)->format('%a');           
        if($count > 0 and $resta >= $dias )
        {
				unset($_POST['action']);
                $system->table = 'bitacora';
				$system->where = "id = ".$id;
				$respuesta = $system->modificar($_POST);
				$respuesta['modificar'] = 1;            
                $data = [
                    "r" => true
                ];
                echo json_encode($respuesta); 
    
           
        }elseif($count == 0){   
				unset($_POST['action']);
                 $system->table ="bitacora";
			     $arreglo = ['nacionalidad' => $_POST['nacionalidad'],
                        'cedula' => $_POST['cedula'],
                        'id_tipo_vehiculo' => $_POST['id_tipo_vehiculo'],
                        'nombre' => $_POST['nombre'],
                        'id_es' => $_POST['id_es'],
                        'placa' => $placa,
                        'nom_es' => $_POST['nom_es']
                       ];

                echo json_encode($system->guardar($arreglo)); 
     
            
        }
        
        else
        {	
            $data = [       
                "r" => false,
                "fecha" => $fech,
                "fechav" => $fechv,
                "dias" => $dias,
                "es" => $es,
                "resta" => $resta,
                "placa" => $placa,
                "t" => $resp[0]->t
                           ];
            echo json_encode($data);  
        }
		break;     
        case 'buscar_persona':
            
            $nac = $_GET['naci'];
            $ced = $_GET['ced'];
            

            
            if($nac == "V"){
            
            $system->sql = "SELECT nombre,apellido from rep_sucre where cedula =".$ced;
                
			echo json_encode($system->sql());
                     
            }
                              
            if($nac == "E")
            {
                
            $system->sql = "SELECT * from rep_ex where cedula = ".$ced;
			echo json_encode($system->sql());

            }                
   


		break;
            
            
		case 'change_password_default':
			
			$system->table = "users";
			$arreglo = ['nacionalidad' => $_POST['nac_clp'],
                        'cedula' => $_POST['ced_clp'],
                        'nombre' => $_POST['nom_usuario'],
                        'apellido' => $_POST['ape_usuario'],
                        'password_activo' => 1,
                        'password' => password_hash( $_POST['password'], PASSWORD_DEFAULT )
                       ];
			$system->where = "id = $_SESSION[user_id]";
			$res = $system->modificar($arreglo);

			if($res['r'] === true)
			{	
				$_SESSION['pass_activo'] = '1';
                $_SESSION['nom'] = $_POST['nom_usuario'];
                $_SESSION['ape'] = $_POST['ape_usuario'];
				
			}

			echo json_encode($res);

		break;
            
        case 'update_datos_usuario':
				$system->table = 'users';
				$system->where = "id = ".$_POST['id_modificar'];
				unset($_POST['action']);
				unset($_POST['id_modificar']);
				unset($_POST['rif']);
				unset($_POST['cedula']);
				$respuesta = $system->modificar($_POST);
				$respuesta['modificar'] = 1;

			if($respuesta['r'] === true)
			{	
                $_SESSION['nom'] = $_POST['nombre'];
                $_SESSION['ape'] = $_POST['apellido'];
				
			}            
            $_SESSION['flash'] = 1;
				echo json_encode($respuesta);   
                header('location: ./perfil.php');
		break; 
            
        case 'buscar_municipio':
			$system->sql = "SELECT id_municipio, municipio from municipios where id_estado = $_GET[estado]";
			echo json_encode($system->sql());
		break;
        
        case 'change_password':
			
			$system->table = "users";
			$arreglo = ['password_activo' => 1,
                        'password' => password_hash( $_POST['password'], PASSWORD_DEFAULT )
                       ];
			$system->where = "id = $_SESSION[user_id]";
			$res = $system->modificar($arreglo);

			if($res['r'] === true)
			{	
				$_SESSION['pass_activo'] = '1';

			}
            $_SESSION['flash'] = 1;
			echo json_encode($res);

		break;
            
        case 'grabar':
        $system->table ='users';
        $usuario = trim($_POST['usuario']," ");    
        $system->where = "usuario like '$usuario'";
        if($system->count() > 0)
        {
            $data = ["r" => false];
            echo json_encode($data);
        }
        else
        {	
            unset($_POST['action']);				
            unset($_POST['id_modificar']);
            $system->table ="users";
            echo json_encode($system->guardar($_POST));
            }
        
		break;
             
        case 'grabar_abastecimiento':
        $system->table ='users';
        $system->where = "nacionalidad = '$_POST[nacionalidad]' AND cedula = '$_POST[cedula]' AND cod_linea = '$_POST[cod_linea]'";
        if($system->count() > 0)
        {
            $data = ["r" => false];
            echo json_encode($data);
        }
        else
        {	
            unset($_POST['action']);				
            unset($_POST['id_modificar']);
            $system->table ="users";
            $_SESSION['flash'] = 1;
            $res=$system->guardar($_POST);
            if ($res) {
                include_once($_SESSION['base_url'].'lib/phpqrcode/phpqrcode.php');
                $contenido = $_SESSION['base_url1']."app/check/index.php?id=".base64_encode($_REQUEST['usuario']);
                $ruta = $_SESSION['base_url']."assets/images/Qr/afiliados/".$_REQUEST['usuario'].".png"; 
                QRcode::png($contenido,$ruta,QR_ECLEVEL_L,10,2);
                $data = ["r" => true];
                echo json_encode(array('r' => true));
            }
        }
		break;
  
        case 'grabar_unidad':
        $system->table ='unidades';
        $system->where = "placa = '$_POST[placa]'";
        if($system->count() > 0)
        {
            $data = ["r" => false];
            echo json_encode($data);
        }
        else
        {	
            $file = $_FILES["foto"];
            $nombre = $file['name'];
            $tipo = $file["type"];
            $ext = explode("image/",$file["type"]);
            $nombre_foto = $_POST["placa"].".".$ext[1];
            $qr = $_POST["placa"].".png";
            $ruta_provisional = $file["tmp_name"];
            $size = $file['size'];
            $carpeta = $_SESSION['base_url'].'assets/images/Qr/unidades/';
            $src = $carpeta.$nombre_foto;

            unset($_POST['action']);				
            unset($_POST['id_modificar']);
            
            $_POST['qr'] = "assets/images/Qr/unidades/".$_POST["placa"].".png";
            $_POST['foto'] = $nombre_foto;
            move_uploaded_file($ruta_provisional, $src);            
            $system->table ="unidades";
            $_SESSION['flash'] = 1;
            //echo json_encode($system->guardar($_POST));
            $res=$system->guardar($_POST);
            if ($res) {
                include_once($_SESSION['base_url'].'lib/phpqrcode/phpqrcode.php');
                $contenido = $_SESSION['base_url1']."app/check_unds/index.php?id=".base64_encode($_POST["placa"]);
                $ruta = $_SESSION['base_url']."assets/images/Qr/unidades/".$_POST["placa"].".png"; 
                QRcode::png($contenido,$ruta,QR_ECLEVEL_L,10,2);
                $data = ["r" => true];
                echo json_encode(array('r' => true));
            }            
        }
		break;
  
     	        case 'grabar_ruta':
        $system->table ='rutas';
        $ruta = trim($_POST[ruta]," ");    
        $system->where = "ruta like '$ruta'";
        if($system->count() > 0)
        {
            $data = ["r" => false];
            echo json_encode($data);
        }
        else
        {	
            unset($_POST['action']);				
            unset($_POST['id_modificar']);
            $system->table ="rutas";
            echo json_encode($system->guardar($_POST));
        }
		break;

		case 'remover_es':
  	            
            $system->table = "users";
			$system->eliminar(base64_decode($_GET['eliminar']));
            $_SESSION['flash'] = 1;            
			header('location: ./index.php');
            
        
		break;
            
        case 'modificar':
				$system->table = 'users';
				$system->where = "id = ".$_POST['id_modificar'];
				unset($_POST['action']);
				unset($_POST['id_modificar']);

				$respuesta = $system->modificar($_POST);
				$respuesta['modificar'] = 1;
                        $_SESSION['flash'] = 1;            

				echo json_encode($respuesta);
		break;
            
        case 'modificar_unidad':
				$system->table = 'unidades';
				$system->where = "id = ".$_POST['id_modificar'];
				unset($_POST['action']);
				unset($_POST['id_modificar']);

				$respuesta = $system->modificar($_POST);
				$respuesta['modificar_unidad'] = 1;
				echo json_encode($respuesta);
		break;
        
		case 'remover_linea':
  	            
            $system->table = "users";
			$system->eliminar(base64_decode($_GET['eliminar']));
			header('location: ./vista.php');
        
		break; 
        
		case 'remover_unidad':
  	            
            $system->table = "unidades";
			$system->eliminar(base64_decode($_GET['eliminar']));
			header('location: ./vista_unidades.php');
        
		break; 
        
        case 'remover_afiliado':
  	            
        $system->table ='unidades';
        $system->where = "cod_afiliado =".(base64_decode($_GET['usuario']));
        if($system->count() > 0)
        {
            $data = ["r" => false];
            $_SESSION['flash'] = 6;
            echo json_encode($data);
			header('location: ./vista.php');
        }
        else
        {
            $system->table = "users";
			$system->eliminar(base64_decode($_GET['eliminar']));
			header('location: ./vista.php');
        
		break; 
        }
		default:
			# code...
			break;
	}

?>