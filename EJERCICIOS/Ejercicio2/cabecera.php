<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Portada</title>
</head>

<body>

<div id="cabecera">

	<!--<?php 
   ·# echo '<div id="cabecera">
	#	<h1>Mi gran página web</h1>
	#	<div class="saludo">Usuario desconocido. <a href=\'login.php\'>Login</a></div>
	#	</div>';
   ?>-->
   <h1>Mi gran página web</h1>

   <div class="saludo">
		<?php 
			if(!isset($_SESSION["login"]) || $_SESSION["login"] == false){
				?>
				Usuario desconocido. <a href='login.php'>Login</a>
				<?php
			}
			else if ($_SESSION["login"]== true){
				$nombre_user = $_SESSION["nombre"];
				echo "Bienvenido " . $nombre_user . "." ;
				?>
				<a href='logout.php'>Logout</a>
				<?php
			}
		?>
   </div>
</div> <!-- Fin del contenedor -->

</body>
</html>

