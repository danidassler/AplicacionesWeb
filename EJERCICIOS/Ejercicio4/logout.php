
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Procesar Logout</title>
</head>

<body>

<div id="contenedor">

	<?php 
		unset($_SESSION["login"]);
		unset($_SESSION["nombre"]);
		unset($_SESSION["esAdmin"]);
		session_destroy();
	?>
	
	<?php require 'cabecera.php'; ?>

    <?php require 'sidebarIzq.php'; ?>
    
	<div id="contenido">
		<?php
			   echo "Hasta luego !";
        ?>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>