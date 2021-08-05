<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioCompra.php';

	require_once 'includes/Aplicacion.php';
	$formulario = new FormularioCompra();
	$html=$formulario->gestiona();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Finalizar compra</title>
</head>

<body>

<div class="contenedor">

	<?php require 'includes/comun/cabecera.php'; ?>


		<div id="contenido_finalizarcompra">
		<?php
			echo $html;
			
		?></div>

<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>