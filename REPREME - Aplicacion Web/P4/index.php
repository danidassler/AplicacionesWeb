<?php require_once __DIR__.'/includes/config.php';
 require_once __DIR__.'/includes/Aplicacion.php';?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>REPREME</title>
	</head>

	<body>
		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>

			<div id="contenidoIndex1">
				<!--<p><input type="submit" id="botonNI" name="tienda" onclick="location='vistaProductos.php?categoria=todos'" value="TIENDA"></p>-->
				<p> <a  id= "nombreP" href="vistaProductos.php?categoria=todos"> <b>TIENDA</b> </a> </p>
			</div>
			<div id="contenidoIndex2">
				<!--<p><input type="submit" id="botonNI" name="noticias" onclick="location='vistaNoticias.php'" value="NOTICIAS"></p>-->
				<p> <a  id= "nombreP" href="vistaNoticias.php"> <b>NOTICIAS</b> </a> </p>
			</div>
			<div id="contenidoIndex3">
				<?php if(!isset($_SESSION["login"]) || $_SESSION["login"] == false){ 
				?>
						<p> <a  id= "nombreP" href="login.php"> <b>Login</b> </a></p>
						<p> Aun no tienes una cuenta? - <a  id= "nombreP" href="registro.php"> <b>Registrate</b> </a> </p>
				<?php } else { 
						$nombre_user = $_SESSION["usuario"];
						echo "<p> Bienvenido de nuevo, ".$nombre_user."</p> "; 
						echo '<p> <a id= "nombreP" href="logout.php"> <b>Logout</b> </a></p>';
					}
				?>
			</div>
			<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>