<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOinfousuario.php';
require_once __DIR__.'/TransferObjects/infousuario.php';
require_once __DIR__.'/Aplicacion.php';


	class FormularioRegistro extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioRegistro';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioRegistro');
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
				$html = '<fieldset id="formulario">';
				$html.= '<legend> REGISTRO </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" required>';
				$html.= '  Apellido: <input type="text" name="apellido" required></p>';
				$html.= '<p>DNI: <input type="text" name="dni" required> Nombre de usuario: <input type="text" name="user" id="campoUser" required>';
				$html.= ' '.'<img id="iconoMU" src= "img/no.png"/>';
				$html.= ' <img id="iconoBU" src= "img/ok.png"/></p>';
				$html.= '<p> Contraseña: <input type="password" name="contraseña" required>';
				$html.= ' Confirmacion de contraseña: <input type="password" name="2contraseña" required></p>';
				$html.= '<p>País: <input type="text" name="pais" required> ';
				$html.= 'Dirección: <input type="text" name="direccion" required>';
				$html.='<p>Código postal: <input type="text" name="cp" required>';
				$html.= ' Localidad/Ciudad: <input type="text" name="localidad" required></p>';
				$html.= '<p> Provincia: <input type="text" name="provincia" required>';
				$html.= ' Teléfono: <input type="text" name="telefono" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" id="campoCorreo" required>';
				$html.= ' '.'<img id="iconoM" src= "img/no.png"/>';
				$html.= ' <img id="iconoB" src= "img/ok.png"/></p>';
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile" > </p>';
				$html.= '<p><input type="submit" name="aceptar" ></p>';
			    $html.= '</fieldset>';
			}
			else{
				$html = '<fieldset>';
				$html.= '<legend> REGISTRO </legend>';
				$html.= '<p>Nombre: <input type="text" name="nombre" value="'.$datosIniciales['nombre'].'" required>';
				$html.= '  Apellido: <input type="text" name="apellido" value="'.$datosIniciales['apellido'].'" required></p>';
				$html.= '<p>DNI: <input type="text" name="dni" value="'.$datosIniciales['dni'].'" required> ';
				$html.= ' Nombre de usuario: <input type="text" name="user" id="campoUser" required>';
				$html.= ' '.'<img id="iconoMU" src= "img/no.png"/>';
				$html.= ' <img id="iconoBU" src= "img/ok.png"/></p>';
				$html.= ' <p> Contraseña: <input type="password" name="contraseña" required>';
				$html.= ' Confirmacion de contraseña: <input type="password" name="2contraseña" required></p>';
				$html.= '<p>País: <input type="text" name="pais" value="'.$datosIniciales['pais'].'" required></p>';
				$html.= ' Dirección: <input type="text" name="direccion" value="'.$datosIniciales['direccion'].'" required></p>';
				$html.= '<p>Código postal: <input type="text" name="cp" value="'.$datosIniciales['cp'].'" required>';
				$html.= ' Localidad/Ciudad: <input type="text" name="localidad" value="'.$datosIniciales['localidad'].'" required></p>';
				$html.= '<p>Provincia: <input type="text" name="provincia" value="'.$datosIniciales['provincia'].'" required>';
				$html.= ' Teléfono: <input type="text" name="telefono" value="'.$datosIniciales['telefono'].'" required></p>';
				$html.= '<p>Dirección de correo electrónico: <input type="text" name="correo" id="campoCorreo" required>';
				$html.= ' '.'<img id="iconoM" src= "img/no.png"/>';
				$html.= ' <img id="iconoB" src= "img/ok.png"/></p>';
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile"> </p>';
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

			$infoUsuario=new InfoUserDAO();

			$nombre = htmlspecialchars(trim(strip_tags($_POST["nombre"])));
			$apellido = htmlspecialchars(trim(strip_tags($_POST["apellido"])));
			$dni = htmlspecialchars(trim(strip_tags($_POST["dni"])));
			$usuario = htmlspecialchars(trim(strip_tags($_POST["user"])));
			$contrasena = htmlspecialchars(trim(strip_tags($_POST["contraseña"])));
			$rep_con = htmlspecialchars(trim(strip_tags($_POST["2contraseña"])));
			$pais = htmlspecialchars(trim(strip_tags($_POST["pais"])));
			$dir = htmlspecialchars(trim(strip_tags($_POST["direccion"])));
			$cp = htmlspecialchars(trim(strip_tags($_POST["cp"])));
			$ciudad = htmlspecialchars(trim(strip_tags($_POST["localidad"])));
			$provincia = htmlspecialchars(trim(strip_tags($_POST["provincia"])));
			$telefono = htmlspecialchars(trim(strip_tags($_POST["telefono"])));
			$correo = htmlspecialchars(trim(strip_tags($_POST["correo"])));
			#LO DE LA IMAGEN NOSE SI VA ASI, PREGUNTAR AL PROFESOR
			$imagen = htmlspecialchars(trim(strip_tags($_POST["myfile"])));
			if($imagen == ""){
				$img = "img/perfilvacio.jpg";
			}else{
			$img = "img/".$imagen;}
			$user = new infoUser($nombre, $apellido, $usuario, $pais, $dir, $cp, $ciudad, $provincia, $telefono, $correo, $img, $dni);
			$u = Usuario::buscaUsuario($usuario);


			if($u){ // si existe el usuario
				$erroresFormulario[] = "El usuario ya existe";
			}
			if($contrasena != $rep_con){
				$erroresFormulario[] = "Las contraseñas deben coincidir";
			}
			if (count($erroresFormulario) === 0) {
				$usuarioCreado = Usuario::crea($usuario, $contrasena, "usuario");
				$infoUsuario->insert($user->getNombre(),$user->getApellido(),$user->getUser(),$user->getPais(),$user->getDireccion(),$user->getCodPostal(),$user->getLocalidad(),$user->getProvincia(),$user->getTelefono(),$user->getEmail(),$user->getImagen(),$user->getDni());
				Aplicacion::getSingleton()->Registro($user);
				$url = "vistaProductos.php?categoria=todos";
				return $url;
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
					header('Location: '.$result);
					exit();
				}
			}  
		}
	}
	
?>