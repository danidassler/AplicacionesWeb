<?php 
include("includes/DAOfavoritos.php");
include("includes/DAOproducto.php");
require_once __DIR__.'/includes/config.php';
$idprod=$_GET["id"];
$user = $_SESSION["usuario"];
$productoDAO = new ProductoDAO();
$favoritosDAO = new FavoritosDAO();
$favoritosDAO->insert($user, $idprod);
$producto = $productoDAO->getProducto($idprod);
$categoria = $producto->getCategoria();

	Header("Location: vistaProducto.php?id=$idprod&categoria=$categoria");

?>