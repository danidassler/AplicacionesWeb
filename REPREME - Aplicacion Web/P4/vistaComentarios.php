<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
include_once("includes/DAOcomentarios.php");
include_once("includes/DAOproducto.php");

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de comentarios</title>
	</head>

	<body>
		<div class="contenedor">
			<?php require 'includes/comun/cabecera.php'; ?>
			<div class="contenido">
		<?php
			$comentarioDAO=new ComentarioDAO();
			$productoDAO =new ProductoDAO();
			$arrayComentarios = array();
			$arrayComentarios = $comentarioDAO->coger_comentarios(-1);
			$numResults= sizeof($arrayComentarios);	

			if($numResults>0){
		?>
				<p>Hemos encontrado <?php echo $numResults ?> comentarios.</p>
				<table id='BTabla'>
				<tr>
				<th class='colu'> Producto </th>
				<th class='colu'> Comentario </th>
				<th class='colu'> Usuario </th>
				<th class='colu'> Eliminar comentario </th>
				</tr>
		<?php
				for($i=0; $i<$numResults;$i++)
				{
				$comentario = $comentarioDAO->getComentario($arrayComentarios[$i]);
				$producto = $productoDAO->getProducto($comentario->getIdProd());
		?>
				<tr id="modifcacion">
				<td class='CeldaMod'><a href='vistaProducto.php?id=<?php echo $producto->getId()?>&categoria=<?php echo $producto->getCategoria() ?>&valor=0&comen=0'> <img src='<?php echo $producto->getImagen()?>'alt='Imagen' width='100' height='100'/></a></td>
				<td class='CeldaMod'> "<?php echo $comentario->getDescripcion() ?>"</td>
				<td class='CeldaMod'> " <?php echo $comentario->getUser()?>"</td>
				<td class='CeldaMod'> <a href="procesarComentarios.php?lugar=1&accion=eliminar&idComentario=<?php echo $comentario->getIdComentario() ?>&idProd=<?php echo $comentario->getIdProd() ?>"><img src="img/papelera.png" height="30px" width="50px"/></a></td>
				


				</tr>
		<?php
				}
			?>
				</table>
		<?php
			}else{
		?>
			<p id="nocom">¡VAYA! PARECE QUE TODAVIA NO HAY COMENTARIOS</p>
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