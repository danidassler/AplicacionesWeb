<?php 
	include_once("includes/DAOproducto.php");
	include_once("includes/lib_carrito.php");
	require_once __DIR__.'/includes/config.php';
	if (!isset($_SESSION["ocarrito"])){
		$_SESSION["ocarrito"] = new Carrito();
	}

	$productoDAO = new ProductoDAO();
	$apartadoTienda = $_GET["categoria"];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<meta charset="utf-8">
		<title>Productos</title>

	</head>

	<body>

		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>
			<div class="cabeceraProductos">
				<?php
					if($apartadoTienda == "sneakers"){
						echo "<div id='sneakers'>SNEAKERS</div>";
					}
					else if($apartadoTienda == "ropa"){
						echo "<div id='ropa'>ROPA</div>";
					}
					else if($apartadoTienda == "accesorios"){
						echo "<div id='accesorios'>ACCESORIOS</div>";
					}
					else{
						echo "<div id='todos'>REPREME</div>";
					}
					
				?>
			</div>
				<div id="filtrado">
				<h2 id="buscaProducto">Busca tu producto <a href="buscador.php" ><img src="img/buscador2n.png" width="25" height="25"></a> </h2>
					<form id = "lateral_derecha" action="vistaProductos.php?categoria=<?php echo $apartadoTienda ?>" method="post">
			
						Ordenar por:
						<select name="comboOrden" required>	
							<option value="normal">-</option>
							<option value="ASC">precio ascendente</option>
							<option value="DESC">precio descendente</option>
						</select>
						
					
						
						Filtrar por marca:
						<select name="comboFiltro" required>
							<option value="normal">-</option>
						<?php
						$marcas = array();
						$marcas= $productoDAO->getMarcas($apartadoTienda);
						$numMarcas= count($marcas);
						for($i=0;$i<$numMarcas;$i++){
						?>
						<option value="<?php echo $marcas[$i]?>"><?php echo $marcas[$i]?></option>

						<?php
						}
						?>	
						</select>
						
						
					
						Filtrar por talla:
						<select name="comboTalla" required>
							<option value="normal">-</option>
						<?php
						$tallas = array();
						$tallas= $productoDAO->getTallas($apartadoTienda);
						$numTallas= count($tallas);
						for($i=0;$i<$numTallas;$i++){
						?>
						<option value="<?php echo $tallas[$i]?>"><?php echo $tallas[$i]?></option>

						<?php
						}
						?>	
						</select>
						
						
						<input name="aceptar" type="submit" value="Aceptar">
					</form>
				</div>
			<div id="contenido_vistaProductos">
			
				<table id="tablaprod" style="margin: 0 auto;">
					<tr>
				<?php 
				$productos = array();
				$orden = "normal";
				$marca = "normal";
				$talla = "normal";

				if(isset($_POST["aceptar"])){
					if($_POST["comboOrden"]!="-")$orden =$_POST["comboOrden"];
					if($_POST["comboFiltro"]!="-")$marca =$_POST["comboFiltro"];
					if($_POST["comboTalla"]!="-")$talla =$_POST["comboTalla"];
				}

				$productos = $productoDAO->coger_productos($orden,$marca,$talla);
				$contador=0;
				$numProductos = count($productos);
				if($numProductos==0){
				?>
				<script type="text/javascript">alert("Lo sentimos, no hay ningun producto de las caracteristicas buscadas");</script>
				<?php
				$orden = "normal";
				$marca = "normal";
				$talla = "normal";
				$productos = $productoDAO->coger_productos($orden,$marca,$talla);
				$contador=0;
				$numProductos = count($productos);
				
				}

				for($i = 0; $i <$numProductos; $i++){
					$producto = $productoDAO->getProducto($productos[$i]);
					$foto = (string)$producto->getImagen();
					$foto2 = (string)$producto->getImagen2();
					$nombre = $producto->getNombre();
					$id = $producto->getId();
					$disponibilidad = $producto->getDisponibilidad();
					
					if((isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] == true) && ($producto->getCategoria()==$apartadoTienda || $apartadoTienda == "todos")){


						if($contador==3)
						{
						?>
							</tr>
							<tr>
						<?php
							$contador=0;
							}
							$contador++;
						
						?>		
						<td>
						<div class="productos">
							<p>	
							<a title="<?php echo $nombre ?>" href="vistaProducto.php?id=<?php echo $id?>&categoria=<?php echo $apartadoTienda?>&valor=0&comen=0">
							
							<img class="prod" alt="Imagen" width="300" height="300" onmouseout="this.src='<?php echo $foto ?>'" onmouseover="this.src='<?php echo $foto2 ?>'" src="<?php echo $foto ?>"/> </a>
							</p>
							<a id="nombreP" title="Nombre" href="vistaProducto.php?id=<?php echo $id?>&categoria=<?php echo $apartadoTienda?>&valor=0&comen=0"><?php echo $nombre?></a>
							<p id="precioP"> <?php echo  $producto->getPrecio()."€"?> </p>
							<p><b><?php echo "Talla : ". $producto->getTalla()?> </b></p>
						<?php
							$stock = $producto->getStockDisponible();
							$cc = $_SESSION["ocarrito"]->cantidadEnCarrito($id);
							$max = $stock - $cc;
						?>			
							<p><b> <?php echo "Numero de unidades : ". $max ?></b> </p>
							<input id="botonN" type="submit" name="modificarP" onclick="location='modificarProducto.php?id=<?php echo $id?>&gestion=<?php echo "modificar"?>&categoria=<?php echo $apartadoTienda?>'"value="MODIFICAR ">
						<?php
							if($producto->getDisponibilidad()=="activo"){ 
						?>
							<input id="botonN" type="submit" name="bajaP" onclick="location='modificarProducto.php?id=<?php echo $id?>&gestion=<?php echo "baja"?>&categoria=<?php echo $apartadoTienda?>'" value="DAR DE BAJA ">
						<?php 
							}else{
						?>
							<input id="botonN" type="submit" name="altaP" onclick="location='modificarProducto.php?id=<?php echo $id?>&gestion=<?php echo "alta"?>&categoria=<?php echo $apartadoTienda?>'" value="DAR DE ALTA ">
						<?php
							}
					}
					else if($producto->getDisponibilidad()=="activo" && ($producto->getCategoria()==$apartadoTienda || $apartadoTienda == "todos")){
	
						if($contador==3)
						{
						?>
							</tr>
							<tr>
						<?php
							$contador=0;
						}
						$contador++;
						
						?>		
						<td>
							<p>	
							<a title="<?php echo $nombre ?>" href="vistaProducto.php?id=<?php echo $id?>&categoria=<?php echo $apartadoTienda?>&valor=0&comen=0">
							
							<img class="prod" alt="Imagen" width="300" height="300" onmouseout="this.src='<?php echo $foto ?>'" onmouseover="this.src='<?php echo $foto2 ?>'" src="<?php echo $foto ?>"/></a>
							</p>
							<a id="nombreP" title="Nombre" href="vistaProducto.php?id=<?php echo $id?>&categoria=<?php echo $apartadoTienda?>&valor=0&comen=0"><?php echo $nombre?></a>
							<p id="precioP"> <?php echo  $producto->getPrecio()."€"?> </p>
							<p><b><?php echo "Talla : ". $producto->getTalla()?> </b></p>
							<?php
							$stock = $producto->getStockDisponible();
							$cc = $_SESSION["ocarrito"]->cantidadEnCarrito($id);
							$max = $stock - $cc;
							?>		
							<?php
							if($max == 0){	
							?>
								<p><h3>SOLD OUT</h3></p>
						</td>
						<?php
							}
							else{
						?>
								<input id="botonN" type="submit" name="añadirC" onclick="location='meter_carrito.php?id=<?php echo $id?>&cantidad=1&lugar=0&categoria=<?php echo $apartadoTienda?>'" value="AÑADIR AL CARRITO"> 
						<?php		
							}
						?>
						
						</td>
			<?php
					}
				
				
				}

				
			?>
				</tr>
				</table>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>