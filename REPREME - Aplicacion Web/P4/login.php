<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioLogin.php';

$formulario = new FormularioLogin();
$html = $formulario->gestiona();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
		<title>Pestaña de login</title>
	</head>

	<body>
		<div class="contenedor">

			<?php require 'includes/comun/cabecera.php'; ?>

			<div id="contenido_formulario">
		
		  <div id="login_item1"></div>
		  <div id="login_item2"><?php
				echo $html;
				?>
				<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
				<script>
					function usuarioExiste(data, status){
						if(status=="error"){
							alert("Error al conectar con el servidor");
						}
						if(data=="no"){
							$("#iconoBU").hide();
							$("#iconoMU").show();
							alert("El usuario especificado no esta registrado");
						}
						else{
							$("#iconoMU").hide();
							$("#iconoBU").show();
						}	
					}
					$(document).ready(function(){
						$("#iconoBU").hide();
						$("#iconoMU").hide();
						$("#campoUser").change(function(){
							var url="comprobarUsuario2.php?user=" + $("#campoUser").val();
							$.get(url, usuarioExiste);
						});
					});
				</script>
			</div>
		  <div id="login_item3"></div>
	 
	
	</div>
	<?php require 'includes/comun/pie.php'; ?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>