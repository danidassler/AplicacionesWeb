<?php
class Venta{
	private $idVenta = "";
	private $fecha = "";
	private $precioTotal ="";
	private $user ="";
	
	function __construct($idVenta, $fecha, $precioTotal, $user){
		$this->idVenta = $idVenta;
		$this->fecha = $fecha;
		$this->precioTotal = $precioTotal;
		$this->user = $user;
	}
	
	public function getidVenta(){
		return $this->idVenta;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getPrecio(){
		return $this->precioTotal;
	}
	public function getUser(){
		return $this->user;
	}
	public function setidVenta($idVenta){
		$this->idVenta = $idVenta;
	}
	public function setFecha($fecha){
		$this->fecha = $fecha;
	}
	public function setPrecio($precio){
		$this->precioTotal = $precio;
	}
	public function setUser($user){
		$this->user = $user;
	}
	
}


?>