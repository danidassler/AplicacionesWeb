<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type"  charset=utf-8">
<title>Registro</title>
</head>

<body>

<div id="contenedor">

	<?php session_start(); ?>

	<?php require 'cabecera.php'; ?>

    <?php require 'sidebarIzq.php'; ?>

	<div id="contenido">
	<h1>Registro de nuevo usuario. </h1>
		<form action="index.php" method="post">
			<fieldset>
				<legend>Datos del usuario</legend>
					<p><label>Correo:</label> <input type="text" name="correo" id="campoCorreo"/>
					<img id="iconoM" src= "iconos/no.png"/>
					<img id="iconoB" src= "iconos/ok.png"/></p>
					<p><label>User:</label><input type="text" name="user" id="campoUser"/>
					<img id="iconoMU" src= "iconos/no.png"/>
					<img id="iconoBU" src= "iconos/ok.png"/></p>
					<p><label>Password:</label> <input type="text" name="contraseña"/></p>
					<input type="submit" name="entrar" value="Entrar"/>	
			</fieldset>
		</form>
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
				$("#campoUser").change(function(){
					var url="comprobarUsuario.php?user=" + $("#campoUser").val();
					$.get(url, usuarioExiste);
				});
			});
		</script>
	</div>

	<?php require 'sidebarDer.php'; ?>

    <?php require 'pie.php'; ?>

</div>

</body>
</html>