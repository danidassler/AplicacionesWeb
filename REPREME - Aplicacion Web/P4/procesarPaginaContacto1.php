<?php
require_once __DIR__.'/includes/config.php';
if(isset($_POST['email'])) {
 
    // 
 
    $email_to = "jesuscpedrero@gmail.com";
 
    $email_subject = "Contacto desde Web";
 
    function died($error) {
 
        // mensajes de error
 
        echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
 
        echo "Detalle de los errores.";
 
        echo $error;
 
        echo "Porfavor corrija estos errores e inténtelo de nuevo.";
        die();
    }
 
    // Se valida que los campos del formulairo estén llenos
 
    if(!isset($_POST['nombre']) ||
 
        !isset($_POST['apellido']) ||
		
		!isset($_POST['user']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['n_pedido']) ||
 
        !isset($_POST['consulta'])) {
 
        die('Lo sentimos pero parece haber un problema con los datos enviados.');
 
    }
 //En esta parte el valor "name"  sirve para crear las variables que recolectaran la información de cada campo
 
    $first_name = $_POST['nombre']; // requerido
 
    $last_name = $_POST['apellido']; // requerido
	 
	$user = $_POST['user']; // requerido
 
    $email_from = $_POST['email']; // requerido
 
    $pedido = $_POST['n_pedido']; // no requerido 
 
    $consulta = $_POST['consulta']; // requerido
 
    $error_message = "";//Linea numero 52;
 
//En esta parte se verifica que la dirección de correo sea válida 
 
   //$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  //if(!preg_match($email_exp,$email_from)) {
 
    //$error_message .= 'La dirección de correo proporcionada no es válida.';
 
  //}
 
//En esta parte se validan las cadenas de texto
 
   // $string_exp = "/^[A-Za-z .'-]+$/";
 
  //if(!preg_match($string_exp,$first_name)) {
 
    //$error_message .= 'El formato del nombre no es válido';
 
  //}
 
  //if(!preg_match($string_exp,$last_name)) {
 
    //$error_message .= 'el formato del apellido no es válido.';
 
  //}
 
  //if(strlen($message) < 2) {
 
    //$error_message .= 'El formato del texto no es válido.';
 
  //}
 
  //if(strlen($error_message) > 0) {
 
    //die($error_message);
 
  //}
 
//Este es el cuerpo del mensaje tal y como llegará al correo
 
    $email_message = "Contenido del Mensaje.\n\n";
 
 
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
 
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
 
    $email_message .= "Apellido: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Teléfono: ".clean_string($pedido)."\n";
 
    $email_message .= "Mensaje: ".clean_string($consulta)."\n";
 
 
//Se crean los encabezados del correo
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);
 
include 'confirmacion.php';
 
}
 
?>