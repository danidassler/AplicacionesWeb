<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Portada</title>
</head>

<body>

<div id="contenedor">

	<?php session_start(); ?>

	<?php require 'cabecera.php'; ?>

    <?php require 'sidebarIzq.php'; ?>

<div id="contenido">
		<?php 
		# preguntar si contenido se tiene que hacer asi, teniendo la estructura entera de la pagina o se hace como el resto (lo mismo pasa con admin)
			if(!isset($_SESSION["login"])){
				?>
				<h1>Error</h1>
				<p>No tienes permisos para acceder a esta sección, registrate --> <a href='login.php'>Login</a> </p>
				<?php
			}
			else{
				?>
				<h1>Contenido exclusivo</h1>
				<p>Este contenido es exclusivo para los usuarios registrados</p>
				<?php
			}
		?>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>

