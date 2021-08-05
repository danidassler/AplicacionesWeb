<?php
//Clase encargada de actualizar la información del objeto producto en la BBDD
	include_once("TransferObjects/noticia.php");
	require_once __DIR__ . '/Aplicacion.php';

	class NoticiaDAO{

		private $app;
		private $db;

		public function __construct(){
			$this->app=Aplicacion::getSingleton();
			$this->db = $this->app->conexionBD();
		}
		
		public function insert(Noticia $n){
			// No insertamos el id, se supone que lo genera automáticamente la BBDD
			$query = "INSERT into noticias (titulo, parrafo1, parrafo2, parrafo3, imagen, disponibilidad) values ('".$n->getTitulo()."','".$n->getParrafo1()."','".$n->getParrafo2()."','".$n->getParrafo3()."','". $n->getImagen(). "','". $n->getDisponibilidad()."')";
			$consulta = mysqli_query($this->db, $query);
		}
		
		public function update(Noticia $n){
			$query=$query = "UPDATE noticias set titulo='".$n->getTitulo()."',parrafo1='".$n->getParrafo1()."',parrafo2='".$n->getParrafo2()."',parrafo3='".$n->getParrafo3()."',imagen='".$n->getImagen()."',disponibilidad='".$n->getDisponibilidad()."' WHERE idNoticia like '".$n->getId()."'";
			$consulta = mysqli_query($this->db, $query);
		}
		public function  delete(Noticia $n){
			$query=("DELETE noticias where idNoticia = '" . $n->getId() . "'");
			$consulta = mysqli_query($this->db, $query);
		}
		
		public function  getNoticia($id){
			$sql = "SELECT * FROM noticias WHERE idNoticia = '$id'";
			$consulta = $this->db->query($sql);
       		$fila = mysqli_fetch_assoc($consulta);
			@$n = new Noticia($fila['idNoticia'], $fila['titulo'], $fila['parrafo1'],$fila['parrafo2'],$fila['parrafo3'], $fila['imagen'], $fila['disponibilidad']);
			return $n;
		}
		public function getNumNoticias(){
		
			$sql = "SELECT * FROM noticias";
			$consulta = mysqli_query($this->db,$sql);
			$numNoticias = mysqli_num_rows($consulta);
			return $numNoticias;

		}
		public function searchNoticia($string){
			$result = array();
			$contador = 0;

			if($string=='*'){

			$sql = "SELECT * FROM noticias";

			}else{

			$sql = "SELECT * FROM noticias WHERE titulo like '%".$string."%' OR parrafo1 like '%".$string."%' OR parrafo2 like '%".$string."%' OR parrafo3 like '%".$string."%'";
			}

			$consulta = mysqli_query($this->db,$sql);

			while($row=mysqli_fetch_assoc($consulta)){
				$result[$contador]=$this->getNoticia($row['idNoticia']);
				$contador++;
			}

			return $result;
		}
		public function comprobarNoticia($titulo, $imagen)
		{
			$sql = "SELECT * FROM noticias WHERE titulo like '".$titulo."'AND imagen like'".$imagen."'";
			$consulta = mysqli_query($this->db,$sql);
			if(mysqli_num_rows($consulta)==0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function searchNoticiaBuscador($string){
			$result = array();
			$contador = 0;

			if($string=='*'){

			$sql = "SELECT * FROM noticias  order by idNoticia desc";

			}else{

			
			$sql = "SELECT * FROM noticias WHERE titulo like '".$string."'OR idNoticia like'%".$string."%' OR disponibilidad like'".$string."'";
			}

			$consulta = mysqli_query($this->db,$sql);

			while($row=mysqli_fetch_assoc($consulta)){
				$result[$contador]=$this->getNoticia($row['idNoticia']);
				$contador++;
			}

			return $result;
		}
	}
