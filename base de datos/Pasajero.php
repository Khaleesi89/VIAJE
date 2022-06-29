<?php

require_once('BaseDeDatos.php');
require_once('Viaje.php');

class Pasajero{
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $idviaje;
    private $errorOno;


    public function __construct()
    {
        $this->rdocumento = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
        
    }




    public function getRdocumento(){
        return $this->rdocumento;
    }

    public function setRdocumento($documento){
        $this->rdocumento = $documento;
    }

    public function getPnombre(){
        return $this->pnombre;
    }

    public function setPnombre($nombre){
        $this->pnombre = $nombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }

    public function setPapellido($apellido){
        $this->papellido = $apellido;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }

    public function setPtelefono($telefono){
        $this->ptelefono = $telefono;
    }

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($codigoViaje){
        $this->idviaje = $codigoViaje;
    }

    public function getErrorOno(){
        return $this->errorOno;
    }

    public function setErrorOno($errorOno){
        $this->errorOno = $errorOno;
    }

    public function __toString()
    {
        $info="
        **************************
        DOCUMENTO: {$this->getRdocumento()}
        NOMBRE: {$this->getPnombre()}
        APELLIDO: {$this->getPapellido()}
        TELEFONO: {$this->getPtelefono()}
        ID VIAJE: {$this->getIdviaje()}
        **************************
        ";
        return $info;
    }


    //CREO EL PASAJERO

    public function pasajeroCrear($nombre, $apellido, $dni, $telefono) {		
        $this->setPnombre($nombre);
        $this->setPapellido($apellido);
        $this->setRdocumento($dni);
        $this->setPtelefono($telefono);
    }

    //BUSCAR PASAJERO

    public function buscar($dni) {
        $baseDeDatos = new BaseDeDatos();
        $buscando = "SELECT * FROM pasajero WHERE rdocumento = ".$dni;
        $resultado = false;
        if ($baseDeDatos->iniciar()) {
            if ($baseDeDatos->ejecutar($buscando)) {
                if ($row2 = $baseDeDatos->registro()) {
                    $this->setRdocumento($dni);
                    $this->setPnombre($row2['pnombre']);
                    $this->setPapellido($row2['papellido']);
                    $this->setPtelefono($row2['ptelefono']);
                    $this->setIdViaje($row2['idviaje']);
                    $resultado = true;
                }
            } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }


    //LISTAR PASAJEROS

    public function listarPasajeros($condicion = ""){
        $arrayPasajeros = null;
        $baseDeDatos = new BaseDeDatos();
        $consultar = "SELECT * FROM pasajero";
        if ($condicion != "") {
            $consultar.=" WHERE ".$condicion;
        }
        $consultar .=  "ORDER BY papellido";
        
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($consultar)) {				
                $arrayPasajeros = array();
                while ($row2 = $baseDeDatos->Registro()) {
                    $dni = $row2['rdocumento'];
                    $nombre = $row2['pnombre'];
                    $apellido = $row2['papellido'];
                    $telefono = $row2['ptelefono'];
                    $idViaje = $row2['idviaje'];
                    $nuevoPasajero = new Pasajero();
                    $nuevoPasajero->insertarPasajero($dni, $nombre, $apellido, $telefono, $idViaje);
                    $arreglo[] = $nuevoPasajero;
                }
             } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
             $this->setErrorOno($baseDeDatos->getError());
        }	
        return $arrayPasajeros;
    }

    //INSERTAR PASAJEROS
    public function insertarPasajero() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $insertar = "INSERT INTO pasajero(pnombre, papellido, rdocumento, ptelefono) 
                            VALUES ('".$this->getPnombre()."','".$this->getPapellido()."','".$this->getRdocumento()."','".$this->getPtelefono()."')";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($insertar)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos->getError());	
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }

    //ELIMINAR PASAJEROS

    public function eliminarPasajero($dni) {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $dni = "DELETE FROM pasajero WHERE rdocumento = ".$this->getRdocumento();
            if ($baseDeDatos ->Ejecutar($dni)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }

    //MODIFICAR PASAJERO

    public function modificarPasajero() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $update = "UPDATE pasajero SET pnombre='.$this->getPNombre()', papellido='.$this->getPApellido().', 
        ptelefono=.$this->getPTelefono()., idviaje= .$this->getIdViaje(). WHERE rdocumento=.$this->getRDocumento().";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($update)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }
}