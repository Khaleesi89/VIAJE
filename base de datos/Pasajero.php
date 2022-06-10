<?php


class Pasajero{
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $idviaje;


    public function __construct($documento,$nombre,$apellido,$telefono,$codigoViaje)
    {
        $this->rdocumento = $documento;
        $this->pnombre = $nombre;
        $this->papellido = $apellido;
        $this->ptelefono = $telefono;
        $this->idviaje = $codigoViaje;
    }




    public function getRdocumento(){
        return $this->rdocumento;
    }

    public function setRdocumento($documento){
        $this->rdocumento = $documento;
    }

    public function getPnombre(){
        return $this->pnombre;
    }

    public function setPnombre($nombre){
        $this->pnombre = $nombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }

    public function setPapellido($apellido){
        $this->papellido = $apellido;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }

    public function setPtelefono($telefono){
        $this->ptelefono = $telefono;
    }

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($codigoViaje){
        $this->idviaje = $codigoViaje;
    }

    public function __toString()
    {
        $info="
        DOCUMENTO: {$this->getRdocumento()}
        NOMBRE: {$this->getPnombre()}
        APELLIDO: {$this->getPapellido()}
        TELEFONO: {$this->getPtelefono()}
        ID VIAJE: {$this->getIdviaje()}
        ";
        return $info;
    }
}