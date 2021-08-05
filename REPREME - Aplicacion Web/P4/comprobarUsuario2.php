<?php 
	require_once __DIR__.'/includes/Usuario.php';
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/Aplicacion.php';
	$usuario = htmlspecialchars(trim(strip_tags($_REQUEST["user"])));
	$u = Usuario::buscaUsuario($usuario);

	if($u){
		print("existe");
	}
	else{
		print("no");
	}
