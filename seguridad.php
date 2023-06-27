<?php
require_once ("./BBDD.php");

if (isset($_POST['download'])) {
	if (!is_string($db = conexion())) {
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="db_backup.sql"');
		echo DB_backup($db);
		desconexion($db);
	}
} else {
	htmlStart('Copia de seguridad','Backup');
	msgError("<a href='".$_SERVER['SCRIPT_NAME']."?download'>Pulse aquí</a> para
	descargar un fichero con los datos de la copia de seguridad",'msginfo');
	htmlEnd();
}
?>