<?php 
	include_once("includes/DAOnoticia.php");
	include_once("includes/TransferObjects/noticia.php");
	include_once("includes/lib_carrito.php");
	require_once __DIR__.'/includes/config.php';
	if (!isset($_SESSION["ocarrito"])){
		$_SESSION["ocarrito"] = new Carrito();
	}
	$idnoticia = $_GET['id'];
	$noticiaDAO = new NoticiaDAO();
	$n = $noticiaDAO->getNoticia($idnoticia);
	$disponibilidad=$n->getDisponibilidad();
	$imagen = (string)$n->getImagen();
	$titulo = $n->getTitulo();
	$desc1 = $n->getParrafo1();
	$desc2 = $n->getParrafo2();
	$desc3 = $n->getParrafo3();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Pestaña de registro</title>
</head>

<body>

<div id="contenedor">

	<?php require 'includes/comun/cabecera.php'; ?>

	<div id="contenido_noticias">

		<div id="noticia">
			<div class="imagen_noticia2" >
				<img src="<?php echo $imagen ?>" alt="imagen" width="500" /> 
			</div>
			<div class="titulo_noticia">
				<h2><?php echo $titulo ?></h2>
				
			</div>
			<?php
				if( isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]==true){
		?>		
						<div>
							<center>
							<input id="botonN" type="submit" name="modificarN" onclick="location='gestionNoticia.php?id=<?php echo $idnoticia?>&gestion=<?php echo "modificar"?>'"value="MODIFICAR ">
							<?php
								if($disponibilidad=="activa"){
							?>
									<input id="botonN" type="submit" name="bajaP" onclick="location='gestionNoticia.php?id=<?php echo  $idnoticia?>&gestion=<?php echo "baja"?>'" value="DAR DE BAJA ">
							<?php
								}else{
							?>
									<input id="botonN" type="submit" name="altaP" onclick="location='gestionNoticia.php?id=<?php echo  $idnoticia?>&gestion=<?php echo "alta"?>'" value="DAR DE ALTA ">
							<?php
								}
							?>
							</center>
						</div>
						<br></br>
					</div>
		<?php	
				}
				?>
			<div class="descripcion_noticia">
				<p><?php echo $desc1 ?></p>
				<p><?php echo $desc2 ?></p>
				<p><?php echo $desc3 ?></p>
			</div>

		</div>

	</div>
<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>