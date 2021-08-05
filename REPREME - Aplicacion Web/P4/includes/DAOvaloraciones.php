<?php

//Clase encargada de actualizar la información del objeto producto en la BBDD

include_once("TransferObjects/valoraciones.php");
require_once __DIR__ . '/Aplicacion.php';

	class ValoracionDAO  {

		private $app;
		private $db;
		private $visibilidad;

		public function __construct(){
			$this->app=Aplicacion::getSingleton();
			$this->db = $this->app->conexionBD();
		}
		
		public function insert($idVal,$idProd,$puntuacion,$usuario){
			$query = "INSERT into valoracion (idValoracion, user,idProducto,puntuacion,visibilidad) values('" . $idVal . "','" . $usuario . "','" . $idProd ."','".$puntuacion."','activo')";
			$consulta = mysqli_query($this->db, $query);
		}
		public function updatePass($puntuacion,$usuario,$idVal){
			$query="UPDATE valoracion set user='".$usuario.", puntuacion='".$puntuacion."' where idValoracion  like '".$idVal."'";
			$consulta = mysqli_query($this->db, $query);

		}
		public function bajaValoracion($idValoracion){
			$query="UPDATE valoracion set visibilidad='inactivo' where idValoracion  like '".$idValoracion."'";
			
			$consulta = mysqli_query($this->db, $query);
			
		}
		public function getValoracion($idVal){
			$sql = "SELECT * FROM valoracion WHERE idValoracion like '".$idVal."'";
			$consulta = mysqli_query($this->db, $sql);
       		$fila = mysqli_fetch_assoc($consulta);
			$v = new Valoracion($fila['idProducto'], $fila['idValoracion'],$fila['puntuacion'],$fila['user']);
			return $v;
		}

		function coger_valoraciones ($idprod){
			$array_id= array();
			if($idprod>0){
			$sql = "SELECT * FROM valoracion WHERE idProducto like '".$idprod."' and visibilidad LIKE 'activo' ORDER BY idValoracion DESC";
			}else{
			$sql = "SELECT * FROM valoracion where visibilidad like 'activo' ORDER BY idValoracion DESC";
			}

			$consulta = mysqli_query($this->db, $sql);
			$i=0;
			while ($fila = mysqli_fetch_assoc($consulta)) {
				$array_id[$i]= $fila['idValoracion'];
				$i++;
			}
			return $array_id;
		}
		
		function getNumValoraciones(){
			$sql = "SELECT * FROM valoracion";
			$consulta = mysqli_query($this->db,$sql);
			$numValoraciones = mysqli_num_rows($consulta);
			return $numValoraciones;
		}
		
	}
?>