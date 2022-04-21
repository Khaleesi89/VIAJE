<?php

/*
La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.
Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos
*/

class Viaje{

    // ATRIBUTOS //

    // código del viaje //
    private $codigoViaje;

    //destino //
    private $destino;
    
    //cantidad máxima de pasajeros //
    private $cantMaxPasajeros;

    //cantidad de pasajeros del viaje//
    private $cantPasajerosViaje;

    //pasajeros del viaje //
    private $coleccObjPasajero= [];

    //responsable del viaje//
    private $objResponsable;


    //// CONSTRUCTOR ////
    public function __construct($codViagem , $destiny , $cantMaxPasaj, $cantidadGenteEnBus, $responsable){
        $this->codigoViaje = $codViagem;
        $this->destino = $destiny;
        $this->cantMaxPasajeros = $cantMaxPasaj;
        $this->cantPasajerosViaje = $cantidadGenteEnBus;
        $this->objResponsable = $responsable;
           
    }   

    // METODOS //

    public function getCodigoViaje(){
        return $this->codigoViaje;
    }

    public function setCodigoViaje($codViagem){
        $this->codigoViaje=$codViagem;
    }
    ////////////////////////////////

    public function getDestino(){
        return $this->destino;
    }

    public function setDestino($destiny){
        $this->destino=$destiny;
    }

    ////////////////////////////////

    public function getCantPasajerosViaje(){
        return $this->cantPasajerosViaje;
    }

    public function setCantPasajerosViaje($cantidadGenteEnBus){
        $this->cantPasajerosViaje=$cantidadGenteEnBus;
    }

    ////////////////////////////////

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function setCantMaxPasajeros($cantMaxPasaj){
        $this->cantMaxPasajeros=$cantMaxPasaj;
    }

    ////////////////////////////////

    public function getColeccObjPasajero(){
        return $this->coleccObjPasajero;
    }

    public function setColeccObjPasajero($arrayPasajero){
        $this->coleccObjPasajero=$arrayPasajero;
    }

    public function getObjResponsable(){
        return $this->objResponsable;
    }

    public function setObjResponsable($responsable){
        $this->objResponsable = $responsable;
    }

    ////////////////////////////////

    //AGREGO CADA PASAJERO AL ARRAY DEL ATRIBUTO

    /**
     * @param objeto $viajante 
     * @return bool
     */

    public function agregarPasajero($viajante){
        $existe = $this->validarPasajero($viajante);
        if(!$existe){
            $arrayBruto= $this->getColeccObjPasajero();
            array_push($arrayBruto, $viajante);
            $this->setColeccObjPasajero($arrayBruto);
        }
    }    
        

    /**
     * @param objeto $cliente
     * @return bool
     */

    public function validarPasajero($cliente){
        $colecObPasaj= $this->getColeccObjPasajero();
        $dniCliente = $cliente->getDocumento();
        $sacar = true;
        $a=0;
        while ($a <= count($colecObPasaj) && $sacar){
            $pasajeroParticular =  $colecObPasaj[$a];
            $dniPasajeroParticular = $pasajeroParticular->getDocumento();
            if($dniPasajeroParticular == $dniCliente){
                $sacar= false;
            }
            $a++;
             
        }
        return $sacar;
    }

    //// MODIFICO DATOS DE LOS PASAJEROS ////
     /**
     * @param string $nombrePasaj
     * @param string $apellidoPasaj
     * @param int $identidadDni
     * @param int $phones
     * @return array
     */
    
    public function modificarViajeros($nombrePasaj, $apellidoPasaj, $identidadDni, $phones){
        $arrayParaBuscar = $this->getColeccObjPasajero();
        $i= 0;
        $sigue =true;
        while ($i < count($arrayParaBuscar) && $sigue){ //ITERAMOS MIENTRAS $i SEA MENOR QUE LA CANTIDAD DE LOS EELEMENTOS DEL ARREGLO Y QUE LA BANDEERA $sigue SEA TRUE
            $pasajeroAbuscar = $arrayParaBuscar[$i];
            $identifPasaj = $pasajeroAbuscar->getDocumento();
            if ($identifPasaj == $identidadDni){
                $sigue = false; // COMO ENCONTRE EL PASAJERO QUE QUIERO MODIFICAR CAMBIO EL VALOR DE VERDAD DE LA BANDERA
                $pasajeroAbuscar->setNombre($nombrePasaj);
                $pasajeroAbuscar->setApellido( $apellidoPasaj);
                $pasajeroAbuscar->setTelefono($phones);
                $arrayParaBuscar[$i] = $pasajeroAbuscar;
        }   
        $i++;
    }
        return $arrayParaBuscar;
    }
   
    //// ARMO UN STRING CON LOS DATOS DE LOS PASAJEROS ////

    /**
     * @param void
     * @return string 
     */

    public function datosPasajerosString(){
        $colexionPasaj = $this->getColeccObjPasajero();
        $stringPasajeros="";
        foreach($colexionPasaj as $key => $value){
            $objPassenger = $value;
            $strPasaj = $objPassenger->__toString();
            $stringPasajeros.=$strPasaj;
        }
        return $stringPasajeros;
    }

    /// CANTIDAD DE PASAJEROS ////
    
    /**
     * @param void
     * @return int 
     */

    public function countPasajeros(){
        $cantidad= count($this->cantPasajerosViaje);
        return $cantidad;

    }

    //// TOSTRING ////

    public function __toString(){
        $arrayPasajer = $this->getColeccObjPasajero();
        $todosLosViajeros= $this->datosPasajerosString();
        $info = "
        viaje:  {$this->getCodigoViaje()} .\n
        Destino:  {$this->getDestino()} .\n
        Responsable del viaje: {$this->getObjResponsable()}.\n
        Cantidad Máxima de Pasajeros: {$this->getCantMaxPasajeros()} . \n
        Cantidad de Pasajeros: {$this->getCantPasajerosViaje()} . \n
        Datos de Pasajeros: 
        \n
        $todosLosViajeros";
        return $info;
    }

    
}
