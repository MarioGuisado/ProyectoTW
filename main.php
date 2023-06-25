<?php
require_once("./Formularios.php");
require_once("./BBDD.php");

function HTMLUSER(){
	echo <<< HTML
		<h2>Gestion de usuarios</h2>
		<div>
			<input type='submit' name='Listar' value='Listar usuarios'/>
			<input type='submit' name='NuevoUser' value='Nuevo usuario'/>
		</div>
	HTML;
	if(isset($_POST['Listar'])){
		echo "<section>";
		ListarUsuarios();
		echo "</section>";
	}elseif(isset($_POST['NuevoUser'])){
		echo "<section>";
		NuevoUsuario();
		echo "</section>";
	}
}

?>