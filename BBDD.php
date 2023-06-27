<?php
require_once("credenciales.php");
require_once("Paginabase.php");
require_once("Formularios.php");

$id_valorado = "";
$valoracion = 1;
if(isset($_POST['ValorarPositivamente'])){ 
	$id_valorado = $_POST['incidenciaValorada'];
	ValorarIncidencia($id_valorado, $valoracion);
}
if(isset($_POST['ValorarNegativamente'])){
	$id_valorado = $_POST['incidenciaValorada'];
	$valoracion = -1;
	ValorarIncidencia($id_valorado, $valoracion);
}

function conexion(){
	$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);

	if ($db) {
	} else {
		echo "<p class ='error'>Error de conexión</p>";
		echo "<p class ='error'>Código: ".mysqli_connect_errno()."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_connect_error()."</p>";
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
		$consulta = "SELECT nombre,apellidos,admin,foto,direccion,tlfn,passwd,estado FROM USUARIOS WHERE email='$c'";
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
					$_SESSION['rol'] =$tupla['admin'];
					$_SESSION['estado'] = $tupla['estado'];
				}
			}else{
				mysqli_free_result($res);
			}
		}else {
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";

		}
		
		$descripcion = "El usuario $c accede al sistema";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p class ='error'>Error en la actualización del log</p>";
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
		}
	}
	else{
		$descripcion = "Se ha intentado acceder sin éxito con la cuenta $c al sistema";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p class ='error'>Error en la actualización del log</p>";
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
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
	$valoracion = 0;
	$consulta = "INSERT INTO INCIDENCIAS (ID,CLAVES,LUGAR,FECHA,NOMBRE,TITULO,DESCRIPCION,ESTADO,APELLIDOS, VALORACION) VALUES (NULL,'$claves','$lugar','$fechaActual','$nombre','$titulo','$descripcion','$estado','$apellidos', '$valoracion')";
	
	$res = $db->query($consulta);
	
	if(!$res){
		echo "<p class ='error'>Error en la consulta</p>";
		echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
	}
	$ultimoID = $db->insert_id;

	date_default_timezone_set('Europe/Madrid');
	$fechaActual = date('Y-m-d H:i:s');
	$c = $_SESSION['email'];
	$descripcion = "El usuario $c ha añadido una incidencia";
	$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
	$res = $db->query($consulta);

	if(!$res) {
		echo "<p class ='error'>Error en la actualización del log</p>";
		echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
	}


	$consulta = "INSERT INTO CREAN (IDINCIDENCIA,EMAIL) VALUES ($ultimoID,'$c')";
	$res = $db->query($consulta);

	if(!$res) {
		echo "<p class ='error'>Error en la actualización del log</p>";
		echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
	}

	desconexion($db);
}

