<?php
require_once __DIR__.'/includes/config.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Pestaña de contacto</title>
</head>

<body>

<div class="contenedor">

	

	<?php require 'includes/comun/cabecera.php'; ?>

	<div id="contenido_formulario">
		<div id="contacto_item1"></div>
		<div id="contacto_item2"><form action="procesarPaginaContacto1.php" method="post">
			<fieldset id = "formulario">
					<legend> CONTACTA CON NOSOTROS </legend>
						<p>Nombre: <span>*</span> <input type="text" name="nombre" required></p>
						<p>Apellidos: <span>*</span> <input type="text" name="apellido" required></p>
						<p>Nombre de usuario: <input type="text" name="user" required>
						<p>Dirección de correo electrónico: <span>*</span> <input type="email" name="email" required></p>
						<p>Numero de pedido: <input type="text" name="n_pedido"></p>
						<p>Consulta: <span>*</span></p> <textarea name="consulta" required>Escribe tu consulta aqui</textarea>
						<p><input type="submit" name="aceptar"></p>
			</fieldset>	
		</form></div>
		<div id="contacto_item3"></div>
	</div>
<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>