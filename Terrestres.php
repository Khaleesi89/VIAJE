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

    //FUNCION TO STRING//

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


    // FUNCION PARA CREAR UNA NUEVA VENTA DE PASAJE

    /*La empresa ahora necesita implementar la venta de un pasaje,para ello debe realizar la función venderPasaje(pasajero) que 
    registra la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible. 
    Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%. 
    Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, 
    si el viaje además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. 
    Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.
    El método retorna el importe del pasaje si se pudo realizar la venta. */

    public function venderPasaje($pasajero){
        $hay = parent::hayPasajesDisponible();
        if($hay){
            $importe = $this->calcularImporte();
            $this->setImporteViaje($importe);
            parent::agregarPasajero($pasajero);
        }
        return $importe;
    }
}
