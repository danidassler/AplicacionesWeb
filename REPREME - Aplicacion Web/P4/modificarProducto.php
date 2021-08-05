<?php

	include_once("includes/DAOproducto.php");
	include_once("includes/FormularioProducto.php");
	require_once __DIR__.'/includes/config.php';

	$idproducto = $_GET['id'];
	$gestion = $_GET['gestion'];

	$productoDAO = new ProductoDAO();
	$p = $productoDAO->getProducto($idproducto);
	$disponibilidad;
	$categoria = $_GET['categoria'];


	if($gestion == "baja"){
		$disponibilidad = "inactivo";
		$p->setDisponibilidad($disponibilidad);
		$productoDAO->update($p);
		header("Location:vistaProductos.php?categoria=$categoria");
	}else if($gestion == "alta"){
		$disponibilidad = "activo";
		$p->setDisponibilidad($disponibilidad);
		$productoDAO->update($p);
		header("Location:vistaProductos.php?categoria=$categoria");

	}else{
		$datosProducto = array();

				if($gestion == "modificar"){
				$datosProducto['id']= $p->getId();
				$datosProducto['nombre']= $p->getNombre();
				$datosProducto['precio']= $p->getPrecio();
				$datosProducto['descripcion']= $p->getDescripcion();
				$datosProducto['stockDisponible']= $p->getStockDisponible();
				$datosProducto['talla']= $p->getTalla();
				$datosProducto['color']= $p->getColor();
				$datosProducto['categoria']= $p->getCategoria();
				$datosProducto['subcategoria']= $p->getSubcategoria();
				$datosProducto['disponibilidad']= $p->getDisponibilidad();
				$datosProducto['marca']= $p->getMarca();
				$datosProducto['imagen']= $p->getImagen();
				
				
				}
				$formulario = new FormularioProducto();
				$html = $formulario->gestionaProducto($datosProducto);
		
		
		
		
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

