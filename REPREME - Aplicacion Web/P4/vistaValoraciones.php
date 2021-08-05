<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
include_once("includes/DAOvaloraciones.php");
include_once("includes/DAOproducto.php");

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de valoraciones</title>
	</head>

	<body>
		<div class="contenedor">
			<?php require 'includes/comun/cabecera.php'; ?>
			<div class="contenido">
		<?php
			$valoracionDAO=new ValoracionDAO();
			$productoDAO =new ProductoDAO();
			$arrayValoraiones = array();
			$arrayValoraciones = $valoracionDAO->coger_valoraciones(-1);
			$numResults= sizeof($arrayValoraciones);	

			if($numResults>0){
		?>
				<p>Hemos encontrado <?php echo $numResults ?> valoraciones.</p>
				<table id='BTabla'>
				<tr>
				<th class='colu'> Producto </th>
				<th class='colu'> Valoracion </th>
				<th class='colu'> Usuario </th>
				<th class='colu'> Eliminar valoracion </th>
				</tr>
		<?php
				for($i=0; $i<$numResults;$i++)
				{
				$valoracion = $valoracionDAO->getValoracion($arrayValoraciones[$i]);
				$producto = $productoDAO->getProducto($valoracion->getIdprod());
		?>
				<tr id="modifcacion">
				<td class='CeldaMod'><a href='vistaProducto.php?id=<?php echo $producto->getId()?>&categoria=<?php echo $producto->getCategoria() ?>&valor=0&comen=0'> <img src='<?php echo $producto->getImagen()?>'alt='Imagen' width='100' height='100'/></a></td>
				<td class='CeldaMod'> <?php for($z=1; $z<=$valoracion->getPuntuacion(); $z++){echo "★ ";} ?></td>
				<td class='CeldaMod'> " <?php echo $valoracion->getUser()?>"</td>
				<td class='CeldaMod'> <a href="procesarValoraciones.php?lugar=1&accion=eliminar&idValoracion=<?php echo $valoracion->getIdValoracion() ?>&idProd=<?php echo $valoracion->getIdprod() ?>"><img src="img/papelera.png" height="30px" width="50px"/></a></td>
				


				</tr>
		<?php
				}
			?>
				</table>
		<?php
			}else{
		?>
			<p id="nocom">¡VAYA! PARECE QUE TODAVIA NO HAY VALORACIONES</p>
			 <img id="notfound" src="img/robotito.png" alt="sin comentarios" />
		<?php
			}

		?>

				
			</div>
			<!--sin pie de pag-->
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
		
	</body>
</html>