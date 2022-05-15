<?php


class Empresa{
    private $objViajesAereos = [];
    private $objViajesTerrestres= [];
    private $arrayDeViajes= [];



    public function __construct($arrayViajesAereos,$arrayViajesTerrestres){
        $this->objViajesAereos = $arrayViajesAereos;
        $this->objViajesTerrestres = $arrayViajesTerrestres;
        
    }
    
    public function getObjViajesAereos(){
        return $this->objViajesAereos;
    }

    public function setObjViajesAereos($arrayViajesAereos){
        $this->objViajesAereos = $arrayViajesAereos;
    }

    public function getObjViajesTerrestres(){
        return $this->objViajesTerrestres;
    }

    public function setObjViajesTerrestres($arrayViajesTerrestres){
        $this->objViajesTerrestres = $arrayViajesTerrestres;
    }

    public function getArrayDeViajes(){
        return $this->arrayDeViajes;
    }

    public function setArrayDeViajes($coleccArraysViajesTotales){
        $this->arrayDeViajes = $coleccArraysViajesTotales;
    }

    //FUNCION PARA MOSTRAR LOS VIAJES

    private function mostrarViajesAereos(){
        $viajecitos=[];
        $viajecitos=$this->getObjViajesAereos();
        $stringViajesAereos="";
        for ($i=0; $i < count($viajecitos) ; $i++) { 
            $stringViajesAereos.=$viajecitos[$i];
        }
        return $stringViajesAereos;
    }
        
    private function mostrarViajesTerrestres(){
        $viajecitos=[];
        $viajecitos=$this->getObjViajesTerrestres();
        $stringViajesTerrestres="";
        for ($i=0; $i < count($viajecitos) ; $i++) { 
            $stringViajesTerrestres.=$viajecitos[$i];
        }
        return $stringViajesTerrestres;
    }
        

    public function __toString(){
        $arrayAereos = $this->mostrarViajesAereos();
        $arrayTerrestres = $this->mostrarViajesTerrestres();
        $info = "
        ***************************
        Viajes AEREOS
        ***************************
        $arrayAereos \n
        ***************************
        Viajes TERRESTRES
        ***************************
        $arrayTerrestres 
        ";
        return $info;
    }


    //AGREGAR VIAJE AL ARRAY DE VIAJES SEGUN SU TIPO //

    public function agregarViajeAlArrayViajes($objViajeSegunTipo){
        $clase = get_class($objViajeSegunTipo);
        if ($clase == "Aereos"){
            $totalAereos = $this->getObjViajesAereos();
            array_push($totalAereos,$objViajeSegunTipo);
            $this->setObjViajesAereos($totalAereos);
        }elseif($clase == "Terrestres"){
            $totalTerrestres = $this->getObjViajesTerrestres();
            array_push($totalTerrestres,$objViajeSegunTipo);
            $this->setObjViajesAereos($totalTerrestres);

        }
    }


    //UNIFICAR VIAJES //

    private function unionColeccion(){
        $aereos = $this->getObjViajesAereos();
        $terrestres =  $this->getObjViajesTerrestres;
        $arrayCompleto = array_merge($aereos,$terrestres);
        $this->setArrayDeViajes($arrayCompleto);
    }
    


    //BUSCAR VIAJES

    public function buscarViaje($nroViajeAbuscar){
        $coleccComplta = $this->getArrayDeViajes();
        $i=0;
        $cantidad = count($coleccComplta);
        $salida = true;
        $encontrado = null;
        while($i<$cantidad && $salida){
            $viajesss = $coleccComplta[$i];
            $codigo = $viajesss->getCodigoViaje();
            if($nroViajeAbuscar == $codigo){
                $encontrado = $coleccComplta[$i];
                $salida = false;
            }
            $i++;
        }
        return $encontrado;
    }

    
}  














