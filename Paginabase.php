<?php
function HTMLinicio(){
	echo <<< HTML
	<!DOCTYPE html5>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./estilos.css">
		<meta charset="UTF-8">
		<title>Página Principal</title>
	</head>
	<body>
	HTML;
}

function HTMLfin(){
	echo <<< HTML
		</body>
		</html>
	HTML;
}

function HTMLtitulo(){
	echo <<< HTML
	<header>
		<div class="titulo">
			<img src="icono_incidencia.png" alt="Altavoz de queja">
			<h1>Por un municipio mejor</h1>
		<div>
		<h2> Informa de cualquier incidencia sobre el servicio público para ayudar a mejorarlo</h2>
	</header>
	HTML;
}

function HTMLnav($x){
	echo <<< HTML
	<nav>
		<ul>
			<li><a href="./index.php?p=inicio">Ver incidencias</a></li>
	HTML;
	if(isset($x)){
		echo <<< HTML
			<li><a href="./index.php?p=incidencia">Nueva incidencia</a></li>
			<li><a href="./index.php?p=otras">Más incidencias</a></li>
		HTML;
		if($x == "administrador"){
			echo <<< HTML
				<li><a href="./index.php?p=usuarios">Gestión de usuarios</a></li>
				<li><a href="./index.php?p=log">Ver log</a></li>
				<li><a href="./index.php?p=BBDD">Gestion de BBDD</a></li>
			HTML;
		}
	}
	echo <<< HTML
		</ul>
	</nav>
	HTML;
}

function HTMLfooter(){
	echo <<< HTML
	<footer>
		<div>
			<ul>
				<li>© 2023 Lucía Ansino Ariza y Mario Guisado García</li>
				<li><a href="">Protección de datos</a></li>
				<li><a href="">Fuentes Web</a></li>
				<li><a href="">Aviso legal</a></li>
				<li><a href="">Políticas de cookies</a></li>
			</ul>
		</div>
		<div>
			<a href=""><img src="./Twitter.png"></a>
			<a href=""><img src="./facebook.png"></a>
			<a href=""><img src="./YouTube.png"></a>
		</div>
	</footer>
	HTML;
}

function logeo(){
	echo <<< HTML
	<div class="logeo">
		<form action="./index.php" method="POST">
			<label>Email: <input type="email" name="email" placeholder="Introduzca su email"></label>
			<label>Clave: <input type="password" name="clave" placeholder="Introduzca su clave" ></label>
			<input type="submit" value="Login"/>
		</form>
	</div>
	HTML;
}
function infoUsuario(){
	echo <<< HTML
	<div class="logeo">
		<p id="nombre"> Nombre usuario</p>
		<p id="tipo_user"> Tipo usuario</p>
		<img src=""alt="Foto de usuario">
		<div>
			<form action="./index.php" method="POST">
			<input type="submit" name="editar" value="Editar">
			<input type="submit" name="logout" value="Logout">
			</form>
		</div>
	</div>
	HTML;
}

function HTMLlateral($x){
	echo <<< HTML
	<aside>
	HTML;
	if(isset($x)){
		infoUsuario();
	}else{
		logeo();
	}
	echo <<< HTML
			<div class = "otros">
				<ol>Ranking de incidencias
					<li>User1</li>
					<li>User2</li>
					<li>Ueser3</li>
				</ol>
				<ol>Ranking de opiniones
					<li>User1</li>
					<li>User2</li>
					<li>User3</li>
				</ol>
				<p>Incidencias pendientes: x</p>
				<p>Incidencias resueltas: x</p>
			</div>
		</aside>
	HTML;
}
?>