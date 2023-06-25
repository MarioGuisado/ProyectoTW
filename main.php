<?php
require_once ("./Formularios.php");
require_once ("./BBDD.php");

function HTMLUSER(){
	if(isset($_POST['NuevoUser'])){
		echo "<section>";
		NuevoUsuario();
		echo "</section>";
	}else{
		echo <<< HTML
			<h2>Gestion de usuarios</h2>
			<form method="post" action="./index.php?p=usuarios">
				<input type='submit' name='Listar' value='Listar usuarios'/>
				<input type='submit' name='NuevoUser' value='Nuevo usuario'/>
			</form>
		HTML;
		
		if (isset($_POST['Listar'])){
			echo "<section>";
			ListarUsuarios();
			echo "</section>";
		}
	}
}

?>