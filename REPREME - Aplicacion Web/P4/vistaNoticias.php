<?php 
	include_once("includes/DAOnoticia.php");
	include_once("includes/lib_carrito.php");
	require_once __DIR__.'/includes/formularioBusquedaNoticia.php';
	require_once __DIR__.'/includes/config.php';
	if (!isset($_SESSION["ocarrito"])){
		$_SESSION["ocarrito"] = new Carrito();
	}
	$noticiaDAO = new NoticiaDAO();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Pestaña de registro</title>
</head>

<body>

<div id="contenedor_n">


	<?php require 'includes/comun/cabecera.php'; ?>
	<div id="cabeceraNoticias"> NOTICIAS </div>
		<div id="lateral">
			<h2 id="buscaNoticia">Busca tu noticia <a href="buscadorNoticias.php" ><img src="img/buscador2n.png" width="25" height="25"></a> </h2>
			
		</div>
		<div id="contenido_noticias">
			

	
	<?php
			
	
				$numNoticias = $noticiaDAO->getNumNoticias();
				for($i=1; $i<=$numNoticias; $i++){
					$noticia = $noticiaDAO->getNoticia($i);
					$imagen = (string)$noticia->getImagen();
					$titulo = $noticia->getTitulo();
					$disponibilidad = $noticia->getDisponibilidad();
					if( isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]==true){
			?>		
						<div id="noticia">
							<div class="imagen_noticia">
								<a title="<?php echo $titulo ?>" href="vistaNoticia.php?id=<?php echo $i?>">
									<img src="<?php echo $imagen ?>" alt="imagen" width="670" /> 
								</a>
							</div>
							<div class="titulo_noticia">
								<a id="nombreP" title="<?php echo $titulo ?>" href="vistaNoticia.php?id=<?php echo $i?>"><?php echo $titulo?></a>
							</div>
							<div>
								<center>
								<input id="botonN" type="submit" name="modificarN" onclick="location='gestionNoticia.php?id=<?php echo $i?>&gestion=<?php echo "modificar"?>'"value="MODIFICAR ">
								<?php
									if($disponibilidad=="activa"){
								?>
										<input id="botonN" type="submit" name="bajaP" onclick="location='gestionNoticia.php?id=<?php echo $i?>&gestion=<?php echo "baja"?>'" value="DAR DE BAJA ">
								<?php
									}else{
								?>
										<input id="botonN" type="submit" name="altaP" onclick="location='gestionNoticia.php?id=<?php echo $i?>&gestion=<?php echo "alta"?>'" value="DAR DE ALTA ">
								<?php
									}
								?>
								</center>
							</div>
							<br></br>
						</div>
			<?php	
					}
					else if ((!isset($_SESSION["esAdmin"]) || $_SESSION["esAdmin"]==false) && $disponibilidad == "activa"){
			?>
						<div id="noticia">
							<div class="imagen_noticia">
								<a title="<?php echo $titulo ?>" href="vistaNoticia.php?id=<?php echo $i?>">
									<img src="<?php echo $imagen ?>" alt="imagen" width="670" /> 
								</a>
							</div>
							<div class="titulo_noticia">
								<a id="nombreP" title="<?php echo $titulo ?>" href="vistaNoticia.php?id=<?php echo $i?>"><?php echo $titulo?></a>
								<br></br>
							</div>
						</div>
			<?php
					}
				}
		

			?>
	</div>
<?php 
 require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>