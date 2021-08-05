<?php


require_once __DIR__.'/Form.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DAOnoticia.php';




	class FormularioBusquedaNoticia extends Form{
		
		/**
		 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
		 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
		 */
		private $formId = 'formularioBusquedaNoticia';

		/**
		 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
		 * envío del formulario.
		 */
		private $action;
		
	    public function __construct(){
			parent::__construct('formularioBusquedaNoticia');
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
			$html = '<fieldset>';
			$html.= '<legend>Buscador de Noticias</legend>';
			$html.= '<p>Buscar:<input type="text" name="busq" required> </p>';
			$html.= '<p><input type="submit" name="aceptar" ></p>';
		    $html.= '</fieldset>';
		
	
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
		private function generaFormulario($errores = array(), &$datos= array())
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
			
			$result = array();
			if(isset($_POST["busq"])){
			
			$noticiaDAO = new NoticiaDAO();
			$gestiona;

			$busq = htmlspecialchars(trim(strip_tags($_POST["busq"])));
			
			$result=$noticiaDAO->searchNoticiaBuscador($busq);

			return $this->generaTablaResultados($result);
			}
		}

		private function generaTablaResultados($datosIniciales)
		{

		$numResults= sizeof($datosIniciales);	
		$html="";

		if($numResults>0){
			$html.="<p>Hemos encontrado ".$numResults." Noticias</p>";
			$html.="<table id='BTabla'>";
			$html.= "<tr>";
			$html.= "<th class='colu'> Imagen </th>";
			$html.= "<th class='colu'> ID </th>";
			$html.= "<th class='colu'> Titulo </th>";
			$html.= "<th class='colu'>Disponibilidad </th>";
			$html.= "<th class='colu'>Accede </th>";
			if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']==true)
			{
				$html.= "<th class='colu'> Modifica </th>"; 
			}
			$html.= "</tr>";


		
		
			for($i=0; $i<$numResults;$i++)
			{
			
				$html.= "<tr id=modifcacion>";
				$html.= "<td class='CeldaMod'><a href='vistaNoticia.php?id=".$datosIniciales[$i]->getId()."'> <img src='".(string)$datosIniciales[$i]->getImagen()."'alt='Imagen' width='100' height='100'/></a></td>";
				$html.= "<td class='CeldaMod'> ".$datosIniciales[$i]->getId()."</td>";
				$html.= "<td class='CeldaMod'><a id='nombreP' href='vistaNoticia.php?id=".$datosIniciales[$i]->getId()."'> ".$datosIniciales[$i]->getTitulo()."</a></td>";
				$html.= "<td class='CeldaMod'> ".$datosIniciales[$i]->getDisponibilidad()."</td>";
				$html.= "<td class='CeldaMod'> <a href='vistaNoticia.php?id=".$datosIniciales[$i]->getId()."'><img src='img/flecha.png' alt='ACCEDE A LA NOTICIA' width='50' height='50'/></a></td>";
				$html.= '<input type="hidden" name="idNoticia" value='.$datosIniciales[$i]->getId().'" >';
				if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']==true)
				{

					$html.= "<td class='CeldaMod'> <a href='gestionNoticia.php?id=".$datosIniciales[$i]->getId()."&gestion=modificar'><img src='img/modificarPB.png' alt='MODIFICA LA NOTICIA' width='50' height='50'/></a></td>";
						$html.= '<input type="hidden" name="idNoticia" value='.$datosIniciales[$i]->getId().'" >';
				}

				//$html.= '<td class="CeldaMod"><input type="submit" value="ACCEDE" name="aceptar" onclick="location="vistaProducto.php?id='.$datosIniciales[$i]->getId().'></td>';
				$html.= "</tr>";
		
			}
			$html.= "</table>";
		}else{
			$html.="<div id='noEncontrado' ><img class='notfound' src='img/productnotfound.jpg' /></div>";
			
			
		}

		return $html;
	}	
		    
	
		/**
		 * Se encarga de orquestar todo el proceso de gestión de un formulario.
		 */
		
		public function gestiona()
		{   
			$result = array();
			$html ="";
			$html.= $this->generaFormulario($result, $_POST);
			$html.= $this->procesaFormulario($_POST);
			return $html;
        	if (!is_array($result) ) {
        		header('Location:'.$result);
			} 	
						
		} 
		
		
	}
	
?>