<?php
  class InfoUser {

		//Atributos 

		private $nombre="";
		private $apellido="";
		private $user="";
		private $pais="";
		private $direccion="";
		private $codPostal="";
		private $localidad="";
		private $provincia="";
		private $telefono="";
		private $email="";
		private $imagen="";
		private $dni="";

		//constructor
		function __construct($nombre, $apellido, $user, $pais, $direccion, $codPostal, $localidad, $provincia, $telefono, $email, $imagen, $dni){
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->user = $user;
			$this->pais = $pais;
			$this->direccion = $direccion;
			$this->codPostal = $codPostal;
			$this->localidad = $localidad;
			$this->provincia = $provincia;
			$this->telefono = $telefono;
			$this->email = $email;
			$this->imagen = $imagen;
			$this->dni = $dni;
		}

		//getters y setters
		public function getNombre()
		{
			return $this->nombre;
		}
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}

		 public function getApellido()
		{
			return $this->apellido;
		}
		public function setApellido($apellido)
		{
			$this->apellido = $apellido;
		}

		 public function getUser()
		{
			return $this->user;
		}
		public function setUser($user)
		{
			$this->user = $user;
		}

		 public function getPais()
		{
			return $this->pais;
		}
		public function setPais($pais)
		{
			$this->pais = $pais;
		}

		 public function getDireccion()
		{
			return $this->direccion;
		}
		public function setDireccion($direccion)
		{
			$this->direccion = $direccion;
		}

		 public function getCodPostal()
		{
			return $this->codPostal;
		}
		public function setCodPostal($codPostal)
		{
			$this->codPostal = $codPostal;
		}

		 public function getLocalidad()
		{
			return $this->localidad;
		}
		public function setLocalidad($localidad)
		{
			$this->localidad = $localidad;
		}

		 public function getProvincia()
		{
			return $this->provincia;
		}
		public function setProvincia($provincia)
		{
			$this->provincia = $provincia;
		}

		 public function getImagen()
		{
			return $this->imagen;
		}
		public function setImagen($imagen)
		{
			$this->imagen = $imagen;
		}

		public function getTelefono()
		{
			return $this->telefono;
		}
		public function setTelefono($telefono)
		{
			$this->telefono = $telefono;
		}

		public function getEmail()
		{
			return $this->email;
		}

		 public function setEmail($email)
		{
			$this->email = $email;
		}
		
		public function getDni()
		{
			return $this->dni;
		}
		public function setDni($dni)
		{
			$this->dni = $dni;
		}
	
 }


?>