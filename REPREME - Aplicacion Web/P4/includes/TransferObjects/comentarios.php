<?php
  class Comentario {

  	//Atributos 

  	private $idComentario="";
  	private $idProducto="";
    private $descripcion="";
    private $user="";
    private $visibilidad="activo";
  	

  	//constructor
  	function __construct($idProd, $idCom,$desc,$usuario){
        $this->idComentario = $idCom;
        $this->idProducto = $idProd;
        $this->descripcion=$desc;
        $this->user=$usuario;
    }

  	//getters y setters
    public function getUser()
    {
        return $this->user;
    }
     public function setUser($us)
    {
        $this->user=$us;
    }
    public function getVisibilidad()
    {
      return $this->visibilidad;
    }
    public function setVisibilidad($visibilidad)
    {
      $this->visibilidad=$visibilidad;
    }
  	 public function getIdProd()
    {
        return $this->idProducto;
    }
    
     public function getIdcomentario()
    {
        return $this->idComentario;
    }
  
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descrip)
    {
      $this->descripcion=$descrip;

    }

     
}

?>