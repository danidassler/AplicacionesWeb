<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioBusqueda.php';

$formulario = new FormularioBusqueda();
$html = $formulario->gestiona();


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Buscador</title>
	</head>

	<body>
		<div class="contenedor">
			<?php require 'includes/comun/cabecera.php'; ?>
			<div class="contenido">
				<?php
				echo $html;	
				?>
				
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>