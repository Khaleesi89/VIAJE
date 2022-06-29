<?php 
require_once('BaseDeDatos.php');
require_once('Empresa.php');
require_once('Responsable.php');

class Viaje{
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
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
    public function listar(){
        $arregloviaje = null;
        $basedatos = new BaseDeDatos();
        $consultar = "SELECT * FROM viaje";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consultar)){
                $arregloviaje = array();
                while($row2=$basedatos->Registro()){
                    $idviaje = $row2['idviaje'];
                    $vdestino = $row2['vdestino'];
                    $vcantmaxpasajeros = $row2['vcantmaxpasajeros'];
                    $idempresa = $row2['idempresa'];
                    $rnumeroempleado = $row2['rnumeroempleado'];
                    $vimporte = $row2['vimporte'];
                    $tipoAsiento = $row2['tipoAsiento'];
                    $idayvuelta = $row2['idayvuelta'];
                    $coleccionPasajeros = $this->listarPasaj();
                    $viajess = new Viaje($idviaje, $vdestino, $vcantmaxpasajeros, $idempresa, $rnumeroempleado, $vimporte, $tipoAsiento, $idayvuelta,$coleccionPasajeros);
                    $arregloviaje[] = $viajess;
                }
            }	else{
                $this->setErrorOno($basedatos->getError());
            }
        }	else{
            $this->setErrorOno($basedatos->getError());

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
                while($row2=$basedatos->Registro()){
                    $rdocumento = $row2['rdocumento'];
                    $pnombre = $row2['pnombre'];
                    $papellido = $row2['papellido'];
                    $ptelefono = $row2['ptelefono'];
                    $idviaje = $row2['idviaje'];

                    $pasajero = new Pasajero($rdocumento,$pnombre,$papellido,$ptelefono,$idviaje);
                    $arreglo[] = $pasajero;
                }
            }	else{
                $this->setErrorOno($basedatos->getError());
            }
        }	else{
            $this->setErrorOno($basedatos->getError());
        }
        return $arreglo;
    }


    //BUSCAR VIAJE

    public function BuscarViaje($idViaje){
        $basedatos = new BaseDeDatos();
        $consulta = "SELECT * FROM viaje WHERE idviaje=".$idViaje;
        $respuesta = false;
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                if($row2=$basedatos->Registro()){
                    $this->setIdViaje($idViaje);
                    $this->setVDestino($row2['vdestino']);
                    $this->setVCantMaxPasajeros($row2['vcantmaxpasajeros']);
                    $this->setIdEmpresa($row2['idempresa']);
                    $this->setRNumeroEmpleado($row2['rnumeroempleado']);
                    $this->setVImporte($row2['vimporte']);
                    $this->setTipoAsiento($row2['tipoAsiento']);
                    $this->setIdaYVuelta($row2['idayvuelta']);
                    $this->setColecPasajeros($this->listarPasaj());
                    $respuesta = true;
                }
            }   else{
                $this->setErrorOno($basedatos->getError());
            }
        }   else{
            $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }


    //INSERTAR
    public function Insertar(){
        $basedatos = new BaseDeDatos();
        $respuesta = false;
        $consulta = "INSERT INTO viaje(idviaje,vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte,tipoAsiento,idayvuelta)
        VALUES (.$this->getIdViaje().,'.$this->getVDestino().',.$this->getVCantMaxPasajeros().,.$this->getIdEmpresa().,.$this->getRNumeroEmpleado().,.$this->getVImporte().,'.$this->getTipoAsiento().','.$this->getIdaYVuelta().')";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }	else{
                $this->setErrorOno($basedatos->getError());
            }
        } else{
            $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }

    //MODIFICAR
    public function Modificar(){
        $respuesta = false;
        $basedatos = new BaseDeDatos();
        $consulta = "UPDATE viaje SET vdestino='.$this->getVDestino().', 
        vcantmaxpasajeros=.$this->getVCantMaxPasajeros()., idempresa=.$this->getIdEmpresa()., 
        rnumeroempleado=.$this->getRNumeroEmpleado()., vimporte=.$this->getVImporte()., tipoAsiento='.$this->getTipoAsiento().', idayvuelta='.$this->getIdaYVuelta().' WHERE idviaje=.$this->getIdViaje().";
        if($basedatos->Iniciar()){
            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }   else{
                $this->setErrorOno($basedatos->getError());
            }
        }   else{
            $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }


    //ELIMINAR
    public function EliminarViaje(){
        $basedatos = new BaseDeDatos();
        $respuesta = false;
        if($basedatos->Iniciar()){
            $consulta = "DELETE FROM viaje WHERE idviaje= .$this->getIdViaje().";

            if($basedatos->Ejecutar($consulta)){
                $respuesta = true;
            }else{
                $this->setErrorOno($basedatos->getError());
            }
        }else{
            $this->setErrorOno($basedatos->getError());
        }
        return $respuesta;
    }


}