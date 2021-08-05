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
			if(!isset($_SESSION["esAdmin"])){
				?>
				<h1>Error</h1>
				<p>No tienes permisos para acceder a esta sección, acceso denegado</p>
				<?php
			}
			else{
				?>
				<h1>Consola de administrador</h1>
				<p>Esta es la consola del administrador</p>
				<?php
			}
		?>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>

