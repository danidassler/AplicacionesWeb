<?php


	require_once __DIR__.'/includes/config.php';
	include_once("includes/DAOinfousuario.php");
	include_once("includes/DAOventaproducto.php");
	include_once("includes/DAOventa.php");
	include_once("includes/DAOproducto.php");
	include_once("includes/DAOfavoritos.php");
	include_once("includes/Usuario.php");
	include_once("includes/Aplicacion.php");
	$nombre_usuario=$_SESSION["usuario"];
	$infousuarioDAO = new InfoUserDAO();
	$ventaDAO = new VentaDAO();
	$productoDAO = new ProductoDAO();
	$ventaproductoDAO = new VentaProductoDAO();
	$favoritosDAO = new FavoritosDAO();
	$array_fav= array();
	$array_fav= $favoritosDAO->getProductosFavoritosPorUsuario($nombre_usuario);
	$array_ventas= array();
	$array_ventas= $ventaDAO->getVentasPorUsuario($nombre_usuario);
	$u = $infousuarioDAO->getInfoUser($nombre_usuario);

	if(isset($_GET["compra"]) && isset($_GET["fav"])){
		$compra = $_GET["compra"];
		$fav = $_GET["fav"];
	}
	else{
		$fav = 0;
		$compra = 0;
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>USUARIO</title>
</head>

<body>

<div class="contenedor">

	<?php require 'includes/comun/cabecera.php'; ?>

	<div id="contenidoU">
		<div id="imagenUsuario">
			<h3>Tu perfil, <?php echo $u->getUser() ?> .</h3>
			<img class="ImagenUser" src="<?php echo $u->getImagen() ?>" alt="usuario" width="360" height="360" /> 
		</div>
		<div id="informacionUsuario">
			<h3>Tus datos personales</h3>
			<p><b>Nombre:</b>  <?php echo $u->getNombre() ?></p>
			<p><b>Apellidos:</b>  <?php echo $u->getApellido() ?></p>
			<p><b>DNI: </b><?php echo $u->getDni() ?></p>
			<p><b>Direccion:</b> <?php echo $u->getDireccion() ?></p>
			<p><b>CP: </b><?php echo $u->getCodPostal() ?></p>
			<p><b>Pais(nacionalidad):</b> <?php echo $u->getPais() ?></p>
			<p><b>Localidad: </b><?php echo $u->getLocalidad() ?></p>
			<p><b>Provincia:</b> <?php echo $u->getProvincia() ?></p>
			<p><b>Telefono:</b> <?php echo $u->getTelefono() ?></p>
			<p><b>Email:</b> <?php echo $u->getEmail() ?></p>
			<p>
				<input id="botonN" type="submit" name="modU" onclick="location='modificarUsuario.php'" value="MODIFICAR DATOS">
				<input id="botonN" type="submit" name="modU" onclick="location='logout.php'" value="LOGOUT">
			</p>
		</div>
	</div>
		<div id="favoritos_usuario">
			<fieldset>
				<legend> TUS PRODUCTOS FAVORITOS </legend>
					<?php 
						if($fav==1){
								$b = count($array_fav);
							}else {
								$b = 3;
							}
						$a = count($array_fav);
						if($a > 0){
							if($a <$b){
								$b = $a;
							}
					?>
							<table id='BTabla2'>
							<tr>
							<th class='colu'> Producto </th>
							<th class='colu'> Nombre </th>
							<th class='colu'> Precio </th>
							<th class='colu'> Eliminar favorito </th>
							</tr>
					<?php
							for($i=0; $i<$b; $i++){
								$idprod = $array_fav[$i];
								$producto = $productoDAO->getProducto($idprod);		
					?>
								<tr id="modifcacion">
								<td class='CeldaMod'><a href='vistaProducto.php?id=<?php echo $producto->getId()?>&categoria=<?php echo $producto->getCategoria() ?>&valor=0&comen=0'> <img src='<?php echo $producto->getImagen()?>'alt='Imagen' width='100' height='100'/></a></td>
								<td class='CeldaMod'> <?php echo $producto->getNombre()?></td>
								<td class='CeldaMod' > <b style="color:green;"> <?php echo $producto->getPrecio()?> € <b></td>
								<td class='CeldaMod'> <a href='eliminar_favorito.php?id=<?php echo $idprod?>&lugar=1'> <img id='eliminar_fav' src='img/x.png' ></a> </td>
								</tr>
					<?php
							}
					?>
							</table>
							<form action ="perfilUsuario.php?compra=0&fav=0" method = "POST">
						<?php
						if($fav == 1){?>
						<input type="submit" name="mostrarMF" id="mostrarMF" value="Mostrar menos" formaction="perfilUsuario.php?compra=<?php echo $compra?>&fav=0">
						
						<?php
						}else {
							?>
							<input type="submit" name="mostrarF" id="mostrarF" value="Mostrar más" formaction="perfilUsuario.php?compra=<?php echo $compra?>&fav=1">
						<?php
							}
						?>
					 </form>
							
					<?php
						}
						else{
					?>
							<p id="nocom">¡VAYA! PARECE QUE AUN NO TIENES PRODUCTOS FAVORITOS</p>
							<img id="notfound" src="img/robotito.png" alt="sin comentarios" />
					<?php
						}
					?>
			</fieldset>
		</div>
		<div id="compras_usuario">
			<fieldset>
				<legend> TUS PRODUCTOS COMPRADOS </legend>
					<?php
						if($compra==1){
								$b = count($array_ventas);
							}else {
								$b = 3;
							}
						$a = count($array_ventas);
						if($a > 0){
							if($a <$b){
								$b = $a;
							}
					?>
							<table id='BTabla'>
							<tr>
							<th class='colu'> Producto </th>
							<th class='colu'> Nombre </th>
							<th class='colu'> Cantidad </th>
							<th class='colu'> Fecha de compra </th>
							</tr>
					<?php
							for($i=0; $i<$b; $i++){
								$venta = $ventaDAO->getVenta($array_ventas[$i]);
								$ventaP = $ventaproductoDAO->getVentaProducto($array_ventas[$i]);
								$idprod = $ventaP->getidProducto();
								$producto = $productoDAO->getProducto($idprod);		
					?>
								<tr id="modifcacion">
								<td class='CeldaMod'><a href='vistaProducto.php?id=<?php echo $producto->getId()?>&categoria=<?php echo $producto->getCategoria() ?>&valor=0&comen=0'> <img src='<?php echo $producto->getImagen()?>'alt='Imagen' width='100' height='100'/></a></td>
								<td class='CeldaMod'> <?php echo $producto->getNombre()?></td>
								<td class='CeldaMod'>  <?php echo $ventaP->getunidades()?> uds</td>
								<td class='CeldaMod'> <?php echo $venta->getFecha()?> </td>
								</tr>
					<?php
							}
					?>
							</table>
						<form action ="perfilUsuario.php?compra=0" method = "POST">
						<?php
						if($compra == 1){?>
						<input type="submit" name="mostrarMC" id="mostrarMC" value="Mostrar menos" formaction="perfilUsuario.php?compra=0&fav=<?php echo $fav ?>">
						
						<?php
						}else {
							?>
							<input type="submit" name="mostrarC" id="mostrarC" value="Mostrar más" formaction="perfilUsuario.php?compra=1&fav=<?php echo $fav ?>">
						<?php
							}
						?>
					 </form>
					 <?php
						}else{
					?>
							<p id="nocom">¡VAYA! PARECE QUE AUN NO HAS COMPRADO NADA</p>
							<img id="notfound" src="img/robotito.png" alt="sin comentarios" />
					<?php
						}
					?>
			
			</fieldset>
		</div>
		

<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->


</body>
</html>