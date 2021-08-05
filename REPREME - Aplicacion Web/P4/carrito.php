<?php
		include_once("includes/lib_carrito.php");
		require_once __DIR__.'/includes/config.php';
		require_once __DIR__.'/includes/Aplicacion.php';
		if (!isset($_SESSION["ocarrito"])){
			$_SESSION["ocarrito"] = new Carrito();
		}
		if($_SESSION["ocarrito"]->numElems() == 0){
			$html='<p>Tu carrito esta vacio.</p>
			<input type="button" onclick="location='."'vistaProductos.php?categoria=todos'".'" value = "VOLVER A LA TIENDA" />';
		}else {
			$html=$_SESSION["ocarrito"]->imprime_carrito();
			$html .='<p><input id="botonN" type="button" onclick="location='."'finalizarCompra.php'".'" value = "FINALIZAR COMPRA" />
		<input id="botonN" type="button" onclick="location='."'vistaProductos.php?categoria=todos'".'" value = "SEGUIR COMPRANDO" /></p>';
		}
	
	
	?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Carrito</title>
</head>

<body>

<div id="contenedor_carrito">

	

	<?php require 'includes/comun/cabecera.php'; ?>


  <div id="contenido_carrito">
	<h1> CARRITO </h1>

	
	<?php
		echo $html;
			
	?>
	</div>
<?php require 'includes/comun/pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>