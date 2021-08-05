<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOinfousuario.php';
require_once __DIR__.'/Usuario.php';



	class FormularioUsuario extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioUsuario';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioUsuario');
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
				$html.='<p>Ha habido un error al modificar, la causa del error es:</p>';
				$html .= "<ul><li>".$errores[0]."</li></ul>";
				$html.= '<p>Por favor vuelve a introducir tus datos </p>';
			} else if ( $numErrores > 1 ) {
				$html.='<p>Ha habido un error al modificar, la causa del error es:</p>';
				$html .= "<ul><li>";
				$html .= implode("</li><li>", $errores);
				$html .= "</li></ul>";
				$html.= '<p>Por favor vuelve a introducir tus datos </p>';
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
				$html.= '<legend> Rellene los datos a modificar </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" required>';
				$html.= '  Apellido: <input type="text" name="apellido" required></p>';
				$html.= '<p>DNI: <input type="text" name="dni" required></p>';
				$html.= '<p>País: <input type="text" name="pais" required></p>';
				$html.= '<p>Dirección: <input type="text" name="direccion" required>';
				$html.='  Código postal: <input type="text" name="cp" required></p>';
				$html.= '<p>Localidad/Ciudad: <input type="text" name="localidad" required>';
				$html.= '  Provincia: <input type="text" name="provincia" required></p>';
				$html.= '<p>Teléfono: <input type="text" name="telefono" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" required></p>';
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile"> </p>';
				$html.= '<p><input type="submit" name="aceptar" ></p>';
			    $html.= '</fieldset>';
			}
			else{
				$html = '<fieldset id="fieldsetusuario">';
				$html.= '<legend> Rellene los datos a modificar </legend>';
				$html.= '<div id="fieldusrizq"><p>Nombre: <input type="text" name="nombre" value="'.$datosIniciales['nombre'].'" required>';
				$html.= '  Apellido: <input type="text" name="apellido" value="'.$datosIniciales['apellido'].'" required></p>';
				$html.= '<p>DNI: <input type="text" name="dni" value="'.$datosIniciales['dni'].'" required></p>';
				$html.= '<p>País: <input type="text" name="pais" value="'.$datosIniciales['pais'].'" required></p>';
				$html.= '<p>Dirección: <input type="text" name="direccion" value="'.$datosIniciales['direccion'].'" required>';
				$html.='  Código postal: <input type="text" name="cp" value="'.$datosIniciales['cp'].'" required></p>';
				$html.= '<p>Localidad/Ciudad: <input type="text" name="localidad" value="'.$datosIniciales['localidad'].'" required>';
				$html.= '  Provincia: <input type="text" name="provincia" value="'.$datosIniciales['provincia'].'" required></p>';
				$html.= '<p>Teléfono: <input type="text" name="telefono" value="'.$datosIniciales['telefono'].'" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" value="'.$datosIniciales['correo'].'" required></p><p><input type="submit" name="aceptar" ></p></div>';
				$html.= '<div id="fieldusrder"><img class="ImagenUserMod" src="'.$datosIniciales['myfile'].'" alt="usuario"   /><p>Seleccionar imagen <input type="file" name="myfile" value="'.$datosIniciales['myfile'].'" > </p>';
				$html.= '</div>';
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
			// de momento solo he hecho posible editar la info, pero en un futuro podemos hacer que se edite la contraseña o nombre de usuario etc etc
			$erroresFormulario = array();

			$infoUsuarioDAO=new InfoUserDAO();

			$nombre = htmlspecialchars(trim(strip_tags($_POST["nombre"])));
			$apellido = htmlspecialchars(trim(strip_tags($_POST["apellido"])));
			$dni = htmlspecialchars(trim(strip_tags($_POST["dni"])));
			$pais = htmlspecialchars(trim(strip_tags($_POST["pais"])));
			$dir = htmlspecialchars(trim(strip_tags($_POST["direccion"])));
			$cp = htmlspecialchars(trim(strip_tags($_POST["cp"])));
			$ciudad = htmlspecialchars(trim(strip_tags($_POST["localidad"])));
			$provincia = htmlspecialchars(trim(strip_tags($_POST["provincia"])));
			$telefono = htmlspecialchars(trim(strip_tags($_POST["telefono"])));
			$correo = htmlspecialchars(trim(strip_tags($_POST["correo"])));
			$imagen = 'img/'.htmlspecialchars(trim(strip_tags($_POST["myfile"])));
			

			if (count($erroresFormulario) === 0) {

				$u2 = $infoUsuarioDAO->getInfoUser($_SESSION["usuario"]);
				$u2->setNombre($nombre);
				$u2->setApellido($apellido);
				$u2->setDni($dni);
				$u2->setPais($pais);
				$u2->setDireccion($dir);
				$u2->setCodPostal($cp);
				$u2->setLocalidad($ciudad);
				$u2->setProvincia($provincia);
				$u2->setTelefono($telefono);
				$u2->setEmail($correo);
				if($imagen!="img/"){
					
					$u2->setImagen($imagen);
				}
				
				$infoUsuarioDAO->update($u2);
				$url="perfilUsuario.php";
				return $url;
			}
			return $erroresFormulario;
		}
		
		public function gestionaU($datosUsuario)
   		{   
   		$errores = array();	
        if ( ! $this->formularioEnviado($_POST) ) {
            return $this->generaFormulario($errores,$datosUsuario);
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