<?php
  class Noticia {

		//Atributos 


		private $id="";
		private $titulo="";
		private $parrafo1="";
		private $parrafo2="";
		private $parrafo3="";
		private $imagen="";
		private $disponibilidad="";
		

		//constructor
		function __construct($id, $titulo, $parrafo1, $parrafo2, $parrafo3, $imagen, $disponibilidad){
			$this->id = $id;
			$this->titulo = $titulo;
			$this->parrafo1 = $parrafo1;
			$this->parrafo2 = $parrafo2;
			$this->parrafo3 = $parrafo3;
			$this->imagen = $imagen;
			$this->disponibilidad = $disponibilidad;
		}

		//getters y setters
		public function getTitulo()
		{
			return $this->titulo;
		}
		public function setTitulo($titulo)
		{
			$this->titulo = $titulo;
		}

		 public function getImagen()
		{
			return $this->imagen;
		}
		public function setImagen($imagen)
		{
			$this->imagen = $imagen;
		}

		 public function getParrafo1()
		{
			return $this->parrafo1;
		}
		public function setParrafo1($parrafo1)
		{
			$this->parrafo1 = $parrafo1;
		}
		
		public function getParrafo2()
		{
			return $this->parrafo2;
		}
		public function setParrafo2($parrafo2)
		{
			$this->parrafo2 = $parrafo2;
		}
		public function getParrafo3()
		{
			return $this->parrafo3;
		}
		public function setParrafo3($parrafo3)
		{
			$this->parrafo3 = $parrafo3;
		}

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function getDisponibilidad()
		{
			return $this->disponibilidad;
		}
		public function setDisponibilidad($disponibilidad)
		{
			$this->disponibilidad = $disponibilidad;
		}
	
    }
