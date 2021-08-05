
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Pestaña de login</title>
</head>

<body>

<div id="contenedor">

	<?php session_start(); ?>

	<?php require 'cabecera.php'; ?>

    <?php require 'sidebarIzq.php'; ?>

	<div id="contenido">
		<form action="procesarLogin.php" method="post">
			<fieldset>
				<legend>Datos del usuario</legend>
					Username:<p> <input type="text" name="nom"></p>
					Password: <p> <input type="text" name="con"></p>
	
			</fieldset>
			<input type="submit" name="aceptar">	
		</form>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>