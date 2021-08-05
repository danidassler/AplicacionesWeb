<?php

include_once("DAOproducto.php");

class Carrito{
	public $num_productos;
	public $array_id_prod;
	public $array_cantidad_prod;


	function __construct () {
		$this->num_productos=0; // numero de tipos de productos diferentes que existen en el carrito
	}

	function numElems(){
		return $this->num_productos;
	}
	
	function getIdProd($fila){
		return $this->array_id_prod[$fila];;
	}
	
	function getCantProd($fila){
		return $this->array_cantidad_prod[$fila];;
	}
	
	function cantidadEnCarrito($id){
		if($this->num_productos == 0){ // si aun no existe ningun producto en el carrito
			return 0;
		}
		else{
			for($i=0;$i<$this->num_productos;$i++){
				if($this->array_id_prod[$i]==$id){ // si ya esta el producto en el carrito, se devuelven las uds
					return $this->array_cantidad_prod[$i];
				}
			}
			return 0; // si ha llegado hasta aqui es porque no existe en el carrito
		}
	}
	
	function introduce_producto($id_prod,$cantidad_prod){
		if($this->num_productos == 0){ // si aun no existe ningun producto en el carrito
			$this->array_id_prod[$this->num_productos]=$id_prod;
			$this->array_cantidad_prod[$this->num_productos]=$cantidad_prod;
			$this->num_productos++;
		}
		else{
			$existe=false;
			for($i=0;$i<$this->num_productos;$i++){
				if($this->array_id_prod[$i]==$id_prod){ // si ya esta el producto en el carrito, solo se le suma la cantidad nueva a la que ya tenia
					$this->array_cantidad_prod[$i]+=$cantidad_prod;
					$existe=true;
				}
			}
			if(!$existe){//si no esta en el carrito se introduce normal
				$this->array_id_prod[$this->num_productos]=$id_prod;
				$this->array_cantidad_prod[$this->num_productos]=$cantidad_prod;
				$this->num_productos++;
			}
		}
	}

	function elimina_producto($linea){
		unset($this->array_id_prod[$linea]);
		unset($this->array_cantidad_prod[$linea]);	
		$this->array_id_prod=array_values($this->array_id_prod);
		$this->array_cantidad_prod=array_values($this->array_cantidad_prod);
		$this->num_productos--;
	}
	
	
	function imprime_carrito(){
		$suma = 0;
		$html= '<table id="carrito" border=1 cellpadding="3" style="margin: 0 auto;">
		<tr>
		<td><b>Imagen</b></td>
		<td id="celdaP"><b>Producto</b></td>
		<td><b>Precio</b></td>
		<td><b>Cantidad</b></td>
		<td><b>Subtotal</b></td>
		<td> </td>
		</tr>';
		
		$productoDAO = new ProductoDAO();
		
		for ($i=0;$i<$this->num_productos;$i++){

			$idproducto = $this->array_id_prod[$i];
			$p = $productoDAO->getProducto($idproducto);
			
		   if($this->array_id_prod[$i]!=0){
			  $html.= '<tr>';
			  $html.= "<td> <img src=".$p->getImagen()." alt='Imagen' width='50%' height='10%'/> </td>";
			  $html.= "<td id='celdaP'>" . $p->getNombre() . "</td>";
			  $html.= "<td>" . $p->getPrecio(). "€</td>";
			  $html.="<td>" . $this->array_cantidad_prod[$i] . "</td>";
			  $subtotal= $this->array_cantidad_prod[$i] * $p->getPrecio();
			  $html.= "<td>" . $subtotal . "€</td>";
			  $html.= "<td><a href='eliminar_carrito.php?linea=$i'> <img id='eliminar' src='img/x.png' ></a></td>";
			  $html.= '</tr>';
			  $suma += $subtotal;
		   }
		}
		//muestro el total
		$html.= "<tr><td> </td> <td> </td> <td><b>TOTAL:</b></td><td> <b>$suma</b><b>€</b></td><td> </td></tr>";
		//total más IVA
		$html.= "<tr><td> </td> <td> </td> <td><b>IVA (16%):</b></td><td> <b>" . $suma * 1.16 . "€</b></td><td> </td></tr>";
		$_SESSION["totalCompra"]= $suma * 1.16;
		$html.= "</table>";
		
		return $html;
	}
}
?>