<?php

class Responsable{
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;


    public function __construct($id,$licencia,$nombre,$apellido)
    {
        $this->rnumeroempleado = $id;
        $this->rnumerolicencia = $licencia;
        $this->rnombre = $nombre;
        $this->rapellido = $apellido;
    }




    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($id){
        $this->rnumeroempleado = $id;
    }

    public function getRnumerolicencia(){
        return $this->rnumerolicencia;
    }

    public function setRnumerolicencia($licencia){
        $this->rnumerolicencia = $licencia;
    }

    public function getRnombre(){
        return $this->rnombre;
    }

    public function setRnombre($nombre){
        $this->rnombre = $nombre;
    }

    public function getRapellido(){
        return $this->rapellido;
    }

    public function setRapellido($apellido){
        $this->rapellido = $apellido;
    }

    public function __toString()
    {
        $info = "
        NUMERO EMPLEADO: {$this->getRnumeroempleado()}
        NUMERO LICENCIA:  {$this->getRnumerolicencia()}
        NOMBRE:  {$this->getRnombre()}
        APELLIDO:  {$this->getRapellido()}
        ";
        return $info;
    }
}