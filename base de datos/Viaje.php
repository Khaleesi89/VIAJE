<?php 
require_once('BaseDeDatos.php');
require_once('Empresa.php');
require_once('Responsable.php');

class Viaje{
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $objEmpresa; //idempresa;
    private $objResponsable; //rnumeroempleado;
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
        $this->objEmpresa = "";
        $this->rnumeroempleado = "";
        $this->vimporte = "";
        $this->tipoAsiento = "";
        $this->idayvuelta = "";
        $this->colecPasajeros = [];
        
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

    public function getObjEmpresa(){
        return $this->objEmpresa;
    }

    public function setObjEmpresa($empresa){
        $this->objEmpresa = $empresa;
    }

    public function getObjResponsable(){
        return $this->objResponsable;
    }

    public function setObjResponsable($empleado){
        $this->objResponsable = $empleado;
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
        EMPRESA: {$this->getObjEmpresa()}
        EMPLEADO RESPONSABLE: {$this->getObjResponsable()}
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
        $this->setObjEmpresa($idEmpresa);
        $this->setObjResponsable($objResponsable);
        $this->setVimporte($cash);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdayvuelta($idayvuelta);
    }


    //PARA SABER EL ULTIMO ID DE VIAJE

    public function idviajesIncremento(){
        $baseDeDatos = new BaseDeDatos();
        $respuesta = null;
        $consulta = "SELECT `AUTO_INCREMENT`
                    FROM  INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_SCHEMA = 'bdviajes'
                    AND   TABLE_NAME   = 'viaje';";
        if($baseDeDatos->Iniciar()){
            if($baseDeDatos->Ejecutar($consulta)){
                if($row2=$baseDeDatos->Registro()){
                    $respuesta = $row2['AUTO_INCREMENT'];
                }
            }   else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        }   else{
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $respuesta;
    }


    //LISTAR VIAJES
    public function listar($condicion){
        $arregloviaje = null;
        $basedatos = new BaseDeDatos();
        $consultar = "SELECT * FROM viaje";
        if($condicion != ""){
		    $consultar .=' where '.$consultar;
		}
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consultar)){
                $arregloviaje = array();
                while($viaje=$basedatos->Registro()){
                    $idviaje = $viaje['idviaje'];
                    $vdestino = $viaje['vdestino'];
                    $vcantmaxpasajeros = $viaje['vcantmaxpasajeros'];
                    $vimporte = $viaje['vimporte'];
                    $tipoAsiento = $viaje['tipoAsiento'];
                    $idayvuelta = $viaje['idayvuelta'];
                    $viajess = new Viaje();
                    $objReponsable = new Responsable();
                    $objEmpresa = new Empresa();
                    $coleccionPasajeros = $this->listarPasaj();
                    $viajess->ingresarViaje($idviaje, $vdestino, $vcantmaxpasajeros, $objEmpresa, $objReponsable, $vimporte, $tipoAsiento, $idayvuelta,$coleccionPasajeros);
                    $arregloviaje[] = $viajess;
                }
            }	else{
                $arregloviaje = $this->setErrorOno($basedatos->getError());
            }
        }	else{
            $arregloviaje = $this->setErrorOno($basedatos->getError());

        }
        return $arregloviaje;
    }

    //LISTAR PASAJEROS


    public function listarPasaj(){
        $arreglo = null;
        $basedatos = new BaseDeDatos();
        $consulta = "SELECT * FROM pasajero WHERE idviaje=".$this->getIdViaje();
        $consulta .= " ORDER BY papellido";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $arreglo = array();
                while($pasaj=$basedatos->Registro()){
                    $rdocumento = $pasaj['rdocumento'];
                    $pnombre = $pasaj['pnombre'];
                    $papellido = $pasaj['papellido'];
                    $ptelefono = $pasaj['ptelefono'];
                    $idviaje = $pasaj['idviaje'];
                    $pasajero = new Pasajero($rdocumento,$pnombre,$papellido,$ptelefono,$idviaje);
                    $arreglo[] = $pasajero;
                }
            }	else{
                $arreglo = $this->setErrorOno($basedatos->getError());
            }
        }	else{
            $arreglo = $this->setErrorOno($basedatos->getError());
        }
        return $arreglo;
    }


    //BUSCAR VIAJE

    public function buscar($idViaje){
        $basedatos = new BaseDeDatos();
        $consulta = "SELECT * FROM viaje WHERE idviaje=".$idViaje;
        $respuesta = false;
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                if($viaje=$basedatos->Registro()){
                    $objReponsable = new Responsable();
                    $objEmpresa = new Empresa();
                    //$objReponsable->buscar($viaje['rnumeroempleado']);					
                    //$objEmpresa->buscar($viaje['idempresa']);
                    $this->setIdViaje($idViaje);
                    $this->setVDestino($viaje['vdestino']);
                    $this->setVCantMaxPasajeros($viaje['vcantmaxpasajeros']);
                    $this->setObjEmpresa ($objEmpresa);
                    $this->setObjResponsable($objReponsable);
                    $this->setVImporte($viaje['vimporte']);
                    $this->setTipoAsiento($viaje['tipoAsiento']);
                    $this->setIdaYVuelta($viaje['idayvuelta']);
                    $this->setColecPasajeros($this->listarPasaj());
                    $respuesta = true;
                }
            }   else{
                $respuesta = $this->setErrorOno($basedatos->getError());
            }
        }   else{
            $respuesta = $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }


    //INSERTAR
    public function insertar(){
        $basedatos = new BaseDeDatos();
        $respuesta = false;
        $consulta = "INSERT INTO viaje (vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
                    VALUES (".$this->getVDestino().",".$this->getVCantMaxPasajeros().",".$this->getObjEmpresa()()->getIdempresa().",".$this->getObjResponsable()->getNumEmpleado().",".$this->getVImporte().",".$this->getTipoAsiento().",'".$this->getIdayvuelta()."')";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }	else{
                $respuesta = $this->setErrorOno($basedatos->getError());
            }
        } else{
            $respuesta = $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }

    //MODIFICAR
    public function modificar(){
        $respuesta = false;
        $basedatos = new BaseDeDatos();
        $consulta = "UPDATE viaje 
                    SET idViaje = ".$this->getIdViaje().",
                    vdestino = '".$this->getVDestino()."', 
                    vcantmaxpasajeros = ".$this->getVCantMaxPasajeros().", 
                    idempresa = ".$this->getObjEmpresa()()->getIdempresa().", 
                    rnumeroempleado = ".$this->getObjResponsable()->getNumEmpleado().", 
                    vimporte = ".$this->getVImporte().",
                    tipoAsiento = ".$this->getTipoAsiento().",
                    idayvuelta = '".$this->getIdaYVuelta()."' WHERE idviaje = ".$this->getIdViaje();
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }   else{
                $respuesta = $this->setErrorOno($basedatos->getError());
            }
        }   else{
            $respuesta = $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }


    //ELIMINAR
    public function eliminar(){
        $basedatos = new BaseDeDatos();
        $respuesta = false;
        $consulta = "DELETE FROM viaje WHERE idviaje= .$this->getIdViaje().";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }else{
                $respuesta = $this->setErrorOno($basedatos->getError());
            }
        }else{
            $respuesta = $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }

   //LUGARES DISPONIBLES
   public function disponibilidad(){
    $this->listarPasaj();
    $array = $this->getColecPasajeros();
    if(count($array) < $this->getVCantMaxPasajeros()){
        $sePuede = true;
    }else{
        $sePuede = false;
    }
    return $sePuede;
}
}