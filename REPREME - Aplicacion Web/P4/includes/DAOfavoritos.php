<?php 

include_once("TransferObjects/favorito.php");
require_once __DIR__ . '/Aplicacion.php';

class FavoritosDAO {

	private $app;
	private $db;

	public function __construct(){
		$this->app=Aplicacion::getSingleton();
		$this->db = $this->app->conexionBD();
	}

	public function insert($user,$idProducto){
		$query = ("INSERT into favoritos (user,idProducto) values ('". $user . "','". $idProducto ."')");
		$consulta = mysqli_query($this->db, $query);
	}
	
	public function delete($idprod, $user){
		$query = "DELETE from favoritos WHERE user = '".$user."' AND idProducto = '".$idprod."'";
		$consulta = mysqli_query($this->db, $query);
	}
	
	public function compruebaFavorito($idprod, $user){
		$query = "SELECT * from favoritos WHERE idProducto = '" .$idprod. "' AND user = '".$user."'";
		$consulta = mysqli_query($this->db, $query);
		if(mysqli_num_rows($consulta)==1){
			return true;
		}else{
			return false;
		}
	}
	
	function getProductosFavoritosPorUsuario ($user){
		
		$query = "SELECT * FROM favoritos WHERE user like '".$user."'";

		$array_id= array();

		$consulta = mysqli_query($this->db, $query);
		$i=0;
		while ($fila = mysqli_fetch_assoc($consulta)) {
			$array_id[$i]= $fila['idProducto'];
			$i++;
		}
		return $array_id;
	}
	
	public function getNumFavoritos(){
		$sql = "SELECT * FROM favoritos";
		$consulta = mysqli_query($this->db, $sql);
		$numVentas = mysqli_num_rows($consulta);
		return $numFavoritos;
	}
}
?>