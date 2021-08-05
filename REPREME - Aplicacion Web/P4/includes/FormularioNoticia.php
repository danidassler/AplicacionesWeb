<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOnoticia.php';



	class FormularioNoticia extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioNoticia';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioNoticia');
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
				$html.= '<legend>Rellene los datos de la noticia: </legend>';
				$html.= '<p>Titulo: <input type="text" name="titulo" required> </p>';
				$html.= '<p>Parrafo 1: <textarea name="parrafo1" required></textarea></p>';
				$html.= '<p>Parrafo 2: <textarea type="textarea" name="parrafo2" required></textarea></p>';
				$html.='<p>Parrafo 3: <textarea type="textarea" name="parrafo3" required></textarea></p>';
				$html.= '<p>Disponibilidad: <select name="disponibilidad"> 
					<option selected>activa</option>
					<option>inactiva</option> 
					</select>  
					</p>';
				$html.= '<p>Seleccionar imagen <input type="file" name="myfile" required> </p>';
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
				$html.= '<legend>Rellene los datos de la noticia: </legend>';
				$html.= '<input type="hidden" name="idNoticia" value="'.$id.'">';
				$html.= '<p>Titulo: <input type="text" name="titulo"value="'.$datosIniciales['titulo'].'" required> </p>';
				$html.= '<p>Parrafo 1: <textarea name="parrafo1" required>'.$datosIniciales['parrafo1'].'</textarea></p>';
				$html.= '<p>Parrafo 2: <textarea name="parrafo2" required>'.$datosIniciales['parrafo2'].'</textarea></p>';
				$html.='<p>Parrafo 3: <textarea  name="parrafo3" required>'.$datosIniciales['parrafo3'].'</textarea></p>';
				if($datosIniciales['disponibilidad']=="inactiva"){
					$html.= '<p>Disponibilidad: <select name="disponibilidad" >
					<option>activa</option>
					<option selected>inactiva</option> 
					</select> 
					</p>';
				}else{
					$html.= '<p>Disponibilidad: <select name="disponibilidad" >
					<option selected>activa</option>
					<option>inactiva</option> 
					</select> 
					</p>';
				}
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
			$titulo = htmlspecialchars(trim(strip_tags($_POST["titulo"])));
			$parrafo1 = htmlspecialchars(trim(strip_tags($_POST["parrafo1"])));
			$parrafo2 = htmlspecialchars(trim(strip_tags($_POST["parrafo2"])));
			$parrafo3 = htmlspecialchars(trim(strip_tags($_POST["parrafo3"])));
			$disponibilidad = htmlspecialchars(trim(strip_tags($_POST["disponibilidad"])));
			$imagen ='img/'.htmlspecialchars(trim(strip_tags($_POST["myfile"])));

			$noticiaDAO = new NoticiaDAO();

			if(isset($_POST["idNoticia"])&& $_POST["idNoticia"]!= -1){

				$id = htmlspecialchars(trim(strip_tags($_POST["idNoticia"])));
				$n = $noticiaDAO->getNoticia($id);
				$n->setTitulo($titulo);
				$n->setParrafo1($parrafo1);
				$n->setParrafo2($parrafo2);
				$n->setParrafo3($parrafo3);
				$n->setDisponibilidad($disponibilidad);
				if($imagen!='img/'){
					$n->setImagen($imagen);
				}
				
				
				$noticiaDAO->update($n);
				$url="vistaNoticias.php";
				return $url;


			}else{
				if($noticiaDAO->comprobarNoticia($titulo,$imagen)==false){
				$erroresFormulario[]= "La noticia ya se encuentra en la base de datos";
				}else{
				$id = $noticiaDAO->getNumNoticias()+1; // hay que quitar de la base de datos lo de auto increment
				$n = new Noticia($id, $titulo, $parrafo1, $parrafo2, $parrafo3, $imagen, $disponibilidad);

				$noticiaDAO->insert($n);

				$url="vistaNoticias.php";
				return $url;
				}
			}
			
	
			return $erroresFormulario;
		}	
		
		    
		public function gestionaNoticia($datosNoticia)
   		{   
   		$errores = array();	
        if ( ! $this->formularioEnviado($_POST) ) {
        	
            return $this->generaFormulario($errores,$datosNoticia);
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