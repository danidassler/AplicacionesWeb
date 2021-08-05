
<?php
	session_start();
	$usuario = htmlspecialchars(trim(strip_tags($_REQUEST["nom"])));
    $contraseña = htmlspecialchars(trim(strip_tags($_REQUEST["con"])));

	if( $usuario == "user" && $contraseña == "userpass"){
		$_SESSION["login"] = true;
		$_SESSION["nombre"] = "Usuario";
	}
	else if ($usuario == "admin" && $contraseña == "adminpass"){
		$_SESSION["login"] = true;
		$_SESSION["nombre"] = "Administrador";
		$_SESSION["esAdmin"] = true;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Portada</title>
</head>

<body>

<div id="contenedor">

	<?php require 'cabecera.php'; ?>

    <?php require 'sidebarIzq.php'; ?>

	<div id="contenido">
		<?php 
			if(!isset($_SESSION["login"])){
				?>
				Usuario desconocido. Registrate aqui -->  <a href='login.php'>Login</a>
				<?php
			}
			else{
				$nombre_user = $_SESSION["nombre"];
				echo "Bienvenido a la pagina, " . $nombre_user . "." ;
			}
		?>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div> <!-- Fin del contenedor -->

</body>
</html>