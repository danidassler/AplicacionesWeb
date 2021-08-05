<?php

require_once __DIR__.'/aplicacion.php';


ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

$bdhost='localhost';
$bdname='ejercicio3';
$bduser='ejercicio3';
$bdpassword='ejercicio3';
$arrayBD = array('host'=>$bdhost, 'bd'=>$bdname, 'user'=>$bduser, 'pass'=>$bdpassword);

$app = es\fdi\ucm\aw\Aplicacion::getSingleton();
$app->init($arrayBD);

register_shutdown_function(array($app, 'cierre'));
?>