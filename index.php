<?php
	session_start();

	require "./Paginabase.php";
	require "./Formularios.php";

	$email=isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])? $_POST['email'] : NULL;
	$clave=isset($_POST['clave'])? $_POST['clave']: null;
	if(isset($email) && isset($clave)){
		//Comprobar si el usuario se encuentra en la BBDD
		//Si el usuario esta guardar en una variable de sesion que tipo es
		$_SESSION["tipo"] = "admin";
	}

	//Acabar con la sesión
	if(isset($_POST['logout'])){
		if(session_status() == PHP_SESSION_NONE)
			session_start();
		
		session_unset();

		$param = session_get_cookie_params();
		$session = session_name();
		setcookie($session, $_COOKIE[$session],time()-2592000,$param['path'],$param['domain'],$param['secure'],$param['httponly']);

		session_destroy();
	}

	HTMLinicio();
	HTMLtitulo();
	$tipo = isset($_SESSION['tipo'])? $_SESSION['tipo']:"administrador";
	HTMLnav($tipo);

	echo "<div>
		<section>";
	if(isset($_POST['editar'])){
		EditarUsuario();
	}
	else if(isset($_GET['p']) && $_GET['p']=="inicio"){
		//HTMLVER();
		echo "<p>Ver incidencia</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="incidencia") {
		HTMLNUEVA();
	} elseif (isset($_GET['p']) && $_GET['p']=="otras") {
		//HTMLOTRA();
		echo "<p>Mas incidencia</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="usuarios") {
		//HTMLUSER();
		echo "<p>Gestion usuarios</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="log") {
		//HTMLLOG();
		echo "<p>Ver log</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="BBDD") {
		//HTMLBBDD();
		echo "<p>Gestion BBDD</p>";
	}else
		echo "<p>Ver incidencia</p>";
	echo "</section>";
			HTMLlateral($tipo);
	echo "</div>";
	HTMLfooter();
	HTMLfin();
?>