function ModificarUsuario(){
	$db = conexion();
	$id = $_POST['tipoEditar'];
	
	$consulta = "SELECT nombre,apellidos,passwd,email,foto,direccion,tlfn,admin,estado FROM USUARIOS WHERE email='$id'";
	$res = $db->query($consulta);
	if($res){
		if(mysqli_num_rows($res)>0){
			while($tupla = $res->fetch_assoc()){
				$clave1 = isset($_POST['clave1']) ? $_POST['clave1'] : $tupla['passwd'];
				$foto = isset($_POST['tipoImg']) ? $_POST['tipoImg'] : NULL;
				$nombre = isset($_POST['nuevoNombre']) ? $_POST['nuevoNombre'] : $tupla['nombre'];
				$apellidos = isset($_POST['nuevoApellido']) ? $_POST['nuevoApellido'] : $tupla['apellidos'];
				$email_nuevo = isset($_POST['nuevoCorreo']) ? $_POST['nuevoCorreo'] : $tupla['email'];
				$dir = isset($_POST['nuevaResidencia']) ? $_POST['nuevaResidencia']: $tupla['direccion'];
				$tlfn = isset($_POST['nuevoTlf']) ? $_POST['nuevoTlf']: $tupla['tlfn'];
				$estado = isset($_POST['tipoEstado']) ? $_POST['tipoEstado']: $tupla['estado'];
				$admin = isset($_POST['tipoRol']) ? $_POST['tipoRol']: $tupla['admin'];

				if(is_null($foto)){
					$foto = $tupla['foto'];
				}else{
					$foto = base64_encode(file_get_contents($foto));
				}
			}
		}
	}
	$consulta = "UPDATE USUARIOS SET EMAIL=?, NOMBRE=?, APELLIDOS=?, FOTO=?, DIRECCION=?, PASSWD=?, TLFN=?, ADMIN=?, ESTADO=?  WHERE EMAIL=?";
	$stmt = $db->prepare($consulta);
	if ($stmt) {
		if($clave1 != ""){
		    // Generar el hash de la contraseña
		   	$hashed_passwd = password_hash($clave1, PASSWORD_DEFAULT);
		}
		else{
			$hashed_passwd = $clave1;
		}
		// Vincular parámetros
	    $stmt->bind_param("sssbssiiss", $email_nuevo, $nombre, $apellidos, $foto, $dir, $hashed_passwd, $tlfn, $admin, $estado,$id);
	   
		// Ejecutar la consulta
		$stmt->execute();

	    // Verificar si la actualización fue exitosa
	    if ($stmt->affected_rows > 0) {
		    // La actualización se realizó correctamente
	        echo "<p class='correcto'>Actualización exitosa</p>";
	        if($_SESSION['email'] == $id){
				    if(isset($_POST['nuevoNombre'])){
						$_SESSION['nombre'] = $nombre;
					}
					if(isset($_POST['nuevoApellido'])){
						$_SESSION['apellidos'] = $apellidos;
					}
					if(isset($_POST['nuevoCorreo'])){
						$_SESSION['email'] = $email_nuevo;
					}
					if(isset($_POST['nuevaResidencia'])){
						$_SESSION['direccion'] = $dir;
					}
					if(isset($_POST['nuevoTlf'])){
						$_SESSION['tlfn'] = $tlfn;
					}
					if($admin){
						$_SESSION['tipo'] = "Administrador";
					}else{
						$_SESSION['tipo'] = "Colaborador";
					}
					if(isset($_POST['nuevaImg'])){
						$_SESSION['foto'] = $foto;
					}
			}

			date_default_timezone_set('Europe/Madrid');
			$fechaActual = date('Y-m-d H:i:s');
			$descripcion = "El usuario $email_nuevo ha modificado sus datos";
			$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
			$lres = $db->query($consulta);

			if(!$lres) {
			  	echo "<p class ='error'>Error en la actualización del log</p>";
			   	echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			   	echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
			}

	    } else {
		    // No se encontraron registros para actualizar
	        echo "<p class ='error'>No se encontraron registros para actualizar</p>";
	    }

		// Cerrar la consulta preparada
	    $stmt->close();
	} else {
		// Error al preparar la consulta
	    echo "<p class ='error'>Error en la consulta preparada: " . $db->error . "</p>";
	}
	desconexion($db);
}

