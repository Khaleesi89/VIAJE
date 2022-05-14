<?php


class Empresa{
    private $objViajes = [];


    public function __construct($arrayViajes){
        $this->objViajes = $arrayViajes;
    }
    
    public function getObjViajes(){
        return $this->objViajes;
    }

    public function setObjViajes($arrayViajes){
        $this->objViajes = $arrayViajes;
    }

    //FUNCION PARA MOSTRAR LOS VIAJES



    private function mostrarViajes(){
        $viajecitos=[];
        $viajecitos=$this->getObjViajes();
        $stringViajes="";
        for ($i=0; $i < count($viajecitos) ; $i++) { 
            $stringViajes.=$viajecitos[$i];
        }
        return $stringViajes;
    }
        

    public function __toString(){
        $array = $this->mostrarViajes();
        $info = "
        ***************************
        Viajes
        ***************************
        $array
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


}













public function venderPasaje($pasajero){
    $hayPasaje = $this->hayPasajesDisponible();
    if($hayPasaje){

    }


    
}