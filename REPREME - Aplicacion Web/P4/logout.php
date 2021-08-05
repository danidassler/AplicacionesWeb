<?php 
require_once __DIR__.'/includes/config.php';
				
				// cero que se puede hacer solo llamando unset($_SESSION) y ya se borra todo
				unset($_SESSION["login"]);
				unset($_SESSION["esAdmin"]);
				unset($_SESSION["usuario"]);
				unset($_SESSION["ocarrito"]);
				unset($_SESSION["totalCompra"]);
				session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Procesar Logout</title>
	</head>

	<body>
		<div class="contenedor">

			
			
			<?php require 'includes/comun/cabecera.php'; ?>
			
			<div id="contenidoOut">
				<p> ¡Hasta luego!</p>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>
