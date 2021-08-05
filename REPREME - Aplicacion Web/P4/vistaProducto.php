<?php 

	include_once("includes/DAOproducto.php");
	include_once("includes/DAOvaloraciones.php");
	include_once("includes/DAOinfousuario.php");
	include_once("includes/TransferObjects/valoraciones.php");
	include_once("includes/lib_carrito.php");
	include_once("includes/DAOcomentarios.php");
	include_once("includes/DAOfavoritos.php");
	require_once __DIR__.'/includes/config.php';
	include_once("includes/Aplicacion.php");
	
	if (!isset($_SESSION["ocarrito"])){
		$_SESSION["ocarrito"] = new Carrito();
	}
	$idproducto = $_GET['id'];
	$productoDAO = new ProductoDAO();
	$comentarioDAO=new ComentarioDAO();
	$valoracionDAO=new ValoracionDAO();
	$UserInfoDAO=new InfoUserDAO();
	$favoritosDAO = new FavoritosDAO();
	$p = $productoDAO->getProducto($idproducto);
	$apartadoTienda = $_GET["categoria"];
	// esto lo hago porque si no se pone asi, cada vez que entrabas a un producto y en la url no le pasabas el campo valor o comen 
	// te salia un "error" mas concertamente un notice diciendo que claro ese index no existia ya que no se lo habias pasado a la url
	// entonces es mas facil poner esto que estar poniendo los indices a las url de todos los vistaProducto que hay en la pagina
	// si no estan seteados se le asigna el valor 0 por defecto
	if(isset($_GET["valor"]) && isset($_GET["comen"])){
		$valor = $_GET["valor"];
		$comen = $_GET["comen"];
	}
	else{
		$valor = 0;
		$comen = 0;
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<meta charset="utf-8">
		<title>Producto</title>
		
	</head>

	<body>

		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>

			
			<div class="contenido">

				<div class="imagenes">
					<?php echo "<h1>".$p->getNombre()."</h1>"; ?>
					<div class="producto">
						<img class="productoC" alt="producto" width="300" height="300" onmouseout="this.src='<?php echo $p->getImagen() ?>'" onmouseover="this.src='<?php echo $p->getImagen2() ?>'" src="<?php echo $p->getImagen() ?>"/>
					<div class="descp">
						<?php 
							echo "<p>" .$p->getDescripcion(). "</p>";
							echo "<p id='precioP'>".$p->getPrecio()." € </p>";
							echo "<p><b> Talla : </b>".$p->getTalla()."</p>";
							echo "<p><b> Categoria : </b>". $p->getCategoria()."</p>";
							echo "<p><b> Subcategoria : </b>". $p->getSubcategoria()." </p>";
							if(!isset($_SESSION["login"]) || $_SESSION["login"] == false){
								?><img id="eliminar_fav" src="img/contornofavorito.png" > <b>Logueate para poder añadir productos a tu lista de favoritos</b><?php
							}
							else{
								$fav = $favoritosDAO->compruebaFavorito($p->getId(), $_SESSION["usuario"]);
								if($fav == true){
									?><a href="eliminar_favorito.php?id=<?php echo $p->getId()?>&lugar=0"> <img id="eliminar_fav" src="img/favorito.png" ></a><?php
								}
								else{
									?><a href="meter_favorito.php?id=<?php echo $p->getId()?>"> <img id="eliminar_fav" src="img/contornofavorito.png" ></a><?php
								}
							}
						?>
					</div>
					</div>
					<?php 
						$stock = $p->getStockDisponible();
						$cc = $_SESSION["ocarrito"]->cantidadEnCarrito($idproducto);
						$disponibles = $stock - $cc;
					if(isset($_SESSION["esAdmin"])&& $_SESSION["esAdmin"]){
					?>		
						<p> <?php echo "<b>Numero de unidades : </b>". $disponibles ?> </p>
							<form action="modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "modificar"?>&categoria=<?php echo $apartadoTienda?>" method="post">
								<p><input type="submit" name="modificarP" onclick="location='modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "modificar"?>&categoria=<?php echo $apartadoTienda?>'"value="MODIFICAR "></p>
							</form>
						<?php
						if($p->getDisponibilidad()=="activo"){ 
						?>
							<form action="modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "baja"?>&categoria=<?php echo $apartadoTienda?>" method="post">
								<p><input type="submit" name="bajaP" onclick="location='modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "baja"?>&categoria=<?php echo $apartadoTienda?>'" value="DAR DE BAJA "></p>
							</form>
						<?php 
						}else{
						?>
							<form action="modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "alta"?>&categoria=<?php echo $apartadoTienda?>" method="post">
								<p><input  type="submit" name="altaP" onclick="location='modificarProducto.php?id=<?php echo $idproducto?>&gestion=<?php echo "alta"?>&categoria=<?php echo $apartadoTienda?>'" value="DAR DE ALTA "></p>
							</form>
						<?php	
						}
					}
					else if($disponibles == 0){	
					?>
						<p>
						<h3> SOLD OUT </h3> 
						</p>
					<?php
					}
					else{
					?>
						<form action="meter_carrito.php?id=<?php echo $idproducto?>&lugar=1&categoria=<?php echo $apartadoTienda?>" method="post">
							<p>
							<b>Selecciona la cantidad:</b> <input type="number" name="cantidad" min="1" max=<?php echo $disponibles?> step="1" value="1">
							<input id="botonN" type="submit" name="anadirCarrito" value ="AÑADIR AL CARRITO"> 
							</p>
						</form>

					<?php		
					}
					?>
					
					<form action="procesarValoraciones.php?lugar=0&accion=insertar&idProd=<?php echo $idproducto ?>&valor=<?php echo $valor ?>&comen=<?php echo $comen ?>" method="post">
						<fieldset>
							<legend>VALORACIONES</legend>
							
							
						<?php
							if(!isset($_SESSION["esAdmin"]) || $_SESSION["esAdmin"]==false){
								?>
								<h3>Recuerda que si no estas logueado no podras valorar el producto</h3>
								
								<p>Indica tu puntuacion:
						
								<select name="val" id="val">
									<?php for ($i=1; $i<=5 ; $i++) echo '<option value="'.$i.'">'.$i.'★</option>';?>
								</select> 
								</p>
								<input type="submit" name="aceptar" value="Valorar">
							<?php
							}

							$array_valoraciones=$valoracionDAO->coger_valoraciones($idproducto);
							$b;
							if($valor == 1){
								$b = count($array_valoraciones);
							}else {
								$b = 3;
							}
							$i = count($array_valoraciones);
							if($i == 0) { 
								echo "<p>Este producto aun no tiene valoraciones</p>";
							}else{
								 if($i < $b){
								$b = $i;
								 }
								echo "<p>Valoraciones de usuarios:</p>";
								echo "<table id='tablaValoraciones'>";
									for($a=0; $a<$b; $a++)
									{	
										$valoracion= $valoracionDAO->getValoracion($array_valoraciones[$a]);
										$nombreuser=$valoracion->getUser();
										$usuario = $UserInfoDAO->getInfoUser($nombreuser);
										echo "<tr>";
										echo "<td><img class='imagenvaloraciones' src='".$usuario->getImagen()."' /></td>";
										echo "<td>";
										echo "<p><b> ".$valoracion->getUser()."</b></p>";
										echo "</td>";
										echo "<td>";
										echo "<p><b>Puntuacion:</b> ".$valoracion->getPuntuacion(). " ";
										for($z=1; $z<=$valoracion->getPuntuacion(); $z++){
											echo "★ ";
										}
										echo "</p>";
										echo "</td>";
										
										if(isset($_SESSION["esAdmin"])&& $_SESSION["esAdmin"]){
										echo "<td>";		
										?>
								
										<a href="procesarValoraciones.php?lugar=0&accion=eliminar&idValoracion=<?php echo $valoracion->getIdValoracion() ?>&idProd=<?php echo $idproducto ?>"><img src="img/papelera.png" height="30px" width="50px" /></a>
										<?php
										echo "</td>";
										}
										
										echo "</tr>";
									}
								echo "</table>";
							} 
							?>
						
					</form>
					<form method="post">
						<p>
						<?php if($valor == 1){
						echo '<input type="submit" name="mostrarMV" id="mostrarMV" value="Mostrar menos" formaction="vistaProducto.php?id='.$idproducto.'&categoria='.$apartadoTienda.'&valor=0&comen='.$comen.'">';
					}else {
						if(count($array_valoraciones)>3){
							echo'<input type="submit" name="mostrarV" id="mostrarV" value="Mostrar más" formaction="vistaProducto.php?id='.$idproducto.'&categoria='.$apartadoTienda.'&valor=1&comen='.$comen.'">';
						}
					}
						?> 
						
						</p>
						</form>
				</fieldset>	
					<form action="procesarComentarios.php?lugar=0&accion=insertar&idProd=<?php echo $idproducto ?>&valor=<?php echo $valor ?>&comen=<?php echo $comen ?>" method="post">
						<fieldset>
						<legend>COMENTARIOS</legend>
						
						<?php
						if(!isset($_SESSION["esAdmin"]) || $_SESSION["esAdmin"]==false){
							?>
								
								<h3>Recuerda que si no estas logueado no podras comentar</h3>
								<p>Deja tu comentario sobre este producto: </p>
								<p><textarea rows="7" cols="80" name="mensaje" placeholder="Escribe aquí el motivo" required=""></textarea> </p>
										
								<input type="submit" name="aceptar" value="Comentar">
							<?php
							}

							$array_comentarios=$comentarioDAO->coger_comentarios($idproducto);
							if($comen==1){
								$b = count($array_comentarios);
							}else {
								$b = 3;
							}
							$i = count($array_comentarios);
							if($i == 0) { 
								echo "<p>Este producto aun no tiene comentarios</p>";
							}else{
								if($i < $b){
								$b = $i;
								}
								echo "<p>Comentarios de usuarios:</p>";
								echo "<table>";
									for($a=0; $a<$b; $a++)
									{	
										$comentario= $comentarioDAO->getComentario($array_comentarios[$a]);
										$nombreuser=$comentario->getUser();
										
										$usuario = $UserInfoDAO->getInfoUser($nombreuser);
										
										echo "<tr>";
										
										echo "<td>";
										echo "<p><img class='imagencomentario' src='".$usuario->getImagen()."' /><b> " .$comentario->getUser()."</b></p>";
										
										echo "<p><b>Comentario:</b> ".$comentario->getDescripcion()."</p>";
										echo "</td>";
										
										if(isset($_SESSION["esAdmin"])&& $_SESSION["esAdmin"]){
										echo "<td>";		
										?>
								
										<a href="procesarComentarios.php?lugar=0&accion=eliminar&idComentario=<?php echo $comentario->getIdComentario() ?>&idProd=<?php echo $idproducto ?>"><img src="img/papelera.png" height="30px" width="50px" /></a>
										<?php
										echo "</td>";
										}
										echo "</tr>";
									}
								echo "</table>";
								}
							?> 
					</form>
				
				<form method="post">
					<p>
					<?php if($comen == 1){
						echo '<input type="submit" name="mostrarMC" id="mostrarMC" value="Mostrar menos" formaction="vistaProducto.php?id='.$idproducto.'&categoria='.$apartadoTienda.'&valor='.$valor.'&comen=0">';
					}else {
						if(count($array_valoraciones) > 3){
							echo '<input type="submit" name="mostrarC" id="mostrarC" value="Mostrar más" formaction="vistaProducto.php?id='.$idproducto.'&categoria='.$apartadoTienda.'&valor='.$valor.'&comen=1">';
						}
					}
						?> 
					
					</p>
					</form>
				</fieldset>
				</div>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>