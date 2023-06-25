<?php
require_once("credenciales.php");
require_once("Paginabase.php");
require_once("Formularios.php");

function conexion(){
	$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);

	if ($db) {
	} else {
		echo "<p>Error de conexión</p>";
		echo "<p>Código: ".mysqli_connect_errno()."</p>";
		echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
		die("Adiós");
	}
	// Establecer el conjunto de caracteres del cliente
	mysqli_set_charset($db,"utf8");

	return $db;
}

function desconexion(&$db){
	mysqli_close($db);
}

function logUser($c, $pwd){
	$db = conexion();
	$passwd_recuperada = "";

	$consulta = "SELECT passwd FROM USUARIOS WHERE email='$c'";
	$res = $db->query($consulta);
	if($res){
		if(mysqli_num_rows($res)>0){
			while($tupla = $res->fetch_assoc()){
				$passwd_recuperada = $tupla['passwd'];
			}
		}else{
			mysqli_free_result($res);
		}
	}
	if (password_verify($pwd, $passwd_recuperada)) {
		$consulta = "SELECT nombre,apellidos,admin,foto,direccion,tlfn,passwd FROM USUARIOS WHERE email='$c'";
		$res = $db->query($consulta);
		if($res){
			if(mysqli_num_rows($res)>0){
				while($tupla = $res->fetch_assoc()){
					$_SESSION['nombre'] = $tupla['nombre'];
					$_SESSION['apellidos'] = $tupla['apellidos'];
					$_SESSION['foto'] = $tupla['foto'];
					$_SESSION['email'] = $c;
					$_SESSION['direccion'] = $tupla['direccion'];
					$_SESSION['tlfn'] = $tupla['tlfn'];
					$_SESSION['passwd'] = $tupla['passwd'];
					if($tupla['admin'] == 1){
						$_SESSION['tipo'] = "Administrador";
					}else{
						$_SESSION['tipo'] = "Colaborador";
					}
				}
			}else{
				mysqli_free_result($res);
			}
		}else {
			echo "<p>Error en la consulta</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";

		}
	}
	desconexion($db);
}

function nuevaIncidencia($claves, $lugar, $titulo, $descripcion){
	$db = conexion();
	$estado = "pendiente";

	date_default_timezone_set('Europe/Madrid');
	$fechaActual = date('Y-m-d H:i:s');
	$nombre = $_SESSION['nombre'];
	$apellidos = $_SESSION['apellidos'];
	$consulta = "INSERT INTO INCIDENCIAS (ID,CLAVES,LUGAR,FECHA,NOMBRE,TITULO,DESCRIPCION,ESTADO,APELLIDOS) VALUES (NULL,'$claves','$lugar','$fechaActual','$nombre','$titulo','$descripcion','$estado','$apellidos')";
	
	$res = $db->query($consulta);
	
	if($res){
		//echo $claves.  $lugar. $titulo. $descripcion;
		if(mysqli_num_rows($res)>0){
			/*while($tupla = $res->fetch_assoc()){
				echo $tupla['nombre'];
				echo $tupla['apellidos'];
			}*/
		}else{
			mysqli_free_result($res);
			#logeo();
		}
	}else {
	echo "<p>Error en la consulta</p>";
	echo "<p>Código: ".mysqli_errno()."</p>";
	echo "<p>Mensaje: ".mysqli_error()."</p>";
	}
	desconexion($db);
}

function ModificarUsuario(){
	$clave1 = $_SESSION['clave'];
	$foto = $_SESSION['foto'];
	$nombre = $_SESSION['nombre'];
	$apellidos = $_SESSION['apellidos'];
	$email_nuevo = $_SESSION['email'];
	$email_anterior = $_SESSION['antiguoCorreo'];
	$dir = $_SESSION['direccion'];
	$tlfn = $_SESSION['tlfn'];
	$tipo = $_SESSION['tipo'];
	
	$admin = 0;
	if($_SESSION['tipo'] == "Administrador")
		$admin = 1;
	
	$passwd = $_SESSION['passwd'];
	
	if($_SESSION['tipo'] == "Administrador"){
		$habilitar = " ";
		$admin = 1;
	}else{
		$habilitar = "disabled";
	}
	$db = conexion();
	$consulta = "UPDATE USUARIOS SET EMAIL=?, NOMBRE=?, APELLIDOS=?, FOTO=?, DIRECCION=?, PASSWD=?, TLFN=?, ADMIN=? WHERE EMAIL=?";
	$stmt = $db->prepare($consulta);

	if ($stmt) {
		if($clave1 != ""){
		    // Generar el hash de la contraseña
		   	$hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
		}
		else{
			$hashed_passwd = $passwd;
		}
		// Vincular parámetros
	    $stmt->bind_param("sssbssiis", $email_nuevo, $nombre, $apellidos, $foto, $dir, $hashed_passwd, $tlfn, $admin, $email_anterior);
	   
		// Ejecutar la consulta
		$stmt->execute();

	    // Verificar si la actualización fue exitosa
	    if ($stmt->affected_rows > 0) {
		    // La actualización se realizó correctamente
	        echo "Actualización exitosa";
	    } else {
		    // No se encontraron registros para actualizar
	        echo "No se encontraron registros para actualizar";
	    }

		// Cerrar la consulta preparada
	    $stmt->close();
	} else {
		// Error al preparar la consulta
	    echo "Error en la consulta preparada: " . $db->error;
	}
	desconexion($db);
}

function ListarUsuarios(){
	
}

?>