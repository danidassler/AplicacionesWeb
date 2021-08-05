<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de administrar</title>
	</head>

	<body>
		<div class="contenedor">
			<?php require 'includes/comun/cabecera.php'; ?>
			
				<div class="cabeceraProductos">
					<div id='admin'>ADMINISTRADOR</div>
				</div>
				<div id="contenidoAdmin">
				<!--<div id="vistaAdmin">-->
				<table id="tablaAdmin"> 
				<tbody>
				<tr>
					<td>
					<a href='modificarProducto.php?id=-1&gestion=insertar&categoria=ropa'>
		            <img class= "img1" alt="Insertar producto" width="300" height="300" onmouseout="this.src='img/insertarProducto.png';" onmouseover="this.src='img/insertarP.jpg';" src="img/insertarProducto.png"/>
		            <p id="tituloAdmin">Insertar producto</p>
		            </a>
		            </td>
					<td>
		            <a href='buscador.php'>
		            <img class= "img2"  alt="Modificar producto" width="300" height="300" onmouseout="this.src='img/modificarProducto.png';" onmouseover="this.src='img/modificarP.jpg';" src="img/modificarProducto.png"/>
		            <p id="tituloAdmin">Modificar producto</p>
		            </a>
					</td>
					<td>
		            <a href='vistaComentarios.php'>
		            <img class= "img3" alt="Eliminar comentario" width="300" height="300" onmouseout="this.src='img/modificarComentarios.png';" onmouseover="this.src='img/Admincom.jpg';" src="img/modificarComentarios.png"/>
		            <p id="tituloAdmin">Administrar comentarios</p>
		            </a>
					</td>
					</tr>
					<tr>
					<td>
					<a href='vistaValoraciones.php'>
		            <img class= "img4" alt="Eliminar valoracion" width="300" height="300" onmouseout="this.src='img/estrellavaloraciones.png';" onmouseover="this.src='img/adminValoraciones.jpg';" src="img/estrellavaloraciones.png"/>
		            <p id="tituloAdmin">Administrar valoraciones</p>
		            </a>
					<td>
		            <a href='gestionNoticia.php?id=-1&gestion=insertar'>
		            <img class= "img1" alt="Insertar noticia" width="300" height="300" onmouseout="this.src='img/noticiaN.png';" onmouseover="this.src='img/insertarNot.jpg';" src="img/noticiaN.png"/>
		            <p id="tituloAdmin">Insertar noticia</p>
		            </a>
					</td>
					<td>
		            <a href='buscadorNoticias.php'>
		            <img class= "img2"  alt="Modificar noticia" width="300" height="300" onmouseout="this.src='img/modificarProducto.png';" onmouseover="this.src='img/ModificarNot.jpg';" src="img/modificarProducto.png"/>
		            <p id="tituloAdmin">Modificar noticias</p>
		            </a>
					</td>
					</tr>
					</tbody>
					</table>
				<!--</div>-->	
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>