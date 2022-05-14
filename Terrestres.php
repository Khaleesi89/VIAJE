<?php

//De los viajes terrestres se conoce la comodidad del asiento, si es semicama o cama.


class Terrestres extends Viaje{
    private $comodidadAsiento;
    private $importeViaje;
    private $idaOvueltas;


    public function __construct($idViaje , $lugarArribo , $maxPasaj, $personasQviajaron, $responsableViajen, $asientoComodidad, $importe, $idaYoVuelta){
        parent::__construct($idViaje , $lugarArribo , $maxPasaj, $personasQviajaron, $responsableViajen);
        $this->comodidadAsiento = $asientoComodidad;
        $this->importeViaje = $importe;
        $this->idaOvueltas = $idaYoVuelta;
    }

    

    public function getComodidadAsiento(){
        return $this->comodidadAsiento;
    }

    public function setComodidadAsiento($asientoComodidad){
        $this->comodidadAsiento = $asientoComodidad;
    }

    public function getImporteViaje(){
        return $this->importeViaje;
    }

    public function setImporteViaje($importe){
        $this->importeViaje = $importe;
    }

    public function getIdaOvueltas(){
        return $this->idaOvueltas;
    }

    public function setIdaOvueltas($idaYoVuelta){
        $this->idaOvueltas = $idaYoVuelta;
    }





    public function __toString(){
        $info = parent::__toString();
        $info .= "
        COMODIDAD DEL ASIENTO: {$this->getComodidadAsiento()}
        IMPORTE:  {$this->getImporteViaje()}
        IDA O VUELTA O IDA Y VUELTA:  {$this->getIdaOvueltas()}
        ";
        return $info;
        
    }


    //FUNCION CALCULAR IMPORTES

    /* Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%. Tanto para viajes terrestres o aéreos,
    si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.*/
         
    public function calcularImporte(){
        $tipoAsiento = $this->getComodidadAsiento();
        $tipoTrayecto = $this->getIdaOvueltas();
        $cash = $this->getImporteViaje();
        $importe = $this->getImporteViaje();
        if($tipoAsiento == "CAMA"){
            $importe = $cash + (($cash*25)/100);
            $this->setImporteViaje($importe);
        }
        if($tipoTrayecto == "IyV"){
            $importe = $cash + (($cash*50)/100);
            $this->setImporteViaje($importe);
        }
        return $importe;
    }
}
