<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioRegistro.php';

$formulario = new FormularioRegistro();
$html = $formulario->gestiona();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Pestaña de registro</title>
</head>

<body>

<div class="contenedor">

	<?php require 'includes/comun/cabecera.php'; ?>

	<div id="contenido_formulario">
		
		  <div id="item1"></div>
		  <div id="item2">
			<?php
			echo $html;?>
				<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
				<script>
					function correoValido(valor){
						var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
						// la expresion anterior la encontre en internet y es algo mas compleja que simplemente 
						// comprobar si existe un @ y un punto a su derecha, ya que de esta manera el correo
						// "@." era aceptado, con la expresion usada esto no pasa.
						if (expr.test(valor)){
							return true;
						} 
						else{
							return false;
						}
					}
					$(document).ready(function(){
						$("#iconoM").hide();
						$("#iconoB").hide();
						$("#campoCorreo").change(function(){
							if( correoValido($("#campoCorreo").val())){
								$("#iconoM").hide();
								$("#iconoB").show();
								//alert("Correo valido");
							}
							else{
								$("#iconoB").hide();
								$("#iconoM").show();
								//alert("correo no valido");
							}
						});
					}); 
				</script>
				<script>
					function usuarioExiste(data, status){
						if(status=="error"){
							alert("Error al conectar con el servidor");
						}
						if(data=="existe"){
							$("#iconoBU").hide();
							$("#iconoMU").show();
							alert("El nombre de usuario ya esta reservado");
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
							var url="comprobarUsuario.php?user=" + $("#campoUser").val();
							$.get(url, usuarioExiste);
						});
					});
				</script>
		  </div>
		  <div id="item3"></div>
	 
	
	</div>
<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>