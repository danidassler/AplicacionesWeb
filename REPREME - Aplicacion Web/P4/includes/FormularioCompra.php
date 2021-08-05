<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/DAOventa.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOventaproducto.php';
require_once __DIR__.'/DAOproducto.php';
require_once __DIR__.'/lib_carrito.php';


	class FormularioCompra extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioCompra';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioCompra');
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
				$html.='<p>Ha habido un error con su compra, la causa del error es:</p>';
				$html .= "<ul><li>".$errores[0]."</li></ul>";
				$html.= '<p>Por favor vuelve a introducir tus datos para finalizar la compra </p>';
			} else if ( $numErrores > 1 ) {
				$html.='<p>Ha habido un error con su compra, la causa del error es:</p>';
				$html .= "<ul><li>";
				$html .= implode("</li><li>", $errores);
				$html .= "</li></ul>";
				$html.= '<p>Por favor vuelve a introducir tus datos para finalizar la compra </p>';
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
				$html.= '<legend>Rellene los datos para finalizar su compra: </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" required>';
				$html.= '  Apellidos: <input type="text" name="apellido" required></p>';
				$html.= '<p>País: <input type="text" name="pais" required></p>';
				$html.= '<p>Dirección: <input type="text" name="direccion" required>';
				$html.='  Código postal: <input type="text" name="cp" required></p>';
				$html.= '<p>Localidad/Ciudad: <input type="text" name="localidad" required>';
				$html.= '  Provincia: <input type="text" name="provincia" required></p>';
				$html.= '<p>Teléfono: <input type="text" name="telefono" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" required></p>';
				$html.= '</fieldset>';
				$html .= '<div id="fc"><fieldset>';
				$html.= '<legend>  Rellene los datos de pago: </legend>';
				$html .='<p><input type="checkbox" id="tipoV" name="tipoT" value="Visa" >';
				$html .='<img src="img/visa.jpg" class="visa" style="width:8%; height:6%;"/>';
				$html .='<input type="checkbox" id="tipoMC" name="tipoT" value="MasterCard" >';
				$html .='<img src="img/mastercard.png" class="MasterCard" style="width:5%; height:3%;"/></p>';
				$html .='<p>Numero de tarjeta: <input type="text" name="tarjeta" required></p>';
				$html .='<p>Fecha de caducidad: <input type="text" name="mesC" required> / <input type="text" name="añoC" required> </p>';
				$html .='<p>CVV: <input type="text" name="cvv" required></p>';
				$html .='<?php echo "La cantidad total a pagar es "'. $_SESSION["totalCompra"] .'"€." ?>';
				$html.= '<p><input type="submit" name="aceptar" value="PAGAR"></p>';
			    $html.= '</fieldset></div>';
			}
			else{
				$html = '<fieldset>';
				$html.= '<legend> Rellene los datos para finalizar su compra: </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" value="'.$datosIniciales['nombre'].'" required>';
				$html.= '  Apellido: <input type="text" name="apellido" value="'.$datosIniciales['apellido'].'" required></p>';
				$html.= '<p>País: <input type="text" name="pais" value="'.$datosIniciales['pais'].'" required></p>';
				$html.= '<p>Dirección: <input type="text" name="direccion" value="'.$datosIniciales['direccion'].'" required>';
				$html.='  Código postal: <input type="text" name="cp" value="'.$datosIniciales['cp'].'" required></p>';
				$html.= '<p>Localidad/Ciudad: <input type="text" name="localidad" value="'.$datosIniciales['localidad'].'" required>';
				$html.= '  Provincia: <input type="text" name="provincia" value="'.$datosIniciales['provincia'].'" required></p>';
				$html.= '<p>Teléfono: <input type="text" name="telefono" value="'.$datosIniciales['telefono'].'" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" value="'.$datosIniciales['correo'].'" required></p>';
			    $html.= '</fieldset>';
				$html .= '<div id="fc"><fieldset>';
				$html.= '<legend>  Rellene los datos de pago: </legend>';
				$html .='<p><input type="checkbox" id="tipoV" name="tipoT" value="Visa" >';
				$html .='<img src="img/visa.jpg" class="visa" style="width:8%; height:6%;"/>';
				$html .='<input type="checkbox" id="tipoMC" name="tipoT" value="MasterCard" >';
				$html .='<img src="img/mastercard.png" class="MasterCard" style="width:5%; height:3%;"/></p>';
				$html .='<p>Numero de tarjeta: <input type="text" name="tarjeta" required></p>';
				$html .='<p>Fecha de caducidad: <input type="text" name="mesC" required> / <input type="text" name="añoC" required> </p>';
				$html .='<p>CVV: <input type="text" name="cvv" required></p>';
				$html .='<?php echo "La cantidad total a pagar es "'. $_SESSION["totalCompra"] .'"€." ?>';
				$html.= '<p><input type="submit" name="aceptar" value="PAGAR"></p>';
			    $html.= '</fieldset></div>';
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
		private function generaFormulario($errores = array(), &$datos = array())
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
			$apellido = htmlspecialchars(trim(strip_tags($_POST["apellido"])));
			$pais = htmlspecialchars(trim(strip_tags($_POST["pais"])));
			$dir = htmlspecialchars(trim(strip_tags($_POST["direccion"])));
			$cp = htmlspecialchars(trim(strip_tags($_POST["cp"])));
			$ciudad = htmlspecialchars(trim(strip_tags($_POST["localidad"])));
			$provincia = htmlspecialchars(trim(strip_tags($_POST["provincia"])));
			$telefono = htmlspecialchars(trim(strip_tags($_POST["telefono"])));
			$correo = htmlspecialchars(trim(strip_tags($_POST["correo"])));
			$mesC=htmlspecialchars(trim(strip_tags($_POST["mesC"])));
			$añoC=htmlspecialchars(trim(strip_tags($_POST["añoC"])));

			if(isset($_SESSION["login"]) && isset($_SESSION["ocarrito"])){
				$ok=true;
				$fecha=getdate();
				$dia=$fecha['mday'];
				$mes=$fecha['mon'];
				$año=$fecha['year'];
				$fecha_hoy = $año."-".$mes."-".$dia;
				
				#comprobamos que la tarjeta de credito no esta caducada
				if($añoC < $año ){
					$ok=false;
					$erroresFormulario[]="la tarjeta esta caducada por años";
				}
				else if($añoC == $año)
				{ 
					if ($mesC < $mes)
					{
					$ok=false;
					$erroresFormulario[]="la tarjeta esta caducada por meses";
					
					}

				}
				if($ok){ #si no esta caducada podremos realizar la venta

					$total=$_SESSION["totalCompra"];
					$user=$_SESSION["usuario"];
					
					$ventaDAO = new VentaDAO();
					$ventaproductoDAO = new VentaProductoDAO();
					$id_venta = $ventaDAO->getNumVentas()+1;
					$ventaDAO->insert($id_venta, $fecha_hoy, $total, $user);
					$productoDAO = new ProductoDAO();
					
					$num_productos=$_SESSION["ocarrito"]->numElems();
					for ($i=0; $i < $num_productos; $i++){
						$idproducto = $_SESSION["ocarrito"]->getIdProd($i);
						$unidades = $_SESSION["ocarrito"]->getCantProd($i);
						$ventaproductoDAO->insert($id_venta, $idproducto, $unidades);
						$p= $productoDAO->getProducto($idproducto);
						$stock = $p->getStockDisponible();
						$nuevo_stock = $stock - $unidades;
						$p->setStockDisponible($nuevo_stock);
						$productoDAO->update($p);
					}
					//return "confirmacionCompra.php?dir=$dir&cp=$cp&provincia=$provincia&pais=$pais&ciudad=$ciudad";
					//$html='<div id="contenedor">';
					$html= '<div id="CC">';
					$html.= '<p><b> Su compra se ha realizado correctamente, muchas gracias por confiar en REPREME </p>';
					$html.= '<p> Total pagado:'. $total.' € </p>';
					$html.= '<p> Fecha de la compra:' .$fecha_hoy. '</p>';
					$html.= '<p> Direccion de envio: '. $dir .', '. $cp .', '. $provincia .', '. $ciudad . ', '. $pais. '</p>';
					$html.= '<p> Para cualquier duda acerca de su pedido por favor contacta con nosotros </b></p>';
					return $html;
				}
			}
			else{
				$ok=false;
				$erroresFormulario[]="No existe usuario logueado";
			}
			return $erroresFormulario;
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
					$result.='<p><input type="button" id="botonN" onclick="location='."'contacto.php'".'" value = "CONTACTA CON NOSOTROS"/>
					<input type="button" id="botonN" onclick="location='."'perfilUsuario.php?compra=0&fav=0'".'" value = "MI PERFIL" />
					<input type="button" id="botonN" onclick="location='."'vistaProductos.php?categoria=todos'".'" value = "VOLVER A LA TIENDA"  /></p>
					</div>';
					unset($_SESSION["ocarrito"]);
					unset($_SESSION["totalCompra"]);
					return $result;
					
					
				}
			}  
		}
	}
	
?>