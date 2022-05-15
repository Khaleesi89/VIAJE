<?php


class Empresa{
    private $objViajesAereos = [];
    private $objViajesTerrestres= [];



    public function __construct($arrayViajesAereos,$arrayViajesTerrestres){
        $this->objViajesAereos = $arrayViajesAereos;
        $this->objViajesTerrestres = $arrayViajesTerrestres;
    }
    
    public function getObjViajesAereos(){
        return $this->objViajesAereos;
    }

    public function setObjViajesAereos($arrayViajesAereos){
        $this->objViajesAereos = $arrayViajesAereos;
    }

    public function getObjViajesTerrestres(){
        return $this->objViajesTerrestres;
    }

    public function setObjViajesTerrestres($arrayViajesTerrestres){
        $this->objViajesTerrestres = $arrayViajesTerrestres;
    }

    //FUNCION PARA MOSTRAR LOS VIAJES

    private function mostrarViajesAereos(){
        $viajecitos=[];
        $viajecitos=$this->getObjViajesAereos();
        $stringViajesAereos="";
        for ($i=0; $i < count($viajecitos) ; $i++) { 
            $stringViajesAereos.=$viajecitos[$i];
        }
        return $stringViajes;
    }
        
    private function mostrarViajesTerrestres(){
        $viajecitos=[];
        $viajecitos=$this->getObjViajesTerrestres();
        $stringViajesTerrestres="";
        for ($i=0; $i < count($viajecitos) ; $i++) { 
            $stringViajesTerrestres.=$viajecitos[$i];
        }
        return $stringViajes;
    }
        

    public function __toString(){
        $arrayAereos = $this->mostrarViajesAereos();
        $arrayTerrestres = $this->mostrarViajesTerrestres();
        $info = "
        ***************************
        Viajes AEREOS
        ***************************
        $arrayAereos \n
        ***************************
        Viajes TERRESTRES
        ***************************
        $arrayTerrestres 
        ";
        return $info;
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
        $viajes = $this->getObjViajes();
        $i = 0;
        $salir = true;
        while($i< count($viajes) && $salir){
            $viajeParticular = $viajes[$i];
            $hay = $viajeParticular->hayPasajesDisponible();
            if($hay){

            }
            
            
            
            $i++
        } 
    }


    
}













