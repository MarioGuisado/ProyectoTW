<?php
require_once("credenciales.php");
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
?>