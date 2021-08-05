<?php
include_once("includes/DAOcomentarios.php");
include_once("includes/DAOproducto.php");
include_once("includes/Usuario.php");
require_once __DIR__.'/includes/config.php';
$accion=$_GET['accion'];
$lugar=$_GET['lugar'];
$idproducto = $_GET['idProd'];
$comentarioDAO = new ComentarioDAO();
$productoDAO = new ProductoDAO();
$p = $productoDAO->getProducto($idproducto);
$cat = $p->getCategoria();
$valor=$_GET['valor'];
$comen=$_GET['comen'];
if($accion=='insertar')
{
	if(isset($_SESSION['login']) && $_SESSION['login'] ==true)
	{
	
	$descr=$_POST['mensaje'];
	$nom=$_SESSION['usuario'];
	
	$idCom = $comentarioDAO->getNumComentarios()+1;
	$comentarioDAO->insert($idCom,$idproducto,$descr,$nom);

		Header("Location: vistaProducto.php?id=".$idproducto."&categoria=".$cat."&valor=".$valor."&comen=".$comen);

	}
}
else if($accion=='eliminar')
{
	$visibilidad='';
	$idComentario=$_GET['idComentario'];
	$comentarioDAO->bajaComentario($idComentario);
	
		if($lugar==0){
			Header("Location: vistaProducto.php?id=".$idproducto."&categoria=".$cat."&valor=".$valor."&comen=".$comen);
		}
		else{
			Header("Location: vistaComentarios.php");
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
				echo "<p><b>Debes estar registrado para poder dejar un comentario<b></p>";
				?>

				<p><input type="button" id="botonN" onclick="location='registro.php'" value = "REGISTRARSE" />
				<input type="button" id="botonN" onclick="location='login.php'" value = "LOGUEARSE" /></p>

				<?php
			}
			
			
		?>
	</div>

<?php require 'includes/comun/pie.php'; ?>
</div> <!-- Fin del contenedor -->

</body>
</html>
