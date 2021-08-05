<?php 
include("includes/lib_carrito.php");
require_once __DIR__.'/includes/config.php';
$_SESSION["ocarrito"]->elimina_producto($_GET["linea"]);
Header("Location: carrito.php");
?>



