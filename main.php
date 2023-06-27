<?php
require_once ("./Formularios.php");
require_once ("./BBDD.php");

function HTMLUSER(){
	echo <<< HTML
		<h2>Gestión de usuarios</h2>
		<form method="post" action="./index.php?p=usuarios" class="gestion">
			<input type='submit' name='Listar' value='Listar usuarios'/>
			<input type='submit' name='NuevoUser' value='Nuevo usuario'/>
		</form>
	HTML;
		
	if(isset($_POST['NuevoUser'])){
		echo "<section>";
		NuevoUsuario();
		echo "</section>";
	}elseif (isset($_POST['Listar'])){
		echo "<section>";
		ListarUsuarios();
		echo "</section>";
	}elseif(isset($_POST['EditarGU'])){
		echo "<section>";
		EditarUsuario(false,$_POST['usuario']);
		echo "</section>";
	}elseif (isset($_POST['BorrarGU'])){
		echo "<section>";
		BorrarUsuario();
		echo "</section>";
	}elseif(isset($_POST['ConfUser'])){
		echo "<section>";
		ConfNuevoUsuario();
		echo "</section>";
	}elseif(isset($_POST['MeterUsuario'])){
		echo "<section>";
		InsertarUsuario();
		echo "</section>";
	}else if(isset($_POST['ConfirmarBorrado'])){
		ConfBorrar();
	}elseif(isset($_POST['Modificacion'])){
		EditarUsuario2();
	} elseif(isset($_POST['confirmarModificacion'])){
		ModificarUsuario();
	}
}

function HTMLBBDD(){
	echo <<< HTML
		<h2>Copia de seguridad de la BBDD</h2>
		<form method="post" action="./index.php?p=usuarios" class="gestion">
			<input type='submit' name='download' value='Obtener copa de seguridad'/>
		</form>
	HTML;
}

?>