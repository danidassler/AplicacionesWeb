<?php
  class Valoracion {

  	//Atributos 

  	private $idValoracion="";
  	private $idProducto="";
    private $puntuacion="";
    private $user="";
    private $visibilidad="activo";
  	

  	//constructor
  	function __construct($idProd, $idVal,$punt,$usuario){
        $this->idValoracion = $idVal;
        $this->idProducto = $idProd;
        $this->puntuacion=$punt;
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
  	 public function getIdprod()
    {
        return $this->idProducto;
    }
    
     public function getIdValoracion()
    {
        return $this->idValoracion;
    }
  
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }
    public function setPutuacion($punt)
    {
      $this->puntuacion=$punt;

    }

     
}

?>