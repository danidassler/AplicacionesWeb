<?php

namespace es\fdi\ucm\aw;

require_once __DIR__ . '/aplicacion.php';


class Usuario{
	private $id;
	private $nombreUsuario;
	private $nombre;
	private $password;
	private $rol;
	
	private function __construct ($nombreUsuario, $nombre, $password, $rol){
		$this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
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

	public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
	
	//Devuelve un objeto Usuario con la información del usuario $nombreUsuario, o false si no lo encuentra.
	public static function buscaUsuario($nombreUsuario){
		//acceso a la base de datos
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
		$query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
		$rs = $conn->query($query);
		$result = false;
		//comprobamos la consulta
		if($rs){ 
			if ( $rs->num_rows == 1) {// si hay una unica fila es que hemos encontrado el usuario
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']);
                $user->id = $fila['id'];
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
	public static function crea($nombreUsuario, $nombre, $password,$rol){
		$usuario = self::buscaUsuario($nombreUsuario);
		if($usuario){
			return false; // si el usuario existe no podemos crear otro igual
		}
		$usuario = new Usuario($nombreUsuario, $nombre, password_hash($password, PASSWORD_DEFAULT),$rol);
		return self::inserta($usuario);
	}
	
	//inserta el nuevo usuario en la base de datos
	private static function inserta($usuario){
		//acceso a la base de datos
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
		$query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol) VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol));
		$rs = $conn->query($query);
		if($rs){
			$usuario->id = $conn->insert_id;
		}
		else{
			echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
		}
		return $usuario;
	}
	
	// Comprueba si la contraseña introducida coincide con la del Usuario
	public function compruebaPassword($password){
		return password_verify($password, $this->password); //usamos la funcion que verifica que las contraseñas son iguales
	}
}