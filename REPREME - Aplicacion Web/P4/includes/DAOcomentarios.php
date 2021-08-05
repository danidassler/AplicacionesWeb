<?php

//Clase encargada de actualizar la información del objeto producto en la BBDD

include_once("TransferObjects/comentarios.php");
require_once __DIR__ . '/Aplicacion.php';

	class ComentarioDAO  {

		private $app;
		private $db;

		public function __construct(){
			$this->app=Aplicacion::getSingleton();
			$this->db = $this->app->conexionBD();
		}
		
		public function insert($idCom,$idProd,$descripcion,$usuario){
			$query = "INSERT into comentariosprod (idComentario, user,idProducto,descripcion,visibilidad) values('" . $idCom . "','" . $usuario . "','" . $idProd ."','".$descripcion."','activo')";
			$consulta = mysqli_query($this->db, $query);
		}
		public function updatePass($descripcion,$usuario,$idComen){
			$query="UPDATE comentariosprod set user='".$usuario.", descripcion='".$descripcion."' where idComentario  like '".$idComen."'";
			$consulta = mysqli_query($this->db, $query);

		}
		public function bajaComentario($idComentario){
			$query="UPDATE comentariosprod set visibilidad='inactivo' where idComentario  like '".$idComentario."'";
			
			$consulta = mysqli_query($this->db, $query);
			
		}
		public function getComentario($idComentario){
			$sql = "SELECT * FROM comentariosprod WHERE idComentario like '".$idComentario."'";
			$consulta = mysqli_query($this->db, $sql);
       		$fila = mysqli_fetch_assoc($consulta);
			$c = new Comentario($fila['idProducto'], $fila['idComentario'],$fila['descripcion'],$fila['user']);
			return $c;
		}

		function coger_comentarios ($idprod){
			
			if($idprod>0)
			{
			$sql = "SELECT * FROM comentariosprod WHERE idProducto like '".$idprod."' and visibilidad LIKE 'activo' ORDER BY idComentario DESC";
			}
			else
			{
				$sql = "SELECT * FROM comentariosprod WHERE visibilidad like 'activo' ORDER BY idComentario DESC";
			}

		
			$array_id= array();
			

			$consulta = mysqli_query($this->db, $sql);
			$i=0;
			while ($fila = mysqli_fetch_assoc($consulta)) {
				$array_id[$i]= $fila['idComentario'];
				$i++;
			}
			return $array_id;
		}
	
		function getNumComentarios(){
			$sql = "SELECT * FROM comentariosprod";
			$consulta = mysqli_query($this->db,$sql);
			$numComentarios = mysqli_num_rows($consulta);
			return $numComentarios;
		}
		
	}
?>