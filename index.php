<?php
	session_start();

	require "./Paginabase.php";
	require "./Formularios.php";
	require "./BBDD.php";
	require "./main.php";

	$email=isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])? $_POST['email'] : NULL;
	$clave=isset($_POST['clave'])? $_POST['clave']: null;

	infoUsuario($email,$clave);

	
	if(isset($_POST['nuevoNombre'])){
		$_SESSION['nombre'] = $_POST['nuevoNombre'];
	}
	if(isset($_POST['nuevoApellido'])){
		$_SESSION['apellidos'] = $_POST['nuevoApellido'];
	}
	if(isset($_POST['nuevoCorreo'])){
		$_SESSION['antiguoCorreo'] = $_SESSION['email'];
		$_SESSION['email'] = $_POST['nuevoCorreo'];
		//echo "se cambio el correo";
		//echo "el antiguo es " . $_SESSION['antiguoCorreo'] . " y el nuevo es ". $_SESSION['email'];
	}
	if(isset($_POST['nuevaResidencia'])){
		$_SESSION['direccion'] = $_POST['nuevaResidencia'];
	}
	if(isset($_POST['nuevoTlf'])){
		$_SESSION['tlfn'] = $_POST['nuevoTlf'];
	}
	if(isset($_POST['rol'])){
		$_SESSION['tipo'] = $_POST['rol'];
	}
	if(isset($_POST['nuevaImg'])){
		$_SESSION['foto'] = $_POST['nuevaImg'];
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

	//Comprobamos los datos del usuario
	$tipo = isset($_SESSION['tipo'])? $_SESSION['tipo']: NULL;
	$nombre = isset($_SESSION['nombre'])? $_SESSION['nombre']: NULL;
	$apellidos = isset($_SESSION['apellidos'])? $_SESSION['apellidos']:NULL;

	HTMLnav($tipo);

	echo "<div>
		<section>";
	if(isset($_POST['editar'])){
		EditarUsuario(false);
	} elseif(isset($_POST['Modificacion'])){
		EditarUsuario2();
	} elseif(isset($_POST['confirmarModificacion'])){
		ModificarUsuario();
	} elseif(isset($_POST['EnviarDatos'])){
		HTMLNUEVA(true);
		$_SESSION['claves']=$_POST['claves'];
		$_SESSION['lugar']=$_POST['lugar'];
		$_SESSION['titulo']=$_POST['titulo'];
		$_SESSION['descripcion']=$_POST['descripcion'];
		echo "¿Desea confirmar los datos?";
	} elseif(isset($_POST['ConfirmarInsercion'])){
		$claves = $_SESSION['claves'];
		$lugar = $_SESSION['lugar'];
		$titulo = $_SESSION['titulo'];
		$descripcion = $_SESSION['descripcion'];
		nuevaIncidencia($claves, $lugar, $titulo, $descripcion);
		EDITARINCIDENCIA();
	}
	elseif(isset($_GET['p']) && $_GET['p']=="inicio"){
		//HTMLVER();
		echo "<p>Ver incidencia</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="incidencia") {
		HTMLNUEVA(false);	
	} elseif (isset($_GET['p']) && $_GET['p']=="otras") {
		//HTMLOTRA();
		echo "<p>Mas incidencia</p>";
	} elseif (isset($_GET['p']) && $_GET['p']=="usuarios") {
		HTMLUSER();
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
			HTMLlateral($tipo,$email,$clave);
	echo "</div>";
	HTMLfooter();
	HTMLfin();
?>