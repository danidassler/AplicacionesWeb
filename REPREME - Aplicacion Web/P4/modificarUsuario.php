<?php

	include_once("includes/DAOinfousuario.php");
	include_once("includes/Usuario.php");
	include_once("includes/FormularioUsuario.php");
	require_once __DIR__.'/includes/config.php';

	$nombre_usuario=$_SESSION["usuario"];
	$infousuarioDAO = new InfoUserDAO();
	$u = $infousuarioDAO->getInfoUser($nombre_usuario);
	
	$datosUsuario = array();
	$datosUsuario['user']= $u->getUser();
	$datosUsuario['nombre']= $u->getNombre();
	$datosUsuario['apellido']= $u->getApellido();
	$datosUsuario['dni']= $u->getDni();
	$datosUsuario['direccion']= $u->getDireccion();
	$datosUsuario['cp']= $u->getCodPostal();
	$datosUsuario['pais']= $u->getPais();
	$datosUsuario['localidad']= $u->getLocalidad();
	$datosUsuario['provincia']= $u->getProvincia();
	$datosUsuario['telefono']= $u->getTelefono();
	$datosUsuario['correo']= $u->getEmail();
	$datosUsuario['myfile']= $u->getImagen();
	$formulario = new FormularioUsuario();
	$html= $formulario->gestionaU($datosUsuario);
?>

<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de modificación de usuario</title>
	</head>

	<body>
		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>

			<div id="contenido_modusuario">
				<?php
				
				echo $html;
				

				
				?>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
	</html>
