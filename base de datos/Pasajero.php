<?php

require_once('BaseDeDatos.php');
require_once('Viaje.php');

class Pasajero{
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $objViaje; //idviaje;
    private $errorOno;


    public function __construct()
    {
        $this->rdocumento = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
        $this->objViaje = "";
        
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

    public function getObjviaje(){
        return $this->objViaje;
    }

    public function setObjviaje($codigoViaje){
        $this->objViaje = $codigoViaje;
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
        ID VIAJE: {$this->getObjviaje()}
        **************************
        ";
        return $info;
    }


    //CREO EL PASAJERO

    public function cargar($nombre, $apellido, $dni, $telefono,$objViaje) {		
        $this->setPnombre($nombre);
        $this->setPapellido($apellido);
        $this->setRdocumento($dni);
        $this->setPtelefono($telefono);
        $this->setObjViaje($objViaje);
    }

    //BUSCAR PASAJERO

    public function buscar($dni) {
        $baseDeDatos = new BaseDeDatos();
        $buscando = "SELECT * FROM pasajero WHERE rdocumento = ".$dni;
        $resultado = false;
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($buscando)) {
                if ($pasajero = $baseDeDatos->Registro()) {
                    $this->setRdocumento($dni);
                    $this->setPnombre($pasajero['pnombre']);
                    $this->setPapellido($pasajero['papellido']);
                    $this->setPtelefono($pasajero['ptelefono']);
                    $objViaje = new Viaje();
                    $objViaje->buscar($pasajero['idviaje']);
                    $this->setObjViaje($objViaje);
                    $resultado = true;
                }
               
            } else {
                $resultado = $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }


    //LISTAR PASAJEROS


    public function listar(){
	
        $baseDatos = new BaseDeDatos();
		$consultaPasajero="SELECT * FROM pasajero ";
        $consultaPasajero .=  "ORDER BY papellido";
		if($baseDatos->Iniciar()){
			if($baseDatos->Ejecutar($consultaPasajero)){
                $resultado = [];				
				while($pasajero=$baseDatos->Registro()){	
				    $documento = $pasajero['rdocumento'];
					$nombre = $pasajero['pnombre'];
					$apellido = $pasajero['papellido'];
					$telefono = $pasajero['ptelefono'];
					$objPasajero = new Pasajero();
                    $objViaje = new Viaje();
                    $objViaje->buscar($pasajero['idviaje']);
					$objPasajero->cargar($nombre, $apellido, $documento, $telefono, $objViaje);
                    array_push($resultado, $objPasajero);
				}
		 	}else{
                $resultado =$this->setErrorOno($baseDatos->getError());
                
			}
		 }else{
                $resultado =$this->setErrorOno($baseDatos->getError());
                
		 }		
		 return $resultado;
	}

      
    //INSERTAR PASAJEROS
    public function insertar() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $consulta = "INSERT INTO pasajero (pdocumento, pnombre, papellido, ptelefono, idviaje) 
        VALUES (".$this->getRdocumento().",".$this->getPnombre().",".$this->getPapellido().",".$this->getPtelefono().",".$this->getObjviaje()()->getIdViaje().")";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos->getError());	
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }

    //ELIMINAR PASAJEROS

    public function eliminar($dni) {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $dni = "DELETE FROM pasajero WHERE rdocumento = ".$this->getRdocumento();
            if ($baseDeDatos ->Ejecutar($dni)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }

    //MODIFICAR PASAJERO

    public function modificar() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $modif = "UPDATE pasajero SET pnombre='.$this->getPNombre()', papellido='.$this->getPApellido().', 
        ptelefono =.$this->getPTelefono()., idviaje= .$this->getIdViaje(). WHERE rdocumento=.$this->getRDocumento().";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($modif)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
             $resultado = $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }
}