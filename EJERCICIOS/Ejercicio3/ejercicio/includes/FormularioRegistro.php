<?php

namespace es\fdi\ucm\aw;

require_once __DIR__.'/Form.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/config.php';


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
				$html = '<fieldset>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Nombre de usuario:</label> <input class="control" type="text" name="nombreUsuario" />';
				$html.= '</div>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Nombre completo:</label> <input class="control" type="text" name="nombre" />';
				$html.= '</div>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Password:</label> <input class="control" type="password" name="password"/>';
				$html.= '</div>';
				$html.='<div class="grupo-control"><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" /><br /></div>';
				$html.= '<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>';
				$html.= '</fieldset>';
			}
			else{
				$html = '<fieldset>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Nombre de usuario:</label> <input class="control" type="text" name="nombreUsuario" value="'.$datosIniciales['nombreUsuario'].'"/>';
				$html.= '</div>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Nombre completo:</label> <input class="control" type="text" name="nombre" value="'.$datosIniciales['nombre'].'"/>';
				$html.= '</div>';
				$html.= '<div class="grupo-control">';
				$html.= '<label>Password:</label> <input class="control" type="password" name="password"/>';
				$html.= '</div>';
				$html.='<div class="grupo-control"><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" /><br /></div>';
				$html.= '<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>';
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

			$nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;

			if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
				$erroresFormulario[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
			}

			$nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
			if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
				$erroresFormulario[] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
			}

			$password = isset($datos['password']) ? $datos['password'] : null;
			if ( empty($password) || mb_strlen($password) < 5 ) {
				$erroresFormulario[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
			}
			$password2 = isset($datos['password2']) ? $datos['password2'] : null;
			if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
				$erroresFormulario[] = "Los passwords deben coincidir";
			}

			if (count($erroresFormulario) === 0) {
				$usuario = Usuario::crea($nombreUsuario, $nombre, $password, 'user');
				if (! $usuario ) {
					$erroresFormulario[] = "El usuario ya existe";
				} else {
					$_SESSION['login'] = true;
					$_SESSION['nombre'] = $nombreUsuario;
					$url='index.php';
					return $url;
				}
			}
			return $erroresFormulario;
		}	
		
		
		/**
		 * Se encarga de orquestar todo el proceso de gestión de un formulario.
		 */
		public function gestiona()
		{   

			if ( ! $this->formularioEnviado($_POST) ) {

				echo $this->generaFormulario();
			} else {
				$result = $this->procesaFormulario($_POST);
				if ( is_array($result) ) {
					echo $this->generaFormulario($result, $_POST);
				} else {
					header('Location: '.$result);
					exit();
				}
			}  
		}
	}
	
?>