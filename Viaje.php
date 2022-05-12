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

    //importe //
    private $importe;

    //si es ida y/o vuelta//
    private $idaOvuelta;


    //// CONSTRUCTOR ////
    public function __construct($codViagem , $destiny , $cantMaxPasaj, $cantidadGenteEnBus, $responsable,$valorPasaje,$esIdaOesVuelta){
        $this->codigoViaje = $codViagem;
        $this->destino = $destiny;
        $this->cantMaxPasajeros = $cantMaxPasaj;
        $this->cantPasajerosViaje = $cantidadGenteEnBus;
        $this->objResponsable = $responsable;
        $this->importe = $valorPasaje;
        $this->idaOvuelta = $esIdaOesVuelta;
           
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

    public function getImporte(){
        return $this->importe;
    }

    public function setImporte($valorPasaje){
        $this->importe = $valorPasaje;
    }

     ////////////////////////////////

    public function getIdaOvuelta(){
        return $this->idaOvuelta;
    }

    public function setIdaOvuelta($esIdaOesVuelta){
        $this->idaOvuelta = $esIdaOesVuelta;
    }

    //AGREGO CADA PASAJERO A LA COLECCIONN DE PASAJEROS

    /**
     * @param objeto $viajante 
     * @return void
     */

    /*public function agregarPasajero($viajante){
        $existe = $this->validarPasajero($viajante);
        if(!$existe){
            $arrayBruto= $this->getColeccObjPasajero();
            array_push($arrayBruto, $viajante);
            $this->setColeccObjPasajero($arrayBruto);
        }
        
    }*/ 


    public function agregarPasajero($viajante){
        $arrayBruto =$this->getColeccObjPasajero();
        $cantObjetos = count($arrayBruto);
        if($cantObjetos == 0){
            $arrayBruto[0] = $viajante;
            $this->setColeccObjPasajero($arrayBruto);
        }else{
        $existe = $this->validarPasajero($viajante);
        if(!$existe){
            array_push($arrayBruto, $viajante);
            $this->setColeccObjPasajero($arrayBruto);
        }
        }
        
    }  

        

    //VALIDO SI ESTÁ CARGADO ANTERIORMENTE  EL PASAJERO
    /**
     * @param objeto $cliente
     * @return bool
     */


    public function validarPasajero($cliente){
        $colecObjPasaj= $this->getColeccObjPasajero();
        $tieneOnoObjetos = count($colecObjPasaj);
        $dniCliente = $cliente->getDocumento();
        $sacar = false;
        $a=0;
        if($tieneOnoObjetos > 0){
            do{
                if($colecObjPasaj[$a]->getDocumento()==$dniCliente){
                    $sacar= true;
                }else{
                    $a++;  
                }
            }while(!$sacar && ($a<$tieneOnoObjetos));
        }    
            return $sacar;
    }


    /*public function validarPasajero($cliente){
        $colecObPasaj= $this->getColeccObjPasajero();
        $tieneOnoObjetos = count($colecObPasaj);
        $dniCliente = $cliente->getDocumento();
        $sacar = true;
        $a=0;
        if($tieneOnoObjetos > 0){
            while ($a <= $tieneOnoObjetos && $sacar){
                $pasajeroParticular =  $colecObPasaj[$a];
                $dniPasajeroParticular = $pasajeroParticular->getDocumento();
                if($dniPasajeroParticular == $dniCliente){
                    $sacar= false;
                }
                $a++;
                  
            }
             
        }
        return $sacar;
    }*/

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



    //PROBE TRES COSAS Y SIGUE SIN APARECER LOS DATOS DE PASAJEROS

    /**
     * @param void
     * @return string 
     */


    private function datosPasajerosString(){
        $personas=[];
        $personas=$this->getColeccObjPasajero();
        $stringPasajeros="";
        for ($i=0; $i < count($personas) ; $i++) { 
            $stringPasajeros.=$personas[$i];
        }
        return $stringPasajeros;
    }
        
        
        
        
        
        
        /*$colexionPasaj = $this->getColeccObjPasajero();
        $stringPasajeros="";
        foreach($colexionPasaj as $pasajero){
            $stringPasajeros.=$pasajero."\n";
        }
        return $stringPasajeros;
    }*/

    /*public function datosPasajerosString(){
        $colexionPasaj = $this->getColeccObjPasajero();
        $stringPasajeros="";
        foreach($colexionPasaj as $key => $value){
            $objPassenger = $value;
            $strPasaj = $objPassenger->__toString();
            $stringPasajeros.=$strPasaj;
        }
        return $stringPasajeros;
    }*/

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

     // La empresa de transporte desea gestionar la información correspondiente a los Viajes que pueden ser: Terrestres o Aéreos, 
     //guardar su importe e indicar si el viaje es de ida y vuelta. De los viajes aéreos se conoce el número del vuelo, la categoría 
     //del asiento (primera clase o no), nombre de la aerolínea, y la cantidad de escalas del vuelo en caso de tenerlas. De los viajes 
     // terrestres se conoce la comodidad del asiento, si es semicama o cama. La empresa ahora necesita implementar la venta de un pasaje,
     //  para ello debe realizar la función venderPasaje(pasajero) que registra la venta de un viaje al pasajero que es recibido por parámetro. 
     // La venta se realiza solo si hayPasajesDisponible. Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%. 
     // Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, si el viaje además de ser un asiento de primera
     //   clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. Tanto para viajes terrestres o aéreos, si el viaje es ida y 
     //  vuelta, se incrementa el importe del viaje un 50%. El método retorna el importe del pasaje si se pudo realizar la venta.
     //Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad 
     //máxima de pasajeros y falso caso contrario 

    

    
}

