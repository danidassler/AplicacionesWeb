<?php
  class Producto {

		//Atributos 

		private $nombre="";
		private $precio="";
		private $descripcion="";
		private $stockDisponible="";
		private $talla="";
		private $color="";
		private $categoria="";
		private $subcategoria="";
		private $imagen="";
		private $imagen2="";
		private $marca="";
		private $disponibilidad="";
		private $id="";

		//constructor
		function __construct($nombre, $precio, $descripcion, $stockDisponible, $talla, $color, $categoria, $subcategoria, $imagen,$imagen2, $marca,$disponibilidad, $id ){
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->descripcion = $descripcion;
			$this->stockDisponible = $stockDisponible;
			$this->talla = $talla;
			$this->color = $color;
			$this->categoria = $categoria;
			$this->subcategoria = $subcategoria;
			$this->imagen = $imagen;
			$this->imagen2 = $imagen2;
			$this->marca = $marca;
			$this->disponibilidad = $disponibilidad;
			$this->id = $id;
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

		 public function getPrecio()
		{
			return $this->precio;
		}
		public function setPrecio($precio)
		{
			$this->precio = $precio;
		}

		 public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion = $descripcion;
		}

		 public function getStockDisponible()
		{
			return $this->stockDisponible;
		}
		public function setStockDisponible($stockDisponible)
		{
			$this->stockDisponible = $stockDisponible;
		}

		 public function getTalla()
		{
			return $this->talla;
		}
		public function setTalla($talla)
		{
			$this->talla = $talla;
		}

		 public function getColor()
		{
			return $this->color;
		}
		public function setColor($color)
		{
			$this->color = $color;
		}

		 public function getCategoria()
		{
			return $this->categoria;
		}
		public function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}

		 public function getSubcategoria()
		{
			return $this->subcategoria;
		}
		public function setSubcategoria($subcategoria)
		{
			$this->subcategoria = $subcategoria;
		}

		 public function getImagen()
		{
			return $this->imagen;
		}
		public function setImagen($imagen)
		{
			$this->imagen = $imagen;
		}

		public function getImagen2()
		{
			return $this->imagen2;
		}
		public function setImagen2($imagen2)
		{
			$this->imagen2 = $imagen2;
		}

		public function getMarca()
		{
			return $this->marca;
		}
		public function setMarca($marca)
		{
			$this->marca = $marca;
		}
		public function getDisponibilidad()
		{
			return $this->disponibilidad;
		}
		public function setDisponibilidad($disponibilidad)
		{
			$this->disponibilidad = $disponibilidad;
		}


		public function getId()
		{
			return $this->id;
		}

		 public function setId($id)
		{
			$this->id = $id;
		}
	
    }
?>