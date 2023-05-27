<?php
function HTMLinicio(){
	echo <<< HTML
	<!DOCTYPE html>
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

function HTMLnav(){
	echo <<< HTML
	<nav>
		<ul>
			<li><a href="">Ver incidencias</a></li>
			<li><a href="">Nueva incidencia</a></li>
			<li><a href="">Más incidencias</a></li>
			<li><a href="">Gestón de usuarios</a></li>
			<li><a href="">Ver log</a></li>
			<li><a href="">Gestion de BBDD</a></li>
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

function HTMLlateral(){
	echo <<< HTML
	<aside>
			<div class="logeo">
				<form action="" method="POST">
					<label>Email: <input type="email" name="email" placeholder="Introduzca su email"></label>
					<label>Clave: <input type="password" name="clave" placeholder="Introduzca su clave" ></label>
					<input type="submit" value="Login"/>
				</form>
			</div>
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