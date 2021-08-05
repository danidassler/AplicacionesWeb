<?php
class Favorito{
	private $idProd = "";
	private $user = "";
	
	function __construct($idProd, $user){
		$this->idProd = $idProd;
		$this->user = $user;
	}
	
	public function getidProducto(){
		return $this->idProducto;
	}
	public function getUser(){
		return $this->user;
	}
	public function setidProducto($idProducto){
		$this->idProducto = $idProducto;
	}
	public function setUser($user){
		$this->user = $user;
	}
	
}
