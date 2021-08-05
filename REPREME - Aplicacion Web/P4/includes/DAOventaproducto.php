<?php 

include_once("TransferObjects/ventaproducto.php");
require_once __DIR__ . '/Aplicacion.php';

class VentaProductoDAO {

	private $app;
	private $db;

	public function __construct(){
		$this->app=Aplicacion::getSingleton();
		$this->db = $this->app->conexionBD();
	}
	
	public function insert($idventa, $idproducto, $unidades){
		$query = ("INSERT into ventaproducto (idVenta, idProducto, unidades) values (". $idventa. "," . $idproducto . "," . $unidades .")" );
		$consulta = mysqli_query($this->db, $query);
	}
	
	public function update(VentaProducto $vp){
		$query = "UPDATE ventaproducto set idProducto='".$vp->getidProducto()."', unidades='".$vp->getunidades()."' WHERE idVenta like '".$vp->getidVenta()."'";
		$consulta = mysqli_query($this->db, $query);
	}
	public function delete(VentaProducto $vp){
		$query = "DELETE ventaproducto WHERE idVenta = '".$vp->getidVenta()."'";
		$consulta = mysqli_query($this->db, $query);
	}
	public function getVentaProducto($id){
		$query = "SELECT * from ventaproducto WHERE idVenta = '" .$id. "'";
		$consulta = mysqli_query($this->db, $query);
		$fila = mysqli_fetch_assoc($consulta);
		$ventaP = new VentaProducto($fila['IdVenta'], $fila['idProducto'], $fila['unidades']);
		return $ventaP;
	}
}
?>