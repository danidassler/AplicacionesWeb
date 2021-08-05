<?php 
include("includes/DAOfavoritos.php");
include("includes/DAOproducto.php");
require_once __DIR__.'/includes/config.php';
$idprod=$_GET["id"];
$user = $_SESSION["usuario"];
$productoDAO = new ProductoDAO();
$favoritosDAO = new FavoritosDAO();
$favoritosDAO->delete($idprod, $user);
$producto = $productoDAO->getProducto($idprod);
$categoria = $producto->getCategoria();
if($_GET["lugar"] == 1){ 
	Header("Location: perfilUsuario.php");
}
else if($_GET["lugar"] == 0){
	Header("Location: vistaProducto.php?id=$idprod&categoria=$categoria");
}
?>