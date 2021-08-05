<?php
include_once("includes/DAOvaloraciones.php");
include_once("includes/Usuario.php");
require_once __DIR__.'/includes/config.php';
$accion=$_GET['accion'];
$idproducto = $_GET['idProd'];
$lugar=$_GET['lugar'];
$valoracionDAO = new ValoracionDAO();
$valor = $_GET['valor'];
$comen = $_GET['comen'];

if($accion=='insertar')
{
	if(isset($_SESSION['login']) && $_SESSION['login'] ==true)
	{
	
	$punt=$_POST['val'];
	$nom=$_SESSION['usuario'];
	
	$idVal = $valoracionDAO->getNumValoraciones()+1;
	$valoracionDAO->insert($idVal,$idproducto,$punt,$nom);
	Header("Location: vistaProducto.php?id=".$idproducto."&categoria=todos&valor=".$valor."&comen=".$comen);
	}
}
else if($accion=='eliminar')
{
	$idValoracion=$_GET['idValoracion'];
	$valoracionDAO->bajaValoracion($idValoracion);
	
	if($lugar==0){
		Header("Location: vistaProducto.php?id=".$idproducto."&categoria=".$cat."&valor=".$valor."&comen=".$comen);
	}
	else{
		Header("Location: vistaValoraciones.php");
	}
  
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Portada</title>
</head>

<body>

<div class="contenedor">

	<?php require 'includes/comun/cabecera.php'; ?>

	
	<div id="contenidoPC">
		<?php 
			if(!isset($_SESSION['login']) || $_SESSION['login'] ==false){ 
				
				#HACER ALGO SI NO EXISTE EL USUARIO QUE QUEDE BIEN EN LA PAGINA
				echo "<p><b>Debes estar registrado para poder dejar una valoracion<b></p>";
				?>

				<p><input type="button" id="botonN" onclick="location='registro.php'" value = "REGISTRARSE" />
				<input type="button" id="botonN" onclick="location='login.php'" value = "LOGUEARSE" /></p>

				<?php
			}
			
			
		?>
	</div>


	
</div> <!-- Fin del contenedor -->

</body>
</html>
