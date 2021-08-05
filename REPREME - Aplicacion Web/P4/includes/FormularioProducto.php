<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOproducto.php';



	class FormularioProducto extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioProducto';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioProducto');
		}

		
		/**
		* Función que verifica si el usuario ha enviado el formulario.
		* Comprueba si existe el parámetro <code>$formId</code> en <code>$params</code>.
		*
		* @param string[] $params Array que contiene los datos recibidos en el envío formulario.
		*
		* @return boolean Devuelve <code>true</code> si <code>$formId</code> existe como clave en <code>$params</code>
		*/
		private function formularioEnviado(&$params)
		{
			return isset($params['action']) && $params['action'] == $this->formId;
		}
		
		/**
		 * Genera la lista de mensajes de error a incluir en el formulario.
		 *
		 * @param string[] $errores (opcional) Array con los mensajes de error de validación y/o procesamiento del formulario.
		 *
		 * @return string El HTML asociado a los mensajes de error.
		 */
		private function generaListaErrores($errores)
		{
						$html='';
			$numErrores = count($errores);
			if (  $numErrores == 1 ) {
				$html .= "<ul><li>".$errores[0]."</li></ul>";
			} else if ( $numErrores > 1 ) {
				$html .= "<ul><li>";
				$html .= implode("</li><li>", $errores);
				$html .= "</li></ul>";
			}
			return $html;
		}
		
		/**
		 * Genera el HTML necesario para presentar los campos del formulario.
		 *
		 * @param string[] $datosIniciales Datos iniciales para los campos del formulario (normalmente <code>$_POST</code>).
		 * 
		 * @return string HTML asociado a los campos del formulario.
		 */
		protected function generaCamposFormulario($datosIniciales)
		{
			if(empty($datosIniciales)){
				$html = '<fieldset>';
				$html.= '<legend>Rellene los datos del producto: </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" required> </p>';
				$html.= '<p>Precio: <input type="text" name="precio" required></p>';
				$html.= '<p>Descripción: <input type="textarea" name="descripcion" required></p>';
				$html.='<p> Stock disponible: <input type="text" name="stockDisponible" required></p>';
				$html.= '<p>Talla: <input type="text" name="talla" required> </p>';
				$html.= '<p>Color: <input type="text" name="color" required></p>';
				$html.= '<p>Marca: <input type="text" name="marca" required></p>';
				$html.= '<p>Categoria: <select name="categoria"> 
					<option selected>ropa</option>
					<option>sneakers</option>
					<option>accesorios</option>  
					</select>  
					</p>';
				$html.= '<p>Subcategoría: <input type="text" name="subcategoria" required></p>';
				$html.= '<p>Disponibilidad: <select name="disponibilidad"> 
					<option selected>activo</option>
					<option>inactivo</option> 
					</select>  
					</p>';
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile" required> </p>';
				$html.= '<p>Seleccionar imagen auxiliar <input type="file" name="myfile2" required> </p>';
			    $html.= '<p><input type="submit" name="aceptar" ></p>';
			    $html.= '</fieldset>';
			}
			else{
				$id;
				if(!isset($datosIniciales['id'])){
					$id=-1;
				}else{
					$id= $datosIniciales['id'];
				}
				$html = '<fieldset>';
				$html.= '<legend>Rellene los datos del producto: </legend>';
				$html.= '<input type="hidden" name="id" value="'.$id.'">';
				$html.= '<p>Nombre: <input type="text" name="nombre" value="'.$datosIniciales['nombre'].'"required> </p>';
				$html.= '<p>Precio: <input type="text" name="precio" value="'.$datosIniciales['precio'].'"required></p>';
				$html.= '<p>Descripción: <input type="textarea" name="descripcion" value="'.$datosIniciales['descripcion'].'" required></p>';
				$html.=' <p> Stock disponible: <input type="text" name="stockDisponible" value="'.$datosIniciales['stockDisponible'].'"required></p>';
				$html.= '<p>Talla: <input type="text" name="talla"value="'.$datosIniciales['talla'].'" required> </p>';
				$html.= '<p>Color: <input type="text" name="color" value="'.$datosIniciales['color'].'"required></p>';
				$html.= '<p>Marca: <input type="text" name="marca" value="'.$datosIniciales['marca'].'"required></p>';
				if($datosIniciales['categoria']=="ropa"){
					$html.= '<p>Categoria: <select name="categoria" >
					<option selected>ropa</option>
					<option>sneakers</option> 
					<option>accesorios</option>
					</select> 
					</p>';
				}else if($datosIniciales['categoria']=="sneakers"){
					$html.= '<p>Categoria: <select name="categoria" >
					<option>ropa</option>
					<option selected>sneakers</option> 
					<option>accesorios</option>
					</select> 
					</p>';
				}else{
					$html.= '<p>Categoria: <select name="categoria" >
					<option>ropa</option>
					<option>sneakers</option> 
					<option selected>accesorios</option>
					</select> 
					</p>';
				}
				$html.= '<p>Subcategoría: <input type="text" name="subcategoria" value="'.$datosIniciales['subcategoria'].'"required></p>';
				if($datosIniciales['disponibilidad']=="inactivo"){
					$html.= '<p>Disponibilidad: <select name="disponibilidad" >
					<option>activo</option>
					<option selected>inactivo</option> 
					</select> 
					</p>';
				}else{
					$html.= '<p>Disponibilidad: <select name="disponibilidad" >
					<option selected>activo</option>
					<option>inactivo</option> 
					</select> 
					</p>';
				}
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile" > </p>';
				$html.= '<p>Seleccionar imagen auxiliar <input type="file" name="myfile2" > </p>';
			    $html.= '<p><input type="submit" name="aceptar" ></p>';
			    $html.= '</fieldset>';


				
			}
			return $html;
		}
		
		/**
		 * Función que genera el HTML necesario para el formulario.
		 *
		 * @param string[] $errores (opcional) Array con los mensajes de error de validación y/o procesamiento del formulario.
		 *
		 * @param string[] $datos (opcional) Array con los valores por defecto de los campos del formulario.
		 *
		 * @return string HTML asociado al formulario.
		*/
		private function generaFormulario($errores = array(), &$datos)
		{
			$html= $this->generaListaErrores($errores);

			$html .= '<form method="POST" action="'.$this->action.'" id="'.$this->formId.'" >';
			$html .= '<input type="hidden" name="action" value="'.$this->formId.'" />';

			$html .= $this->generaCamposFormulario($datos);
			$html .= '</form>';

			return $html;
		}
		
		/**
		 * Procesa los datos del formulario.
		 *
		 * @param string[] $datos Datos enviado por el usuario (normalmente <code>$_POST</code>).
		 *
		 * @return string|string[] Devuelve el resultado del procesamiento del formulario, normalmente una URL a la que
		 * se desea que se redirija al usuario, o un array con los errores que ha habido durante el procesamiento del formulario.
		 */
		protected function procesaFormulario($datos)
		{
			
			$erroresFormulario = array();

			$nombre = htmlspecialchars(trim(strip_tags($_POST["nombre"])));
			$precio = htmlspecialchars(trim(strip_tags($_POST["precio"])));
			$descripcion = htmlspecialchars(trim(strip_tags($_POST["descripcion"])));
			$stockDisponible = htmlspecialchars(trim(strip_tags($_POST["stockDisponible"])));
			$talla = htmlspecialchars(trim(strip_tags($_POST["talla"])));
			$color = htmlspecialchars(trim(strip_tags($_POST["color"])));
			$marca = htmlspecialchars(trim(strip_tags($_POST["marca"])));
			$categoria = htmlspecialchars(trim(strip_tags($_POST["categoria"])));
			$subcategoria = htmlspecialchars(trim(strip_tags($_POST["subcategoria"])));
			$disponibilidad = htmlspecialchars(trim(strip_tags($_POST["disponibilidad"])));
			$imagen ='img/'.htmlspecialchars(trim(strip_tags($_POST["myfile"])));
			$imagen2 ='img/'.htmlspecialchars(trim(strip_tags($_POST["myfile2"])));

			$productoDAO = new ProductoDAO();

			if(isset($_POST["id"])&& $_POST["id"]!= -1){

				$id = htmlspecialchars(trim(strip_tags($_POST["id"])));
				$p = $productoDAO->getProducto($id);
				$p->setNombre($nombre);
				$p->setPrecio($precio);
				$p->setDescripcion($descripcion);
				$p->setStockDisponible($stockDisponible);
				$p->setTalla($talla);
				$p->setColor($color);
				$p->setMarca($marca);
				$p->setCategoria($categoria);
				$p->setSubcategoria($subcategoria);
				$p->setDisponibilidad($disponibilidad);
				if($imagen!='img/'){
					$p->setImagen($imagen);
				}
				if($imagen2!='img/'){
					$p->setImagen2($imagen2);
				}
				
				
				$productoDAO->update($p);
				$cat = $p->getCategoria();
				$url="vistaProductos.php?categoria=".$cat;
				return $url;


			}else{
				if($productoDAO->comprobarProducto($nombre,$talla)==false){
				$erroresFormulario[]= "El producto ya se encuentra en la base de datos";
				}else{
				$id = $productoDAO->getNumProductos()+1; // hay que quitar de la base de datos lo de auto increment
				$p = new Producto($nombre, $precio, $descripcion, $stockDisponible, $talla, $color, $categoria, $subcategoria, $imagen, $imagen2, $marca,$disponibilidad, $id);

				$productoDAO->insert($p);

				$cat = $p->getCategoria();
				$url="vistaProductos.php?categoria=".$cat;
				return $url;
				}
			}
			
	
			return $erroresFormulario;
		}	
		
		    
		public function gestionaProducto($datosProducto)
   		{   
   		$errores = array();	
        if ( ! $this->formularioEnviado($_POST) ) {
        	
            return $this->generaFormulario($errores,$datosProducto);
        } else {
        	
        	$result = $this->procesaFormulario($_POST);
            if ( is_array($result) ) {
                return $this->generaFormulario($result, $_POST);
            } else {
                header('Location: '.$result);
                exit();
            }
        }  
    }
		
		/**
		 * Se encarga de orquestar todo el proceso de gestión de un formulario.
		 */
		public function gestiona()
		{   

			if ( ! $this->formularioEnviado($_POST) ) {

				return $this->generaFormulario();
			} else {
				$result = $this->procesaFormulario($_POST);
				if ( is_array($result) ) {
					return $this->generaFormulario($result, $_POST);
				} else {
					header('Location: '.$result);
					exit();
	
				}
			}  
		}
	}
	
?>