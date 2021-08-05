<?php
//Clase encargada de actualizar la información del objeto producto en la BBDD
	include_once("TransferObjects/producto.php");
	require_once __DIR__ . '/Aplicacion.php';

	class ProductoDAO{

		private $app;
		private $db;

		public function __construct(){
			$this->app=Aplicacion::getSingleton();
			$this->db = $this->app->conexionBD();
		}
		
	public function insert(Producto $p){
			// No insertamos el id, se supone que lo genera automáticamente la BBDD
			$query = "INSERT into productos (nombre, precio, descripcion, stockDisponible, talla, color, categoria, subcategoria, imagen, imagen2, marca, disponibilidad) values ('".$p->getNombre()."','".$p->getPrecio()."','".$p->getDescripcion()."','".$p->getStockDisponible()."','".$p->getTalla()."','".$p->getColor()."','" .$p->getCategoria()."','".$p->getSubcategoria()."','". $p->getImagen()."','".$p->getImagen2()."','".$p->getMarca()."','".$p->getDisponibilidad()."')";

			$consulta = mysqli_query($this->db, $query);
		}
		
		public function update(Producto $p){
			$query=$query = "UPDATE productos set nombre='".$p->getNombre()."', precio='".$p->getPrecio()."',descripcion='".$p->getDescripcion(). "',stockDisponible='".$p->getStockDisponible(). "',talla='".$p->getTalla(). "',color='".$p->getColor(). "',categoria='".$p->getCategoria(). "',subcategoria='".$p->getSubcategoria(). "',imagen='".$p->getImagen()."',imagen2='".$p->getImagen2(). "',marca='".$p->getMarca()."',disponibilidad='".$p->getDisponibilidad()."' WHERE idProducto like '".$p->getId()."'";
			$consulta = mysqli_query($this->db, $query);
		}
		public function  delete(Porducto $p){
			$query=("DELETE productos where idProucto = '" . $p->getId() . "'");
			$consulta = mysqli_query($this->db, $query);
		}
		
		public function  getProducto($id){
			$sql = "SELECT * FROM productos WHERE idProducto = '$id'";
			$consulta = $this->db->query($sql);
       		$fila = mysqli_fetch_assoc($consulta);
			
			@$p = new Producto($fila['nombre'], $fila['precio'], $fila['descripcion'], $fila['stockDisponible'], $fila['talla'], $fila['color'], $fila['categoria'], $fila['subcategoria'], $fila['imagen'], $fila['imagen2'],$fila['marca'], $fila['disponibilidad'],$fila['idProducto']);
			return $p;
		}
		public function getNumProductos(){
		
			$sql = "SELECT * FROM productos";
			$consulta = mysqli_query($this->db,$sql);
			$numProductos = mysqli_num_rows($consulta);
			return $numProductos;

		}
		public function searchProduct($string){
			$result = array();
			$contador = 0;

			if($string=='*'){

			$sql = "SELECT * FROM productos";

			}else{

			$sql = "SELECT * FROM productos WHERE nombre like '%".$string."%' OR marca like '%".$string."%' OR categoria like '%".$string."%' OR subcategoria like'%".$string."%'OR color like '%".$string."%'";
			}

			$consulta = mysqli_query($this->db,$sql);

			while($row=mysqli_fetch_assoc($consulta)){
				$result[$contador]=$this->getProducto($row['idProducto']);
				$contador++;
			}

			return $result;
		}
		public function comprobarProducto($nombre, $talla){
			$sql = "SELECT * FROM productos WHERE nombre like '".$nombre."'AND talla like'".$talla."'";
			$consulta = mysqli_query($this->db,$sql);
			if(mysqli_num_rows($consulta)==0){
				return true;
			}else{
				return false;
			}
		}
		public function coger_productos($orden, $marca, $talla){
			if($orden == "normal"){
				if($marca=="normal"&&$talla=="normal"){
					$sql = "SELECT * FROM productos";
				}else if($marca=="normal"&&$talla!="normal"){
					$sql = "SELECT * FROM productos WHERE talla like '".$talla."'";
				}else if($marca!="normal"&&$talla=="normal"){
					$sql = "SELECT * FROM productos WHERE marca like '".$marca."'";
				}else{
					$sql = "SELECT * FROM productos WHERE marca like '".$marca."' AND talla like '".$talla."'";
				}
				
			}else{
				if($marca=="normal"&&$talla=="normal"){
					$sql = "SELECT * FROM productos ORDER BY precio ".$orden;
				}else if($marca=="normal"&&$talla!="normal"){
					$sql = "SELECT * FROM productos WHERE talla like '".$talla."'ORDER BY precio ".$orden;
				}else if($marca!="normal"&&$talla=="normal"){
					$sql = "SELECT * FROM productos WHERE marca like '".$marca."'ORDER BY precio ".$orden;
				}else{
					$sql = "SELECT * FROM productos WHERE marca like '".$marca."' AND talla like '".$talla."'ORDER BY precio ".$orden;
				}

			}

			
			$array_id= array();
			
			$consulta = mysqli_query($this->db, $sql);
			$i=0;
			while ($fila = mysqli_fetch_assoc($consulta)) {
				$array_id[$i]= $fila['idProducto'];
				$i++;
			}
			return $array_id;
		}
		public function getMarcas($categoria){
			if($categoria == "todos"){
				$sql= "SELECT DISTINCT marca FROM productos ";
			}
			else{
				$sql= "SELECT DISTINCT marca FROM productos WHERE categoria like '".$categoria."'";
			}
			$array_marcas= array();
			
			$consulta = mysqli_query($this->db, $sql);
			$i=0;
			while ($fila = mysqli_fetch_assoc($consulta)) {
				$array_marcas[$i]= $fila['marca'];
				$i++;
			}
			return $array_marcas;
		}
		public function getTallas($categoria){
			if($categoria == "todos"){
				$sql= "SELECT DISTINCT talla FROM productos ";
			}
			else{
				$sql= "SELECT DISTINCT talla FROM productos WHERE categoria like '".$categoria."'";
			}
			$array_tallas= array();
			
			$consulta = mysqli_query($this->db, $sql);
			$i=0;
			while ($fila = mysqli_fetch_assoc($consulta)) {
				$array_tallas[$i]= $fila['talla'];
				$i++;
			}
			return $array_tallas;
		}
	}
?>