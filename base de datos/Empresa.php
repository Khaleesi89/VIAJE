<?php

class Empresa{
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $errorOno;


    public function __construct()
    {
        $this->idempresa = 0;
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

    //BUSCAR

    public function buscar($empresaCod) {
        $baseDeDatos = new BaseDeDatos();
        $buscando = "SELECT * FROM empresa WHERE idempresa = ".$empresaCod;
        $resultado = false;

        if ($baseDeDatos->iniciar()) {
            if ($baseDeDatos->ejecutar($buscando)) {
                if ($row2 = $baseDeDatos->registro()) {
                    $this->setIdEmpresa($empresaCod);
                    $this->setEnombre($row2['enombre']);
                    $this->setEdireccion($row2['edireccion']);
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


    //LISTAR EMPRESAS

    

    //INSERTAR EMPRESA
    public function insertarEmpresa() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $insertar = "INSERT INTO empresa(idempresa, enombre, edireccion) 
                            VALUES ('".$this->getIdempresa()."',
                                    '".$this->getEnombre()."',
                                    '".$this->getEdireccion()."')";
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($insertar)) {
                $resp = true;
            } else {
                $this->setErrorOno($baseDeDatos->getError());	
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }


    //MODIFICAR EMPRESA
    public function modificarEmpresa() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $update = "UPDATE pasajero SET enombre = '".$this->getEnombre()."',
                                            edireccion = '".$this->getEdireccion()."'
                                            WHERE idempresa = ". $this->getIdempresa();
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($update)) {
                $resp = true;
            } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }

    //ELIMINAR EMPRESA

    public function eliminarEmpresa() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $eliminar = "DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
            if ($baseDeDatos ->Ejecutar($eliminar)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }



    
}