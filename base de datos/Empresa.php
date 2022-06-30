<?php
require_once('BaseDeDatos.php');

class Empresa{
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $errorOno;


    public function __construct()
    {
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";
        
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($codigo){
        $this->idempresa = $codigo;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function setEnombre($nombre){
        $this->enombre = $nombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function setEdireccion($direccion){
        $this->edireccion = $direccion;
    }

    public function getErrorOno(){
        return $this->errorOno;
    }

    public function setErrorOno($errorOno){
        $this->errorOno = $errorOno;
    }

    public function __toString()
    {
        $info = "
        ID EMPRESA: {$this->getIdempresa()}
        NOMBRE: {$this->getEnombre()}
        DIRECCION: {$this->getEdireccion()}
        ";
        return $info;
    }


    //CARGAR VIAJE 

    public function cargar($identificacion, $nombre, $direccion){		
        $this->setIdempresa($identificacion);
        $this->setEnombre($nombre);
        $this->setEdireccion($direccion);
    }

    //BUSCAR EMPRESAS

    public function buscar($empresaCod) {
        $baseDeDatos = new BaseDeDatos();
        $buscando = "SELECT * FROM empresa WHERE idempresa = .$empresaCod";
        $resultado = false;
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($buscando)) {
                if ($empresa = $baseDeDatos->Registro()) {
                    $this->setIdEmpresa($empresaCod);
                    $this->setEnombre($empresa['enombre']);
                    $this->setEdireccion($empresa['edireccion']);
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


    //LISTAR EMPRESAS

    public function listar() {
        $respuesta = null;
        $baseDeDatos = new BaseDeDatos();
        $consulta = "SELECT * FROM empresa";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($consulta)) {				
                $respuesta = array();
                while ($empresa = $baseDeDatos->Registro()) {
                    $nuevaEmpresa = new Empresa();
                    $nuevaEmpresa->buscar($empresa["idempresa"]);
                    array_push($respuesta, $nuevaEmpresa);
                }
             } else {
                $respuesta = $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $respuesta = $this->setErrorOno($baseDeDatos->getError());
        }	
        return $respuesta;
    }


    //INSERTAR EMPRESA
    public function insertar() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = null;
        $insertar = "INSERT INTO empresa (enombre, edireccion) 
                            VALUES (".$this->getEnombre().",".$this->getEdireccion().")";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($insertar)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos->getError());	
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }


    //MODIFICAR EMPRESA
    public function modificar() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $modif = "UPDATE empresa SET enombre = ".$this->getEnombre().",
                                            edireccion = ".$this->getEdireccion()."
                                            WHERE idempresa = ". $this->getIdempresa();
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

    //ELIMINAR EMPRESA

    public function eliminar() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $eliminar = "DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
            if ($baseDeDatos ->Ejecutar($eliminar)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }

    public function eliminarViajes()   //ver bien como era la funcion en lo de joel
    {
        $listaviagem = $this->listar();
        foreach ($listaviagem as $viaje) {
            $listaPasaj = $viaje->listarPasaj();
            foreach ($listaPasaj as $pasajero) {
                $pasajero->eliminarPasajero();
            }
            $viaje->EliminarViaje();
        }
       
    }


    //sacar el nro de id

    public function idempresaIncremento(){
        $baseDeDatos = new BaseDeDatos();
        $respuesta = null;
        $consulta = "SELECT `AUTO_INCREMENT`
                    FROM  INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_SCHEMA = 'bdviajes'
                    AND   TABLE_NAME   = 'empresa';";
        if($baseDeDatos->Iniciar()){
            if($baseDeDatos->Ejecutar($consulta)){
                if($row2=$baseDeDatos->Registro()){
                    $respuesta = $row2['AUTO_INCREMENT'];
                }
            }   else {
                $respuesta = $this->setErrorOno($baseDeDatos->getError());
            }
        } else{
            $respuesta = $this->setErrorOno($baseDeDatos->getError());
        }
        return $respuesta;
    }
    
}