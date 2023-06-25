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

	date_default_timezone_set('Europe/Madrid');
	$fechaActual = date('Y-m-d H:i:s');

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
		
		$descripcion = "El usuario $c accede al sistema";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p>Error en la actualización del log</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}
	}
	else{
		$descripcion = "Se ha intentado acceder sin éxito con la cuenta $c al sistema";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p>Error en la actualización del log</p>";
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
	
	if(!$res){
		echo "<p>Error en la consulta</p>";
		echo "<p>Código: ".mysqli_errno($db)."</p>";
		echo "<p>Mensaje: ".mysqli_error($db)."</p>";
	}

	date_default_timezone_set('Europe/Madrid');
	$fechaActual = date('Y-m-d H:i:s');
	$c = $_SESSION['email'];
	$descripcion = "El usuario $c ha añadido una incidencia";
	$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
	$res = $db->query($consulta);

	if(!$res) {
		echo "<p>Error en la actualización del log</p>";
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
	        echo "<p>Actualización exitosa</p>";

	        date_default_timezone_set('Europe/Madrid');
	        $fechaActual = date('Y-m-d H:i:s');
	        $descripcion = "El usuario $email_nuevo ha modificado sus datos";
	        $consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
	        $res = $db->query($consulta);

	        if(!$res) {
	        	echo "<p>Error en la actualización del log</p>";
	        	echo "<p>Código: ".mysqli_errno()."</p>";
	        	echo "<p>Mensaje: ".mysqli_error()."</p>";
	        }
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

function HTMLLOG(){
	$db = conexion();

	$consulta = "SELECT FECHA, DESCRIPCION FROM LOGS ORDER BY FECHA DESC";
	
	$res = $db->query($consulta);
	
	if(!$res){
		echo "<p>Error en la consulta</p>";
		echo "<p>Código: ".mysqli_errno($db)."</p>";
		echo "<p>Mensaje: ".mysqli_error($db)."</p>";
	}

	if ($res->num_rows > 0) {
	    while ($fila = $res->fetch_assoc()) {
	    	echo "<div> <p>";
	        foreach ($fila as $campo => $valor) {
	            echo "$campo: $valor  |  ";
	        }
	        echo "</p></div>";
	        echo "<hr>";
	    }
	} else {
	    echo "No se encontraron registros en el log.";
	}

	desconexion($db);
}

function InsertarUsuario(){
	$clave1 = isset($_POST['clave1']) ? $_POST['clave1'] : NULL;
	$clave2 = isset($_POST['clave2']) ? $_POST['clave2'] : NULL;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
	$apellidos = isset($_POST['apellido']) ? $_POST['apellido'] : NULL;
	$email = isset($_POST['correo']) ? $_POST['correo'] : NULL;
	$direccion = isset($_POST['Residencia']) ? $_POST['Residencia'] : NULL;
	$tlf = isset($_POST['Tlf']) ? $_POST['Tlf'] : NULL;
	$rol = isset($_POST['rolUser']) ? $_POST['rolUser'] : NULL;
	$estado = isset($_POST['estadoUser']) ? $_POST['estadoUser'] : NULL;
	$foto = isset($_POST['Img']) ? $_POST['Img'] : NULL;

	if(isset($clave1) && $clave1 == $clave2 && isset($nombre) && isset($apellidos) && isset($rol) && isset($estado)){
		$clave1 = password_hash($clave1, PASSWORD_DEFAULT);
		if($rol == "Administrador"){
			$rol = 1;
		}else{
			$rol = 0;
		}
		$db = conexion();
		$res = mysqli_query($db,"SELECT COUNT(*) FROM USUARIOS WHERE email='$email' or (nombre='$nombre' and apellidos='$apellidos')");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if($num > 0){
			echo "<p>Error, ya existe un usuario con esos datos</p>";
		}else{
			$res = mysqli_query($db, "INSERT INTO USUARIOS (email,nombre,apellidos,foto,direccion,passwd,tlfn,admin,estado) VALUES ('{$email}','{$nombre}','{$apellidos}','{$foto}','{$direccion}','{$clave1}','{$tlf}','{$rol}','{$estado}')");
			if(!$res){
				echo "<p>Error ".mysqli_error($db)." al insertar el usuario</p>";
			}else{
				echo "<p>El nuevo usuario se ha creado con éxito</p>";
			}
		}
		desconexion($db);
	}else{
		NuevoUsuario();
		echo "<p>Error, la nueva clave debe de ser igual en los dos campos</p>";
	}
}

function ListarUsuarios(){
	$db = conexion();
	$passwd_recuperada = "";
	$yo = $_SESSION['email'];
	$url = $_SERVER['SCRIPT_NAME'];

	$consulta = "SELECT nombre,apellidos,email,foto,direccion,tlfn,admin,estado FROM USUARIOS WHERE email<>'$yo'";
	$res = $db->query($consulta);
	if($res){
		if(mysqli_num_rows($res)>0){
			while($tupla = $res->fetch_assoc()){
				$nom = $tupla['nombre'];
				$ap = $tupla['apellidos'];
				$img = $tupla['foto'];
				$email = $tupla['email'];
				$dir = $tupla['direccion'];
				$tlf = $tupla['tlfn'];
				if($tupla['admin'] == 1){
					$rol = "Administrador";
				}else{
					$rol = "Colaborador";
				}
				$estado = $tupla['estado'];

				$tipoContenido = "image/png";
				$imagenBase64 = base64_encode($img);
				$src = "data:$tipoContenido;base64,$imagenBase64";

				echo <<< HTML
				<section>
					<div><img src="$src" alt="Imagen"></div>
					<div>
						<p>Usuario: $nom $ap</p>
						<p>Email: $email</p>
						<p>Dirección: $dir</p>
						<p>Teléfono: $tlf</p>
						<p>Rol: $rol</p>
						<p>Estado: $estado</p>
					</div>
					<form method="post" action="$url">
						<input type="hidden" name="usuario" value="$email">
						<input type="submit" src="editar.png" width="20px" formmethod="post" name="EditarGU" value="EditarGU">
						<input type="submit" src="borrar.png" width="20px" formmethod="post" name="BorrarGU" value="BorrarGU">
					</form>
				</section>
				HTML;

			}
		}else{
			mysqli_free_result($res);
		}
	}else {
		echo "<p>Error en la consulta</p>";
		echo "<p>Código: ".mysqli_errno()."</p>";
		echo "<p>Mensaje: ".mysqli_error()."</p>";
	}

	desconexion($db);
}

function BorrarUsuario(){
	if(isset($_POST['usuario'])){
		$id = $_POST['usuario'];
		$url = $_SERVER['SCRIPT_NAME'];

		$db = conexion();
		$consulta = "SELECT nombre,apellidos,email,foto,direccion,tlfn,admin,estado FROM USUARIOS WHERE email='$id'";
		$res = $db->query($consulta);
		if($res){
			if(mysqli_num_rows($res)>0){
				while($tupla = $res->fetch_assoc()){
					$nom = $tupla['nombre'];
					$ap = $tupla['apellidos'];
					$img = $tupla['foto'];
					$email = $tupla['email'];
					$dir = $tupla['direccion'];
					$tlf = $tupla['tlfn'];
					if($tupla['admin'] == 1){
						$rol = "Administrador";
					}else{
						$rol = "Colaborador";
					}
					$estado = $tupla['estado'];

					$tipoContenido = "image/png";
					$imagenBase64 = base64_encode($img);
					$src = "data:$tipoContenido;base64,$imagenBase64";

					echo <<< HTML
					<section>
						<h2>Comfirme borrado de este usuario</h2>
						<div><img src="$src" alt="Imagen"></div>
						<div>
							<p>Usuario: $nom $ap</p>
							<p>Email: $email</p>
							<p>Dirección: $dir</p>
							<p>Teléfono: $tlf</p>
							<p>Rol: $rol</p>
							<p>Estado: $estado</p>
						</div>
						<form method="post" action="$url">
							<input type="hidden" name="id" value="$id">
							<input type="submit" name="ConfirmarBorrado" value="Confirmar borrado de usuario">
							<input type="submit" name="Cancelar" value="Cancelar">
						</form>
					</section>
					HTML;

				}
			}else{
				mysqli_free_result($res);
			}
		}else {
			echo "<p>Error en la consulta</p>";
			echo "<p>Código: ".mysqli_errno()."</p>";
			echo "<p>Mensaje: ".mysqli_error()."</p>";
		}

		desconexion($db);
	}else{
		echo "<p>Error al seleccionar usuario para ser borrado</p>";
	}
}

function ConfBorrar(){
	$id = $_POST['id'];

	$db = conexion();
	mysqli_query($db, "DELETE FROM USUARIOS WHERE email='$id'");
	if(mysqli_affected_rows($db)==1){
		echo "<p>El usuario ha sido borrado correctamente</p>";
	}else{
		echo "<p>Error: El usuario no se ha podido borrar</p>";
	}
	desconexion($db);
}


?>