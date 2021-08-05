<?php
class VentaProducto{
	private $idVenta = "";
	private $idProducto ="";
	private $unidades ="";
	
	
	function __construct($idVenta, $idProducto, $unidades){
		$this->idVenta = $idVenta;
		$this->idProducto = $idProducto;
		$this->unidades = $unidades;
	}
	
	public function getidVenta(){
		return $this->idVenta;
	}
	public function getidProducto(){
		return $this->idProducto;
	}
	public function getunidades(){
		return $this->unidades;
	}
	public function setidVenta($idVenta){
		$this->idVenta = $idVenta;
	}
	public function setidProducto($idProducto){
		$this->idProducto = $idProducto;
	}
	public function setunidades($unidades){
		$this->unidades = $unidades;
	}
}

 ?>