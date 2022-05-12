<?php

//De los viajes aéreos se conoce el número del vuelo, la categoría del asiento (primera clase o no), nombre de la aerolínea, 
//y la cantidad de escalas del vuelo en caso de tenerlas

class Aereos extends Viaje{
    private $nroVuelo;
    private $categoriaAsiento;
    private $aerolinea;
    private $cantEscalas;


    public function __construct($codigoViaje , $lugarDestino , $maximoPasajeros, $totalPersonasViajan, $administradorViaje, $vuelo, $asientoCat,$airlineas,$escalas){
        parent::__construct($codigoViaje , $lugarDestino , $maximoPasajeros, $totalPersonasViajan, $administradorViaje);
        $this->nroVuelo = $vuelo;
        $this->categoriaAsiento = $asientoCat;
        $this->aerolinea = $airlineas;
        $this->cantEscalas = $escalas;
        
    }

    public function getNroVuelo(){
        return $this->nroVuelo;
    }

    public function setNroVuelo($vuelo){
        $this->nroVuelo = $vuelo;
    }

    public function getCategoriaAsiento(){
        return $this->categoriaAsiento;
    }

    public function setCategoriaAsiento($asientoCat){
        $this->categoriaAsiento = $asientoCat;
    }

    public function getAerolinea(){
        return $this->aerolinea;
    }

    public function setAerolinea($airlineas){
        $this->aerolinea = $airlineas;
    }

    public function getCantEscalas(){
        return $this->cantEscalas;
    }

    public function setCantEscalas($escalas){
        $this->cantEscalas = $escalas;
    }


    public function __toString(){
        $info = "
        NUMERO DE VUELO: {$this->getNroVuelo()}
        CATEGORIA DE ASIENTO: {$this->getCategoriaAsiento()}
        AEROLINEAS: {$this-> getAerolinea()}
        ESCALAS: {$this->getCantEscalas()}
        ";
        return $info;
        
    }
}