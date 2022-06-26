<?php 
include_once "BaseDeDatos.php";

class Viaje{
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $rdocumento;
    private $idempresa;
    private $rnumeroempleado;
    private $vimporte;
    private $tipoAsiento;
    private $idayvuelta;


    public function __construct($codigoviaje,$destino,$cantMaxPasaj,$documento,$empresa,$empleado,$importe,$asientoTipo,$goAndReturn)
    {
        $this->idviaje = $codigoviaje;
        $this->vdestino = $destino;
        $this->vcantmaxpasajeros = $cantMaxPasaj;
        $this->rdocumento = $documento;
        $this->idempresa = $empresa;
        $this->rnumeroempleado = $empleado;
        $this->vimporte = $importe;
        $this->tipoAsiento = $asientoTipo;
        $this->idayvuelta = $goAndReturn;
    }


    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($codigoviaje){
        $this->idviaje = $codigoviaje;
    }

    public function getVdestino(){
        return $this->vdestino;
    }

    public function setVdestino($destino){
        $this->vdestino = $destino;
    }

    public function getVcantmaxpasajeros(){
        return $this->vcantmaxpasajeros;
    }

    public function setVcantmaxpasajeros($cantMaxPasaj){
        $this->vcantmaxpasajeros = $cantMaxPasaj;
    }

    public function getRdocumento(){
        return $this->rdocumento;
    }

    public function setRdocumento($documento){
        $this->rdocumento = $documento;
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($empresa){
        $this->idempresa = $empresa;
    }

    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($empleado){
        $this->rnumeroempleado = $empleado;
    }

    public function getVimporte(){
        return $this->vimporte;
    }

    public function setVimporte($importe){
        $this->vimporte = $importe;
    }

    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }

    public function setTipoAsiento($asientoTipo){
        $this->tipoAsiento = $asientoTipo;
    }

    public function getIdayvuelta(){
        return $this->idayvuelta;
    }

    public function setIdayvuelta($goAndReturn){
        $this->idayvuelta = $goAndReturn;
    }

    public function __toString()
    {
        $info = "
        ID VIAJE: {$this->getIdviaje()}
        DESTINO: {$this-> getVdestino()}
        CANTIDAD MAXIMA PASAJEROS: {$this->getVcantmaxpasajeros()}
        NRO DOCUMENTO: {$this->getRdocumento()}
        CODIGO EMPRESA: {$this->getIdempresa()}
        ID EMPLEADO: {$this->getRnumeroempleado()}
        IMPORTE: {$this->getVimporte()}
        TIPO DE ASIENTO: {$this->getTipoAsiento()}
        IDA Y VUELTA: {$this->getIdayvuelta()}
        ";
        return $info;
    }
    
}