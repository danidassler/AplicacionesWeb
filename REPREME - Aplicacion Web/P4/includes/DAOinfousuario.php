<?php
//Clase encargada de actualizar la información de infoUser en la BBDD

	include_once("TransferObjects/infousuario.php");
	require_once __DIR__ . '/Aplicacion.php';
	
	class InfoUserDAO {
		private $app;
		private $db;

		public function __construct(){
			$this->app=Aplicacion::getSingleton();
			$this->db = $this->app->conexionBD();
		}

		public function insert($nombre,$apellido,$usuario,$pais,$dir,$cp,$localidad,$provincia,$telefono,$correo,$imagen,$dni){
			$query = "INSERT into infousuario (nombre, apellido, user, pais, direccion, codPostal, localidad, provincia, telefono, email, imagen, dni) values ('" . $nombre . "','" . $apellido . "','" .$usuario. "','" . $pais . "','" . $dir . "','" . $cp . "','" . $localidad . "','" . $provincia . "','" . $telefono . "','" . $correo . "','" . $imagen . "','" . $dni. "')";
			$consulta = mysqli_query($this->db, $query);
		}
		public function update(InfoUser $info){
			$query =sprintf("UPDATE infousuario set nombre='".$info->getNombre()."', apellido='".$info->getApellido()."',user='".$info->getUser(). "',pais='".$info->getPais(). "',direccion='".$info->getDireccion(). "',codPostal='".$info->getCodPostal(). "',localidad='".$info->getLocalidad(). "',provincia='".$info->getProvincia(). "',telefono='".$info->getTelefono(). "',email='".$info->getEmail()."',imagen='".$info->getImagen()."',dni='".$info->getDni()."' WHERE user like '".$info->getUser()."'");
			$consulta = mysqli_query($this->db, $query);
		}
		public function  delete($nombreUser){
			$query("DELETE infousuario where user = '" . $nombreUser . "'");
			$consulta = mysqli_query($this->db, $query);
		}
		
		public function  getInfoUser($user){
			$sql = "SELECT * FROM infousuario WHERE user = '$user'";
			$consulta = mysqli_query($this->db, $sql);
       		$fila = mysqli_fetch_assoc($consulta);
			
			$info = new InfoUser($fila['nombre'], $fila['apellido'], $fila['user'], $fila['pais'], $fila['direccion'], $fila['codPostal'], $fila['localidad'], $fila['provincia'], $fila['telefono'], $fila['email'], $fila['imagen'], $fila['dni']);
			return $info;
		}
	}
?>