function HTMLLOG(){
	$db = conexion();

	$consulta = "SELECT FECHA, DESCRIPCION FROM LOGS ORDER BY FECHA DESC";
	
	$res = $db->query($consulta);
	
	if(!$res){
		echo "<p class ='error'>Error en la consulta</p>";
		echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
	}else{
		echo "<h2>Eventos del sistema</h2>";
	}

	if ($res->num_rows > 0) {
		echo "<section>";
	    while ($fila = $res->fetch_assoc()) {
	        foreach ($fila as $campo => $valor) {
	        	echo "<p class= 'log'><label>";
	        	echo "$campo: ";
	        	echo "</label>";
	            echo " $valor ";
	            echo "</p>";
	        }
	    }
	    echo "</section>";
	} else {
	    echo "<p>class ='error'>No se encontraron registros en el log.</p>";
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
	$rol = isset($_POST['rolUser']) ? $_POST['rolUser'] : $_POST['tipoRol'];
	$estado = isset($_POST['estadoUser']) ? $_POST['estadoUser'] : $_POST['tipoEstado'];
	$foto = isset($_POST['Img']) ? $_POST['Img'] : $_POST['tipoImg'];
	$foto = base64_encode(file_get_contents($foto));

	if(isset($clave1) && $clave1 == $clave2 && isset($nombre) && isset($apellidos) && isset($rol) && isset($estado)){
		$clave1 = password_hash($clave1, PASSWORD_DEFAULT);
		$db = conexion();
		$res = mysqli_query($db,"SELECT COUNT(*) FROM USUARIOS WHERE email='$email' or (nombre='$nombre' and apellidos='$apellidos')");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if($num > 0){
			echo "<p class ='error'>Error, ya existe un usuario con esos datos</p>";
		}else{
			$res = mysqli_query($db, "INSERT INTO USUARIOS (email,nombre,apellidos,foto,direccion,passwd,tlfn,admin,estado) VALUES ('{$email}','{$nombre}','{$apellidos}','{$foto}','{$direccion}','{$clave1}','{$tlf}','{$rol}','{$estado}')");
			if(!$res){
				echo "<p class ='error'>Error ".mysqli_error($db)." al insertar el usuario</p>";
			}else{
				echo "<p class ='correcto'>El nuevo usuario se ha creado con éxito</p>";
			}
		}
		desconexion($db);
	}else{
		NuevoUsuario();
		echo "<p class ='error'>Error, la nueva clave debe de ser igual en los dos campos</p>";
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
				<section class ="ListarUsuario">
					<div class="img"><img src="$src" alt="Imagen"></div>
					<div>
						<p>Usuario: $nom $ap</p>
						<p>Email: $email</p>
						<p>Dirección: $dir</p>
						<p>Teléfono: $tlf</p>
						<p>Rol: $rol</p>
						<p>Estado: $estado</p>
					</div>
					<form method="post" action="./index.php?p=usuarios">
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
		echo "<p class ='error'>Error en la consulta</p>";
		echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
		echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
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
					<h2>Confirme borrado de este usuario</h2>
					<section class ="borrarusuario">
						<div class="img1"><img src="$src" alt="Imagen"></div>
						<div>
							<p><label>Usuario:</label> $nom $ap</p>
							<p><label>Email:</label> $email</p>
							<p><label>Dirección:</label> $dir</p>
							<p><label>Teléfono:</label> $tlf</p>
							<p><label>Rol:</label> $rol</p>
							<p><label>Estado:</label> $estado</p>
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
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
		}

		desconexion($db);
	}else{
		echo "<p class ='error'>Error al seleccionar usuario para ser borrado</p>";
	}
}

function ConfBorrar(){
	$id = $_POST['id'];

	$db = conexion();
	mysqli_query($db, "DELETE FROM USUARIOS WHERE email='$id'");
	if(mysqli_affected_rows($db)==1){
		echo "<p class ='correcto'>El usuario ha sido borrado correctamente</p>";
	}else{
		echo "<p class ='error'>Error: El usuario no se ha podido borrar</p>";
	}
	desconexion($db);
}

function VerIncidencias($criterio, $pendiente, $comprobada, $tramitada, $irresoluble, $resuelta){
	$db = conexion();

	//Criterio por antiguedad por defecto:
	$consulta = "SELECT ID, TITULO, LUGAR, FECHA, NOMBRE, APELLIDOS, CLAVES, ESTADO, DESCRIPCION, VALORACION FROM INCIDENCIAS ORDER BY FECHA DESC";

	if($criterio == 'Positivos'){
		$consulta = "SELECT ID, TITULO, LUGAR, FECHA, NOMBRE, APELLIDOS, CLAVES, ESTADO, DESCRIPCION, VALORACION FROM INCIDENCIAS ORDER BY VALORACION DESC";
	}
		
		$res = $db->query($consulta);
		if(!$res) {
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
		}
		if($res->num_rows > 0){
			$ultimoID = "";
			while($fila = $res->fetch_assoc()){
				echo '<section class="ver">';
				echo '<div>';			
				foreach ($fila as $campo => $valor) {
					   	echo "<p><label>";
						echo "$campo:";
						echo "</label>";
				   		echo " $valor ";
				   		echo "</p>";
					   $ultimoID = $fila['ID'];
				}
				echo <<< HTML
					<form method="POST">
						<input type="submit" name="ValorarPositivamente" value="+">
						<input type="submit" name="ValorarNegativamente" value="-"/>
						<input type="hidden" name="incidenciaValorada" value="$ultimoID">
					</form>
				HTML;
				echo "</div>";
				CajaComentarios($ultimoID);	
				echo "</section>";	

				$consulta2 = "SELECT IDCOMENTARIO FROM TIENEN WHERE IDINCIDENCIA='$ultimoID'";
				$res2 = $db->query($consulta2);
				$claves = array();
				while($fila = $res2->fetch_assoc()){			
					$claves[] = $fila['IDCOMENTARIO'];
				}	
				foreach ($claves as $clave) {
						$consulta3 = "SELECT USUARIO, FECHA, DESCRIPCION FROM COMENTARIOS WHERE ID='$clave' ORDER BY FECHA DESC";
						$res3 = $db->query($consulta3);
						if(!$res3) {
							echo "<p class ='error'>Error en la consulta</p>";
							echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
							echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
						}
						if($res3->num_rows > 0){
							echo "<div class='caja'>";
							while($fila = $res3->fetch_assoc()){
								echo "<div class='comentario'>";	
							    foreach ($fila as $campo => $valor) {
							    		echo "<p><label>";
							    		echo "$campo:";
							    		echo "</label>";
							    		echo " $valor ";
							    		echo "</p>";
							    }
							    echo "</div>";
							}
							echo "</div>";
						}
					}
			}
		}
		else{
			 echo "<p>No se encontraron incidencias.</p>";
		}	

	
	desconexion($db);
}

