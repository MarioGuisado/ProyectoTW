<?php
	session_start();

	require_once("./Paginabase.php");
	require_once("./Formularios.php");
	require_once("./BBDD.php");
	require_once("./main.php");

	$email=isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])? $_POST['email'] : NULL;
	$clave=isset($_POST['clave'])? $_POST['clave']: null;

	infoUsuario($email,$clave);

	//Acabar con la sesión
	if(isset($_POST['logout'])){

		$db = conexion();
		date_default_timezone_set('Europe/Madrid');
		$fechaActual = date('Y-m-d H:i:s');
		$c = $_SESSION['email'];
		$descripcion = "El usuario $c sale del sistema";
		$consulta = "INSERT INTO LOGS (ID,FECHA,DESCRIPCION) VALUES (NULL,'$fechaActual','$descripcion')";
		$res = $db->query($consulta);

		if(!$res) {
			echo '<p class="error">Error en la actualización del log</p>';
			echo '<p class="error">Código: '.mysqli_errno().'</p>';
			echo '<p class="error">Mensaje: '.mysqli_error().'</p>';
		}
		desconexion($db);

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

	echo '<div class="contenido">';
	echo "<main>";
	if(isset($_POST['ConfirmarBorrado'])){
		ConfBorrar();
	}elseif(isset($_POST['EditarGU'])){
		EditarUsuario(false,$_POST['usuario']);
	}elseif (isset($_POST['BorrarGU'])){
		BorrarUsuario();
	}elseif(isset($_POST['NuevoUsuario'])){
		InsertarUsuario();
	}elseif(isset($_POST['editar'])){
		EditarUsuario(false,$_SESSION['email']);
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
		echo "<p>¿Desea confirmar los datos?<p>";
	} elseif(isset($_POST['ConfirmarInsercion'])){
		$claves = $_SESSION['claves'];
		$lugar = $_SESSION['lugar'];
		$titulo = $_SESSION['titulo'];
		$descripcion = $_SESSION['descripcion'];
		nuevaIncidencia($claves, $lugar, $titulo, $descripcion);
		EDITARINCIDENCIA();
	}
	elseif(isset($_POST['EnviarCriterios'])){
		$criterio = $_POST['radioGroup']; 

		$pendiente = isset( $_POST['Pendiente']) ? $pendiente = 1 : $pendiente = 0;
		$comprobada = isset( $_POST['Comprobada']) ? $comprobada = 1 : $comprobada = 0;
		$tramitada = isset( $_POST['Tramitada']) ? $tramitada = 1 : $tramitada = 0;
		$irresoluble = isset( $_POST['Irresoluble']) ? $irresoluble = 1 : $irresoluble = 0;
		$resuelta = isset( $_POST['Resuelta']) ? $resuelta = 1 : $resuelta = 0;

		VerIncidencias($criterio, $pendiente, $comprobada, $tramitada, $irresoluble, $resuelta);
	}
	elseif(isset($_GET['p']) && $_GET['p']=="inicio"){
		HTMLVER();
	} elseif (isset($_GET['p']) && $_GET['p']=="incidencia") {
		HTMLNUEVA(false);	
	} elseif (isset($_GET['p']) && $_GET['p']=="otras") {
		HTMLMISINCIDENCIAS();
	} elseif (isset($_GET['p']) && $_GET['p']=="usuarios") {
		HTMLUSER();
	} elseif (isset($_GET['p']) && $_GET['p']=="log") {
		HTMLLOG();
	} elseif (isset($_GET['p']) && $_GET['p']=="BBDD") {
		//HTMLBBDD();
		echo "<p>Gestion BBDD</p>";
	}else
		echo "<p>Ver incidencia</p>";
	echo "</main>";
			HTMLlateral($tipo,$email,$clave);
	echo "</div>";
	HTMLfooter();
	HTMLfin();
?>