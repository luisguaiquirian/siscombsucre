<?
	Class Conexion
	{	
		public function conectarPostgre()
		{
			// conexión a mysql pero la nombro así para no modificar la libreria

			try
			{
				$dsn = 'mysql:host=localhost;dbname=sisgas';
				$nombre_usuario = 'root';
				$contraseña = 'mtnl';
				$opciones = array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				); 

				$gbd = new PDO($dsn, $nombre_usuario, $contraseña, $opciones);

				return $gbd;
			}
			catch(PDOException $e)
			{
				echo 'No se ha podido establecer la conexión, '.$e->message();
			}
		}
	}
	Class Conexion2
	{	
		public function conectarPostgre()
		{
			// conexión a mysql pero la nombro así para no modificar la libreria

			try
			{
				$dsn = 'mysql:host=localhost;dbname=rep';
				$nombre_usuario = 'root';
				$contraseña = 'mtnl';
				$opciones = array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				); 

				$gbd = new PDO($dsn, $nombre_usuario, $contraseña, $opciones);

				return $gbd;
			}
			catch(PDOException $e)
			{
				echo 'No se ha podido establecer la conexión, '.$e->message();
			}
		}
	}
?>