function HTMLMISINCIDENCIAS(){
	$db = conexion();
	$email = $_SESSION['email'];
	$consulta = "SELECT IDINCIDENCIA FROM CREAN WHERE EMAIL='$email'";
	$res = $db->query($consulta);
	if(!$res) {
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
	}else{
		echo "<h2>Mis incidencias</h2>";
	}
	$claves = array();
	
	while($fila = $res->fetch_assoc()){			
		$claves[] = $fila['IDINCIDENCIA'];
	}	
		
	foreach ($claves as $clave) {
		$consulta = "SELECT ID, TITULO, LUGAR, FECHA, NOMBRE, APELLIDOS, CLAVES, ESTADO, DESCRIPCION, VALORACION FROM INCIDENCIAS WHERE ID='$clave' ORDER BY FECHA DESC";
		$res = $db->query($consulta);
		if(!$res) {
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
		}
		if($res->num_rows > 0){
			$ultimoID = "";
			while($fila = $res->fetch_assoc()){
				echo '<section class="ver">';
				echo '<div>';			
				foreach ($fila as $campo => $valor) {
					   	echo "<p><label>";
						echo "$campo:";
						echo "</label>";
				   		echo " $valor ";
				   		echo "</p>";
					   $ultimoID = $fila['ID'];
				}
				echo <<< HTML
					<form method="POST">
						<input type="submit" name="ValorarPositivamente" value="+">
						<input type="submit" name="ValorarNegativamente" value="-"/>
						<input type="hidden" name="incidenciaValorada" value="$ultimoID">
					</form>
				HTML;
				echo "</div>";
				CajaComentarios($ultimoID);	
				echo "</section>";	

				$consulta2 = "SELECT IDCOMENTARIO FROM TIENEN WHERE IDINCIDENCIA='$ultimoID'";
				$res2 = $db->query($consulta2);
				$claves = array();
				while($fila = $res2->fetch_assoc()){			
					$claves[] = $fila['IDCOMENTARIO'];
				}	
				foreach ($claves as $clave) {
						$consulta3 = "SELECT USUARIO, FECHA, DESCRIPCION FROM COMENTARIOS WHERE ID='$clave' ORDER BY FECHA DESC";
						$res3 = $db->query($consulta3);
						if(!$res3) {
							echo "<p class ='error'>Error en la consulta</p>";
							echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
							echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
						}
						if($res3->num_rows > 0){
							echo "<div class='caja'>";
							while($fila = $res3->fetch_assoc()){
								echo "<div class='comentario'>";	
							    foreach ($fila as $campo => $valor) {
							    		echo "<p><label>";
							    		echo "$campo:";
							    		echo "</label>";
							    		echo " $valor ";
							    		echo "</p>";
							    }
							    echo "</div>";
							}
							echo "</div>";
						}
					}
			}
		}
		else{
			 echo "<p>No se encontraron incidencias.</p>";
		}	
	}	
	
	desconexion($db);
}

