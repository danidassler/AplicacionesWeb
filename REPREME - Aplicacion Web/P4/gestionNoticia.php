<?php

	include_once("includes/DAOnoticia.php");
	include_once("includes/FormularioNoticia.php");
	require_once __DIR__.'/includes/config.php';

	$idnoticia = $_GET['id'];
	$gestion = $_GET['gestion'];

	$noticiaDAO = new NoticiaDAO();
	$n = $noticiaDAO->getNoticia($idnoticia);
	$disponibilidad;

	if($gestion == "baja"){
		$disponibilidad = "inactiva";
		$n->setDisponibilidad($disponibilidad);
		$noticiaDAO->update($n);
		header("Location:vistaNoticias.php");
	}else if($gestion == "alta"){
		$disponibilidad = "activa";
		$n->setDisponibilidad($disponibilidad);
		$noticiaDAO->update($n);
		header("Location:vistaNoticias.php");

	}else{
		$datosNoticia = array();

				if($gestion == "modificar"){
				$datosNoticia['id']= $n->getId();
				$datosNoticia['titulo']= $n->getTitulo();
				$datosNoticia['parrafo1']= $n->getParrafo1();
				$datosNoticia['parrafo2']= $n->getParrafo2();
				$datosNoticia['parrafo3']= $n->getParrafo3();
				$datosNoticia['imagen']= $n->getImagen();
				$datosNoticia['disponibilidad']= $n->getDisponibilidad();
				
				
				}
				$formulario = new FormularioNoticia();
				$html = $formulario->gestionaNoticia($datosNoticia);
		
		
		
		
	?>

		<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de modificación de productos</title>
	</head>

	<body>
		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>

			<div id="contenido_modificar_producto">
				<div id="modificar_producto_item1">
				
				<?php
				echo $html;
				?>
				</div>
				<div id="modificar_producto_item2"><img src="img/director_chair.png" class="director_chair"/></div>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
	</html>
<?php
		
	}

?>

