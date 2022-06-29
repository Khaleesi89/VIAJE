<?php
include_once "BaseDeDatos.php";

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

    //LISTAR RESPONSABLE

    public function listarResponsable(){
        $arrayResponsables = null;
        $baseDeDatos = new BaseDeDatos();
        $consulta = "SELECT * FROM responsable";
        $consulta .= " ORDER BY rapellido";       
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($consulta)) {				
                $arrayResponsables = array();
                while ($row2 = $baseDeDatos->Registro()) {
                    $nroEmpleado = $row2['rnumeroempleado'];
                    $nroLicencia = $row2['rnumerolicencia'];
                    $nombre = $row2['rnombre'];
                    $apellido = $row2['rapellido'];
                    $nuevoResponsable = new Responsable();
                    $nuevoResponsable->insertarResponsable($nroEmpleado, $nroLicencia,$nombre, $apellido);
                    array_push($arrayResponsables, $nuevoResponsable);
                }
             } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
             $this->setErrorOno($baseDeDatos->getError());
        }	
        return $arrayResponsables;
    }
    


    //INSERTAR RESPONSABLE
    public function insertarResponsable() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        $insertar = "INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido) 
                            VALUES ('".$this->getRnumeroempleado()."',
                                    '".$this->getRnumerolicencia()."',
                                    '".$this->getRnombre()."',
                                    '".$this->getRapellido()."')";
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

    //ELIMINAR RESPONSABLE

    public function eliminarResposable() {
        $baseDeDatos = new BaseDeDatos();
        $resultado = false;
        if ($baseDeDatos ->Iniciar()) {
            $delete = "DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado();
            if ($baseDeDatos ->Ejecutar($delete)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos ->getError());	
            }
        } else {
            $this->setErrorOno($baseDeDatos ->getError());
        }
        return $resultado;
    }

    //MODIFICAR RESPONSABLE

    public function modificarResponsable() {
        $resultado = false; 
        $baseDeDatos = new BaseDeDatos();
        $modificar = "UPDATE responsable SET rnumerolicencia = '".$this->getRnumerolicencia()."',rnombre = '".$this->getRnombre()."',rapellido ='".$this->getRapellido()."'WHERE rdocumento = ". $this->getRnumeroempleado();                                    
        if ($baseDeDatos->Iniciar()) {
            if ($baseDeDatos->Ejecutar($modificar)) {
                $resultado = true;
            } else {
                $this->setErrorOno($baseDeDatos->getError());
            }
        } else {
            $this->setErrorOno($baseDeDatos->getError());
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
                if ($row2 = $baseDeDatos->registro()) {
                    $this->setRnumeroEmpleado($dni);
                    $this->setRnumeroLicencia($row2['rnumerolicencia']);
                    $this->setRnombre($row2['rnombre']);
                    $this->setRapellido($row2['rapellido']);
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

}