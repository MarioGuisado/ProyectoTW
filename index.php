<?php
	require "./Paginabase.php";
	require "./Formularios.php";

	HTMLinicio();
	HTMLtitulo();
	HTMLnav();
	echo "<div>
		<section>";
	if(isset($_GET['p']) && $_GET['p']=="inicio"){
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
			HTMLlateral();
	echo "</div>";
	HTMLfooter();
	HTMLfin();
?>