function IntroducirComentario($comentario, $usuario, $id){
	$db = conexion();
	date_default_timezone_set('Europe/Madrid');
	$fechaActual = date('Y-m-d H:i:s');

	$consulta = "INSERT INTO COMENTARIOS (ID,USUARIO,FECHA,DESCRIPCION) VALUES (NULL,'$usuario','$fechaActual','$comentario')";
	$res = $db->query($consulta);
	if(!$res) {
			echo "<p class ='error'>Error en la introducción del comentario</p>";
			echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
	}
	else{

		$ultimoID = $db->insert_id;

		$consulta = "INSERT INTO TIENEN (IDCOMENTARIO,IDINCIDENCIA) VALUES ('$ultimoID','$id')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
		}

		$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "Anónimo";
		$descripcion = "El usuario $email ha añadido un comentario";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo "<p class ='error'>Error en la actualización del log</p>";
			echo "<p class ='error'>Código: ".mysqli_errno()."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error()."</p>";
		}

	}	
	
	desconexion($db);
}

function ValorarIncidencia($id_valorado, $valoracion){
	$db = conexion();

	$consulta = "UPDATE INCIDENCIAS SET VALORACION = VALORACION + '$valoracion' WHERE ID='$id_valorado'";
	$res = $db->query($consulta);
	if(!$res) {
			echo "<p class ='error'>Error en la consulta</p>";
			echo "<p class ='error'>Código: ".mysqli_errno($db)."</p>";
			echo "<p class ='error'>Mensaje: ".mysqli_error($db)."</p>";
	}
			
	desconexion($db);
}

function IncidenciasP($x){
	$db = conexion();
	if($x == 1){
		$consulta = 'SELECT * FROM INCIDENCIAS WHERE estado="pendiente"';
	}elseif($x == 2){
		$consulta = 'SELECT * FROM INCIDENCIAS WHERE estado = "resuelta"';
	}elseif($x == 3){
		$consulta = 'SELECT * FROM INCIDENCIAS WHERE estado = "irresoluble"';
	}elseif($x == 4){
		$consulta = 'SELECT * FROM INCIDENCIAS WHERE estado = "comprobada"';
	}elseif($x == 5){
		$consulta = 'SELECT * FROM INCIDENCIAS WHERE estado = "tramitada"';
	}
	$res = $db->query($consulta);
	if($res){
		$num = mysqli_num_rows($res);
	}else{
		$num = 0;
	}
			
	desconexion($db);
	return $num;
}

function RIncidencias(){
	$db = conexion();
	$consulta = "SELECT CONCAT(nombre, ' ', apellidos) AS nombre_completo, COUNT(*) AS repeticiones FROM INCIDENCIAS GROUP BY nombre_completo ORDER BY repeticiones DESC LIMIT 3";
		$res = $db->query($consulta);
		if($res){
			if(mysqli_num_rows($res)>0){
				while($tupla = $res->fetch_assoc()){
					$user[] = $tupla['nombre_completo'];
				}
				$user[] = "No hay nadie mas";
				$user[] = "No hay nadie mas";
			}else{
				return $user = array("No hay nadie","No hay nadie","No hay nadie");
			}
		}else {
			return $user = array("No hay nadie","No hay nadie","No hay nadie");
		}
	desconexion($db);
	return $user;
}

function DB_backup($db) {
	$tablas = array();
	// Obtener listado de tablas
	$result = mysqli_query($db,'SHOW TABLES');
	while ($row = mysqli_fetch_row($result))
		$tablas[] = $row[0];
	// Salvar cada tabla
	$salida = '';
	foreach ($tablas as $tab) {
		$result = mysqli_query($db,'SELECT * FROM '.$tab);
		$num = mysqli_num_fields($result);
		$salida .= 'DROP TABLE IF EXISTS '.$tab.';';
		$row2 = mysqli_fetch_row(mysqli_query($db,'SHOW CREATE TABLE '.$tab));
		$salida .= "\n\n".$row2[1].";\n\n";
		while ($row = mysqli_fetch_row($result)) {
			$salida .= 'INSERT INTO '.$tab.' VALUES(';
			for ($j=0; $j < $num; $j++) {
				if (!is_null($row[$j])) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
					if (isset($row[$j])) $salida .= '"'.$row[$j].'"';
					else $salida .= '""';
				} else $salida .= 'NULL';
				if ($j < ($num-1)) $salida .= ',';
			}
			$salida .= ");\n";
		}
		$salida .= "\n\n\n";
	}
	return $salida;
}

?>