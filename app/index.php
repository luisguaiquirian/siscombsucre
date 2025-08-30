<?
	if(!isset($_SESSION))
	{
  	session_start();
	}

  	switch ($_SESSION['nivel']) {
  		
  		case '0':
  			header('Location: '.$_SESSION['base_url1'].'app/admin/index.php');
  		break;
  		
  		case '1':
  			header('Location: '.$_SESSION['base_url1'].'app/admin/index.php');
  		break;

  		case '2':
  			header('Location: '.$_SESSION['base_url1'].'app/estado/index.php');
  		break;

  		case '3':
  			header('Location: '.$_SESSION['base_url1'].'app/municipio/index.php');
  		break;

  		case '4':
  			header('Location: '.$_SESSION['base_url1'].'app/es/index.php');
  		break;
  		
  		default:
  			header('Location: '.$_SESSION['base_url1'].'app/admin/index.php');
  		break;
  	}

?>