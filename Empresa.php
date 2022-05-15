<?php


class Empresa{
    private $objViajesAereos = [];
    private $objViajesTerrestres= [];



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
}  














