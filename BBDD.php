<?php
require_once("credenciales.php");
require_once("Paginabase.php");

function conexion(){
	$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);

	if ($db) {
		echo "<p>Conexión con éxito</p>";
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
	echo $c;
	echo $pwd;
	$consulta = "SELECT nombre,apellidos,admin,foto FROM USUARIOS WHERE email='$c' AND passwd='$pwd'";
	$res = $db->query($consulta);
	if($res){
		if(mysqli_num_rows($res)>0){
			while($tupla = $res->fetch_assoc()){
				echo $tupla['nombre'];
				echo $tupla['apellidos'];
			}
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
?>