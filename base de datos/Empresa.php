<?php

class Empresa{
    private $idempresa;
    private $enombre;
    private $edireccion;


    public function __construct($codigo,$nombre,$direccion)
    {
        $this->idempresa = $codigo;
        $this->enombre = $nombre;
        $this->edireccion = $direccion;
        
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($codigo){
        $this->idempresa = $codigo;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function setEnombre($nombre){
        $this->enombre = $nombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function setEdireccion($direccion){
        $this->edireccion = $direccion;
    }

    public function __toString()
    {
        $info = "
        ID EMPRESA: {$this->getIdempresa()}
        NOMBRE: {$this->getEnombre()}
        DIRECCION: {$this->getEdireccion()}
        ";
        return $info;
    }
}