<?php 
include_once("includes/lib_carrito.php");
require_once __DIR__.'/includes/config.php';
$idproducto = $_GET["id"];
$apartadoTienda = $_GET["categoria"];
$_SESSION["ocarrito"]->introduce_producto($idproducto, $_REQUEST["cantidad"]);
if( $_REQUEST["lugar"] == 1 ){
	Header("Location: vistaProducto.php?id=$idproducto&categoria=$apartadoTienda");
}
else if ( $_REQUEST["lugar"] == 0 ){
	Header("Location: vistaProductos.php?categoria=$apartadoTienda");
}
?>


