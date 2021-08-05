<?php

require_once __DIR__ . '/Aplicacion.php';


class Usuario{

	private $nombreUsuario;
	private $password;
	private $rol;
	
	private function __construct ($nombreUsuario, $password, $rol){
		$this->nombreUsuario= $nombreUsuario;
        $this->password = $password;
        $this->rol = $rol;
	}
	
	//getters y setters
  	public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsusario = $nombreUsuario;
    }
	
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getRol()
    {
        return $this->rol;
    }
	    public function setRol($rol)
    {
        $this->rol=$rol;
    }
	
	 public function getAdmin()
    {
      if($this->rol=="administrador")
      {
        return true;
      }
      else
        {
          return false;
        }
    }
	
	//Devuelve un objeto Usuario con la información del usuario $nombreUsuario, o false si no lo encuentra.
	public static function buscaUsuario($nombreUsuario){
		//acceso a la base de datos
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
		$query = sprintf("SELECT * FROM usuario U WHERE U.user = '%s'", $conn->real_escape_string($nombreUsuario));
		$rs = $conn->query($query);
		$result = false;
		//comprobamos la consulta
		if($rs){ 
			if ( $rs->num_rows == 1) {// si hay una unica fila es que hemos encontrado el usuario
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['user'], $fila['password'], $fila['permisos']);
                $result = $user;
			}
			$rs->free();
		}else{ 
			echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
		}
		return $result;
	}
	
	// Usando las funciones anteriores, devuelve un objeto Usuario si el usuario existe y coincide su contraseña. En caso contrario, devuelve false.
	public static function login($nombreUsuario, $password){
		$usuario = self::buscaUsuario($nombreUsuario);
		if( $usuario && $usuario->compruebaPassword($password)){
			return $usuario;
		}
		return false;
	}
	
	//Crea un nuevo usuario con los datos introducidos por parámetro.
	public static function crea($nombreUsuario,$password,$rol){
		$usuario = self::buscaUsuario($nombreUsuario);
		if($usuario){
			return false; // si el usuario existe no podemos crear otro igual
		}
		$usuario = new Usuario($nombreUsuario, password_hash($password, PASSWORD_DEFAULT),$rol);
		return self::inserta($usuario);
	}
	
	//inserta el nuevo usuario en la base de datos
	private static function inserta($usuario){
		//acceso a la base de datos
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
		$query=sprintf("INSERT INTO usuario(user, password, permisos) VALUES('%s','%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol));
		$rs = $conn->query($query);
		if($rs){
			// todo bien
		}
		else{
			echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
		}
		return $usuario;
	}

	
	public function actualiza($u)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
		$query =sprintf("UPDATE usuario set user='".$u->getNombreUsuario()."',password='".$u->getPassword()."',permisos='".$u->getRol()."' WHERE user like '".$u->getNombreUsuario()."'");
        if ( $conn->query($query) ) {

        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $u;
    }
	
	// Comprueba si la contraseña introducida coincide con la del Usuario
	public function compruebaPassword($password){
		return password_verify($password, $this->password); //usamos la funcion que verifica que las contraseñas son iguales
	}
}

?>