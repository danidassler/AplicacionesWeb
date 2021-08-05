<?php 

include_once("TransferObjects/venta.php");
require_once __DIR__ . '/Aplicacion.php';

class VentaDAO {

	private $app;
	private $db;

	public function __construct(){
		$this->app=Aplicacion::getSingleton();
		$this->db = $this->app->conexionBD();
	}

	public function insert($idventa, $fecha, $precio, $usuario){
		$query = ("INSERT into venta (IdVenta, fecha, precioTotal, user) values ('". $idventa . "','". $fecha . "','" . $precio . "','" . $usuario . "')" );
		$consulta = mysqli_query($this->db, $query);
	}
	
	public function update(Venta $v){
		$query = "UPDATE venta set user='".$v->getUser()."', fecha='".$v->getFecha()."',precioTotal='".$v->getPrecio()."' WHERE idVenta like '".$v->getidVenta()."'";
		$consulta = mysqli_query($this->db, $query);
	}
	public function delete(Venta $v){
		$query = "DELETE venta WHERE idVenta = '".$v->getidVenta()."'";
		$consulta = mysqli_query($this->db, $query);
	}
	public function getVenta($idventa){
		$query = "SELECT * from venta WHERE idVenta = '" .$idventa. "'";
		$consulta = mysqli_query($this->db, $query);
		$fila = mysqli_fetch_assoc($consulta);
		$venta = new Venta($fila['IdVenta'], $fila['fecha'], $fila['precioTotal'], $fila['user']);
		return $venta;
	}
	
	function getVentasPorUsuario ($user){
		
		$query = "SELECT * FROM venta WHERE user like '".$user."' ORDER BY idVenta DESC";

		$array_id= array();

		$consulta = mysqli_query($this->db, $query);
		$i=0;
		while ($fila = mysqli_fetch_assoc($consulta)) {
			$array_id[$i]= $fila['IdVenta'];
			$i++;
		}
		return $array_id;
	}
	
	public function getNumVentas(){
		$sql = "SELECT * FROM venta";
		$consulta = mysqli_query($this->db, $sql);
		$numVentas = mysqli_num_rows($consulta);
		return $numVentas;
	}
}
?>