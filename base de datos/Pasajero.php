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
        $buscando = "SELECT * FROM pasajero WHERE rdocumento = $dni";
        $resultado = false;
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($buscando)) {
                if ($pasajero = $baseDeDatos->Registro()) {
                    $this->setRdocumento($dni);
                    $this->setPnombre($pasajero['pnombre']);
                    $this->setPapellido($pasajero['papellido']);
                    $this->setPtelefono($pasajero['ptelefono']);
                    $idViaje = $pasajero['idviaje'];
                    $objViaje = new Viaje();
                    if($objViaje->buscar($idViaje)){
                        $this->setObjViaje($objViaje);
                        $resultado = true;
                    }
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
        $resultado = null;
        $baseDatos = new BaseDeDatos();
		$consultaPasajero= " SELECT * FROM pasajero ";
		if($baseDatos->Iniciar()){
			if($baseDatos->Ejecutar($consultaPasajero)){
                $resultado = [];				
				while($pasajero=$baseDatos->Registro()){	
				    $documento = $pasajero['rdocumento'];
					$nombre = $pasajero['pnombre'];
					$apellido = $pasajero['papellido'];
					$telefono = $pasajero['ptelefono'];
                    $idViaje = $pasajero['idviaje'];
                    $objViaje = new Viaje();
                    if($objViaje->buscar($idViaje)){

                    }else{
                        $objViaje = null;
                    }
                    $viajero = new Pasajero();
					$viajero->cargar($nombre, $apellido, $documento, $telefono, $objViaje);
                    array_push($resultado, $viajero);
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
        $consulta ="INSERT INTO pasajero VALUES ({$this->getRdocumento()}, '{$this->getPnombre()}', '{$this->getPapellido()}', {$this->getPtelefono()}, $idviaje)";
         //"INSERT INTO pasajero (pdocumento, pnombre, papellido, ptelefono, idviaje) 
        //VALUES (".$this->getRdocumento().",".$this->getPnombre().",".$this->getPapellido().",".$this->getPtelefono().",".$this->getObjviaje()()->getIdViaje().")";
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
        $elimina = "DELETE FROM pasajero WHERE rdocumento = .$dni";
        if ($baseDeDatos ->Iniciar()) {
            if ($baseDeDatos ->Ejecutar($elimina)) {
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
        $modif = "UPDATE pasajero 
        SET 
        pnombre = '".$this->getPnombre()."', 
        papellido ='".$this->getPapellido()."', 
        ptelefono = ".$this->getPtelefono().", 
        idviaje = ".$this->getObjviaje()->getIdViaje()." WHERE pdocumento = ".$this->getRDocumento();
        //"UPDATE pasajero SET pnombre='.$this->getPNombre()', papellido='.$this->getPApellido().', 
        //ptelefono =.$this->getPTelefono()., idviaje= .$this->getIdViaje(). WHERE rdocumento=.$this->getRDocumento().";
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