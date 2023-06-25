<?php
require_once("credenciales.php");
require_once("Paginabase.php");

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
		$consulta = "SELECT nombre,apellidos,admin,foto FROM USUARIOS WHERE email='$c'";
		$res = $db->query($consulta);
		if($res){
			if(mysqli_num_rows($res)>0){
				while($tupla = $res->fetch_assoc()){
					$_SESSION['nombre'] = $tupla['nombre'];
					$_SESSION['apellidos'] = $tupla['apellidos'];
					$_SESSION['foto'] = $tupla['foto'];
					$_SESSION['email'] = $c;
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
	$db = conexion();
	$correo = $_SESSION["email"];

	if(isset($_POST['nuevoNombre'])){
		$nombre = $_POST['nuevoNombre'];
		$consulta = "UPDATE USUARIOS SET NOMBRE='$nombre' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta del nombre</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	if(isset($_POST['nuevoApellido'])){
		$apellido = $_POST['nuevoApellido'];
		$consulta = "UPDATE USUARIOS SET APELLIDOS='$apellido' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta del apellido</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	if(isset($_POST['nuevoCorreo'])){
		$nuevoCorreo = $_POST['nuevoCorreo'];
		$consulta = "UPDATE USUARIOS SET EMAIL='$nuevoCorreo' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta del correo</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	if(isset($_POST['nuevaClave'])){
		$nuevaClave = $_POST['nuevaClave'];
		$consulta = "UPDATE USUARIOS SET passwd='$nuevaClave' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta de la clave</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	if(isset($_POST['nuevaResidencia'])){
		$nuevaResidencia = $_POST['nuevaResidencia'];
		$consulta = "UPDATE USUARIOS SET DIRECCION='$nuevaResidencia' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta de la residencia</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	if(isset($_POST['nuevoTlf'])){
		$nuevoTlf = $_POST['nuevoTlf'];
		$consulta = "UPDATE USUARIOS SET TLFN='$nuevoTlf' WHERE EMAIL='$correo'";
		$res = $db->query($consulta);
		if(!$res){
			echo "<p>Error en la consulta del teléfono</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	
	desconexion($db);
}
?>