<?php

include_once "BaseDeDatos.php";

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
        DOCUMENTO: {$this->getRdocumento()}
        NOMBRE: {$this->getPnombre()}
        APELLIDO: {$this->getPapellido()}
        TELEFONO: {$this->getPtelefono()}
        ID VIAJE: {$this->getIdviaje()}
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
                    $this->setPapellido($row2['rdocumento']);
                    $this->setPtelefono($row2['ptelefono']);
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

    //INSERTAR PASAJEROS
    public function insertarPasajero() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $insertar = "INSERT INTO pasajero(pnombre, papellido, rdocumento, ptelefono) 
                            VALUES ('".$this->getPnombre()."',
                                    '".$this->getPapellido()."',
                                    '".$this->getRdocumento()."',
                                    '".$this->getPtelefono()."')";
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
        $update = "UPDATE pasajero SET pnombre = '".$this->getPnombre()."',
                                            papellido = '".$this->getPapellido()."',
                                            ptelefono = '".$this->getPtelefono()."' 
                                            WHERE rdocumento = ". $this->getRdocumento();
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