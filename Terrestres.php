<?php

//De los viajes terrestres se conoce la comodidad del asiento, si es semicama o cama.


class Terrestres extends Viaje{
    private $comodidadAsiento;


    public function __construct($idViaje , $lugarArribo , $maxPasaj, $personasQviajaron, $responsableViajen, $asientoComodidad){
        parent::__construct($idViaje , $lugarArribo , $maxPasaj, $personasQviajaron, $responsableViajen);
        $this->comodidadAsiento = $asientoComodidad;
    }

    

    public function getComodidadAsiento(){
        return $this->comodidadAsiento;
    }

    public function setComodidadAsiento($asientoComodidad){
        $this->comodidadAsiento = $asientoComodidad;
    }

    public function __toString(){
        $info= "
        COMODIDAD DEL ASIENTO: {$this->getComodidadAsiento()}
        ";
        return $info;
        
    }
}
