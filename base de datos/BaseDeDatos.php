<?php

class BaseDeDatos{
    private $hostname;
    private $basedatos;
    private $usuario;
    private $clave;
    private $conexion;
    private $query;
    private $result;
    private $error;


    public function __construct(){
        $this->hostname = "localhost";
        $this->basedatos = "bdviajes";
        $this->usuario = "root";
        $this->clave="";
        $this->result=0;
        $this->query="";
        $this->error="";
    }

    

    public function getHostname(){
        return $this->hostname;
    }

    public function setHostname($BDhostname){
        $this->hostname = $BDhostname;
    }

    public function getBasedatos(){
        return $this->basedatos;
    }

    public function setBasedatos($BDbasedatos){
        $this->basedatos = $BDbasedatos;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($BDusuario){
        $this->usuario = $BDusuario;
    }

    public function getClave(){
        return $this->clave;
    }

    public function setClave($BDclave){
        $this->clave = $BDclave;
    }

    public function getConexion(){
        return $this->conexion;
    }

    public function setConexion($BDconexion){
        $this->conexion = $BDconexion;
    }

    public function getQuery(){
        return $this->query;
    }

    public function setQuery($BDquery){
        $this->query = $BDquery;
    }

    public function getResult(){
        return $this->result;
    }

    public function setResult($BDresult){
        $this->result = $BDresult;
    }

    public function getError(){
        return $this->error;
    }

    public function setError($codigoError){
        $this->error = $codigoError;
    }



    //FUNCION PARA RETORNAR EL ERRO

    public function error(){
        $error = $this->getError();
        return $error;
    }

    //INICIA LA CONEXION AL SERVIDOR y NOS RETORNA SI SE PUDO O NO HACER

    public function Inicio(){
        $conecta = false;
        $conexion = mysqli_connect($this->getHostname(),$this->getUsuario(),$this->getClave(), $this->getBasedatos());
        //esto retorna true si puede realizar la conexion
        if($conexion){
            if(mysqli_select_db($conexion, $this->getBasedatos())){
                $this->setConexion($conexion);
                unset($this->getQuery());
                unset($this->getError());
                $conecta = true;

            } else{
                $errores = mysqli_errno($conexion) . ": " .mysqli_error($conexion);
                $this->setError($errores);
            }
        }
        return $conecta;
        
    }

    //EFECTUA LA CONSULTA DE ACUERDO AL PARAMENTRO QUE INGRESA

    public function EjecutaConsulta ($consulta){
        $salida = false;
        unset($this->getError());
        $this->setQuery($consulta);
        if($this->getResult() = mysqli_query($this->getConexion(),$consulta)){
            $salida = true;
        } else{
            $error = mysqli_errno($this->getConexion). ":". mysqli_error( $this->getConexion); 
            $this->setError($error);
        }
        return $salida;
    }


    


}