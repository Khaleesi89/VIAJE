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
    private $colecPasajeros;
    private $errorOno;


    public function __construct()
    {
        $this->idviaje = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";
        $this->idempresa = "";
        $this->rnumeroempleado = "";
        $this->vimporte = "";
        $this->tipoAsiento = "";
        $this->idayvuelta = "";
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

    public function getColecPasajeros(){
        return $this->colecPasajeros;
    }

    public function setColecPasajeros($colecPasajeros){
        $this->colecPasajeros = $colecPasajeros;
    }

    public function getErrorOno(){
        return $this->errorOno;
    }

    public function setErrorOno($errorOno){
        $this->errorOno = $errorOno;
    }

    public function mostrarPasajeros(){
        $pasajeros=[];
        $pasajeros=$this->getColecPasajeros();
        $cont = count($pasajeros);
        $string="";
        for ($i=0; $i < $cont ; $i++) { 
            $string.=$pasajeros[$i];
        }
        return $string;
    }

    public function __toString()
    {
        $pasajeros = $this->mostrarPasajeros();
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
        COLECCION DE PASAJEROS:
        {$pasajeros}
        ";
        return $info;
    }
    
    
    public function ingresarViaje($codViaje, $destiny, $capPasajeros, $idEmpresa, $objResponsable, $cash, $tipoAsiento, $idayvuelta) {
        $this->setIdviaje($codViaje);
        $this->setVdestino($destiny);
        $this->setVcantmaxpasajeros($capPasajeros);
        $this->setIdempresa($idEmpresa);
        $this->setRnumeroempleado($objResponsable);
        $this->setVimporte($cash);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdayvuelta($idayvuelta);
    }

}