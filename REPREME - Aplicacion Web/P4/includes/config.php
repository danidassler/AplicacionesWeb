<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/lib_carrito.php';


ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

//$host='vm15.db.swarm.test';
$host = 'localhost';
$usuario='repreme';
$contr='repreme';
$bbdd='repreme';

$arrayBD = array('host'=>$host, 'bd'=>$bbdd, 'user'=>$usuario, 'pass'=>$contr);

if (!isset($_SESSION["ocarrito"])){
		$_SESSION["ocarrito"] = new Carrito();
}

$app = Aplicacion::getSingleton();
$app->init($arrayBD);

register_shutdown_function(array($app, 'cierre'));
?>