<?php
require_once('BaseDeDatos.php');

class Responsable{
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $errorOno;


    public function __construct()
    {
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }




    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($id){
        $this->rnumeroempleado = $id;
    }

    public function getRnumerolicencia(){
        return $this->rnumerolicencia;
    }

    public function setRnumerolicencia($licencia){
        $this->rnumerolicencia = $licencia;
    }

    public function getRnombre(){
        return $this->rnombre;
    }

    public function setRnombre($nombre){
        $this->rnombre = $nombre;
    }

    public function getRapellido(){
        return $this->rapellido;
    }

    public function setRapellido($apellido){
        $this->rapellido = $apellido;
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
        NUMERO EMPLEADO: {$this->getRnumeroempleado()}
        NUMERO LICENCIA:  {$this->getRnumerolicencia()}
        NOMBRE:  {$this->getRnombre()}
        APELLIDO:  {$this->getRapellido()}
        ";
        return $info;
    }


    //CARGAR RESPONSABLE
    public function cargar($nombre, $apellido, $numLicencia, $numEmpleado){		
        $this->setRnombre($nombre);
        $this->setRapellido($apellido);
        $this->setRnumerolicencia($numLicencia);
        $this->setRnumeroempleado($numEmpleado);
    }

    //LISTAR RESPONSABLE

    public function listar(){
        $arrayResponsables = null;
        $baseDeDatos = new BaseDeDatos();
        $consulta = "SELECT * FROM responsable ";      
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($consulta)) {				
                $arrayResponsables = array();
                while ($responsable = $baseDeDatos->Registro()) {
                    $nroEmpleado = $responsable['rnumeroempleado'];
                    $nroLicencia = $responsable['rnumerolicencia'];
                    $nombre = $responsable['rnombre'];
                    $apellido = $responsable['rapellido'];
                    $nuevoResponsable = new Responsable();
                    $nuevoResponsable->insertar($nroEmpleado, $nroLicencia,$nombre, $apellido);
                    array_push($arrayResponsables, $nuevoResponsable);
                }
             } else {
                $arrayResponsables = $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $arrayResponsables = $this->setErrorOno($baseDeDatos->getError());
        }	
        return $arrayResponsables;
    }
    


    //INSERTAR RESPONSABLE
    public function insertar() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $insertar = "INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido) 
                            VALUES (".$this->getRnumerolicencia().",
                                    ".$this->getRnombre().",
                                    ".$this->getRapellido().")";
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

    //ELIMINAR RESPONSABLE

    public function eliminar() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $delete = "DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado();
            if ($baseDeDatos ->Ejecutar($delete)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }

    //MODIFICAR RESPONSABLE

    public function modificar() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $modificar = "UPDATE responsable SET rnumerolicencia = '".$this->getRnumerolicencia()."',rnombre = '".$this->getRnombre()."',rapellido ='".$this->getRapellido()."'WHERE rdocumento = ". $this->getRnumeroempleado();                                    
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($modificar)) {
                $resultado = true;
            } else {
                $resultado = $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $resultado = $this->setErrorOno($baseDeDatos->getError());
        }
        return $resultado;
    }
    

    //BUSCAR RESPONSABLE
    

    public function buscar($dni) {
        $baseDeDatos = new BaseDeDatos();
        $buscando = "SELECT * FROM responsable WHERE rdocumento = ".$dni;
        $resultado = false;
        if ($baseDeDatos->iniciar()) {
            if ($baseDeDatos->ejecutar($buscando)) {
                if ($responsable = $baseDeDatos->registro()) {
                    $this->setRnumeroEmpleado($dni);
                    $this->setRnumeroLicencia($responsable['rnumerolicencia']);
                    $this->setRnombre($responsable['rnombre']);
                    $this->setRapellido($responsable['rapellido']);
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


    //SACAR EL ID DE RESPONSABLE

    public function idResponsablencremento(){
        $baseDeDatos = new BaseDeDatos();
        $respuesta = null;
        $consulta = "SELECT `AUTO_INCREMENT`
                    FROM  INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_SCHEMA = 'bdviajes'
                    AND   TABLE_NAME   = 'responsable';";
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
}