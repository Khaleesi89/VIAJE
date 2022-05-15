<?php

//De los viajes aéreos se conoce el número del vuelo, la categoría del asiento (primera clase o no), nombre de la aerolínea, 
//y la cantidad de escalas del vuelo en caso de tenerlas

class Aereos extends Viaje{
    private $nroVuelo;
    private $categoriaAsiento;
    private $aerolinea;
    private $cantEscalas;
    private $importe;
    private $idaOvuelta;


    public function __construct($codigoViaje , $lugarDestino , $maximoPasajeros, $totalPersonasViajan, $administradorViaje, $vuelo, $asientoCat,$airlineas,$escalas, $valorVuelo,$tipoDeTrayecto){
        parent::__construct($codigoViaje , $lugarDestino , $maximoPasajeros, $totalPersonasViajan, $administradorViaje);
        $this->nroVuelo = $vuelo;
        $this->categoriaAsiento = $asientoCat;
        $this->aerolinea = $airlineas;
        $this->cantEscalas = $escalas;
        $this->importe = $valorVuelo;
        $this->idaOvuelta = $tipoDeTrayecto;
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

    public function getImporte(){
        return $this->importe;
    }

    public function setImporte($valorVuelo){
        $this->importe = $valorVuelo;
    }

    public function getIdaOvuelta(){
        return $this->idaOvuelta;
    }

    public function setIdaOvuelta($tipoDeTrayecto){
        $this->idaOvuelta = $tipoDeTrayecto;
    }

    public function __toString(){
        $info = parent::__toString();
        $info .= "
        NUMERO DE VUELO: {$this->getNroVuelo()}
        CATEGORIA DE ASIENTO: {$this->getCategoriaAsiento()}
        AEROLINEAS: {$this-> getAerolinea()}
        ESCALAS: {$this->getCantEscalas()}
        IMPORTE: {$this->getImporte()}
        ES IDA O VUELTA O IDA Y VUELTA:  {$this->getIdaOvuelta()}
        ";
        return $info;
        
    }


        //CALCULAR LOS IMPORTES

        /*Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, si el viaje además de ser un asiento de 
        primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. Tanto para viajes terrestres o aéreos,
            si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.*/

        public function calcularImporteViaje(){
                $importe = $this->getImporte();
                $valor = $this->getImporte();
                $asiento = $this->getCategoriaAsiento();
                $escalits = $this->getCantEscalas();
                $trayecto = $this->getIdaOvuelta();
                if($asiento == "PC"){
                        if($escalits == 0){
                            $importe = $valor + (($valor*40)/100);
                            $this->setImporte($importe);
                        }else{
                            $importe = $valor + (($valor*60)/100);
                            $this->setImporte($importe);
                        }
                        if($trayecto == "IyV"){
                                $importe = $valor + (($valor*50)/100);
                                $this->setImporte($importe);
                        }
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
                $importe = $this->calcularImporteViaje();
                $this->setImporte($importe);
                parent::agregarPasajero($pasajero);
            }
            return $importe;
        }
}

        

