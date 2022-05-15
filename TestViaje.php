<?php

include "Viaje.php";
include "ResponsableV.php";
include "Pasajero.php";
include "Aereos.php";
include "Terrestres.php";
include "Empresa.php";

echo "--------- Viaje Feliz ----------\n";

// EJECUTAMOS EL PROGRAMA //

// MENU PRINCIPAL //

echo "Desea usar un viaje anterior?: S o N \n";
$aswer = strtoupper(trim (fgets(STDIN)));
if( $aswer == "S"){
    $objRespViaje = new ResponsableV(2, 3211123, 'Florencio', 'Golberg');
    $objRespViaje2 = new ResponsableV(3, 122221, 'Roberto', 'Klimisch');
    $aereo = new Aereos (1,'Traful',30,12, $objRespViaje, "Air232","PC","Aerolineas Argentinas",0,12222,"IyV");
    agregarViaje($aereo);
    $aereo2 = new Aereos (2,'Barcelona',150,120, $objRespViaje, "FlixAir2","PC","Latam",4,144432,"I");
    agregarViaje($aereo2);
    $tierra1 = new Terrestres(3,"NYC",50,25,$objRespViaje2,"CAMA",1232,"IyV");
    agregarViaje($tierra1);
    $tierra2 = new Terrestres(4,"NYC",80,34,$objRespViaje2,"SEMICAMA",12222,"I"); 
    agregarViaje($tierra2);
    //$objViaje = new Viaje(23,'Traful',30,12, $objRespViaje, 34443,"ida");
    $objPasajero1 = new Pasajero('Maria', 'Kalauz', 34444332, 299443232);
    $objPasajero2 = new Pasajero('Francisco', 'Klimisch', 1222112, 2994896552);
    $objPasajero3 = new Pasajero('Dominga', 'Cena', 456333, 2984426082);
    $objPasajero4 = new Pasajero('León', 'Kischinovsky', 12221, 2984406511);
    $aereo->agregarPasajero($objPasajero1);
    $aereo2->agregarPasajero($objPasajero2);
    $tierra1->agregarPasajero($objPasajero3);
    $tierra2->agregarPasajero($objPasajero4);
    //$empresa1 = new Empresa($aereo,$tierra1); 
    //echo $empresa1;
    //$empresa2 = new Empresa($aereo2,$tierra2);

    echo menu();
    $viagiando= trim(fgets(STDIN));
        switch ($viagiando){
            
                    case '1':
                            // 1) Cargar un viaje 
                            echo "Ingrese los datos correspondientes al viaje \n";
                            echo "Ingrese el codigo del viaje: \n";
                            $viajeCodigo= strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el destino: \n";
                            $lugarDestino= strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese la cantidad máxima de asientos: \n";
                            $maxAsientos = trim (fgets(STDIN));
                            echo "Ingrese la cantidad de asientos ocupados: \n";
                            $asientosOcup = trim (fgets(STDIN));
                            echo "Ingrese los datos del Responsable del viaje: \n ";
                            $responsableViaje = crearResponsable();
                            echo "Ingrese que tipo de viaje es: AEREO -> 1 ||| TERRESTRE -> 2 ";
                            $elex = trim (fgets(STDIN));
                            if($elex == 1){
                                echo "Ingrese el nro de vuelo: \n";
                                $nroVuelo = trim (fgets(STDIN));
                                echo "Ingrese la categoria de asiento: (PRIMERA CLASE -> PC || STANDARD -> S \n";
                                $categoriaAsiento =  strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el nombre de la aerolinea: \n";
                                $aerolinea = strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el nro de escalas: \n";
                                $cantEscalas = trim (fgets(STDIN));
                                echo "Ingrese el valor del vuelo: \n";
                                $importe = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $idaOvuelta = trim (fgets(STDIN));
                                $objAereo = new Aereos($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$nroVuelo,$categoriaAsiento,$aerolinea,$cantEscalas,$importe,$idaOvuelta);
                                agregarViaje($objAereo);
                                echo "Ingrese los datos de los pasajeros: \n";
                            do{
                                $continuacion=false;
                                $persona=[];
                                $persona=infoPasajero();
                                $objAereo->agregarPasajero($persona);
                                echo "Desea agregar un nuevo pasajero?: S o N \n";
                                $seguimos=strtoupper(trim(fgets(STDIN)));
                                if($seguimos=="S"){
                                    $continuacion= true;
                                }
                            }while($continuacion);
                            }
                             if($elex == 2){
                                echo "Ingrese la categoria de asiento: (CAMA || SEMICAMA \n";
                                $comodidadAsiento =  strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el valor del vuelo: \n";
                                $valorPasaje = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $tipoDeTrayecto = trim (fgets(STDIN));
                                $terrestre = new Terrestres($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$comodidadAsiento,$valorPasaje, $tipoDeTrayecto);
                                agregarViaje($terrestre);
                                echo "Ingrese los datos de los pasajeros: \n";
                            do{
                                $continuacion=false;
                                $persona=[];
                                $persona=infoPasajero();
                                $terrestre->agregarPasajero($persona);
                                echo "Desea agregar un nuevo pasajero?: S o N \n";
                                $seguimos=strtoupper(trim(fgets(STDIN)));
                                if($seguimos=="S"){
                                    $continuacion= true;
                                }
                            }while($continuacion);
                            }                   
                            
                    break;

                    case '2':
                            // 2) Modificar un viaje
                            echo "Ingrese el codigo de viaje que desea modificar: \n";
                            $nroModificar = trim(fgets(STDIN));
                            $objViaje2 = $objEmpresa->buscarViaje($nroModificar);
                            echo modificacionDatos($objViaje2);
                            break;                           

                    case '3':
                            // 3) Ver datos de un viaje
                            echo "Ingrese el codigo de viaje que desea ver: \n";
                            $nroViagem = trim(fgets(STDIN));
                            $objViaje = $objEmpresa->buscarViaje($nroViagem);
                            echo $objViaje;
                            break;

                    default:
                            $finish= false;
                            break;
        };
    

}else{
    $finish=true;
    do{
        echo menu();
        $viagiando= trim(fgets(STDIN));
        switch ($viagiando){
            
                    case '1':
                            // 1) Cargar un viaje 
                            echo "Ingrese los datos correspondientes al viaje \n";
                            echo "Ingrese el codigo del viaje: \n";
                            $viajeCodigo= strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el destino: \n";
                            $lugarDestino= strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese la cantidad máxima de asientos: \n";
                            $maxAsientos = trim (fgets(STDIN));
                            echo "Ingrese la cantidad de asientos ocupados: \n";
                            $asientosOcup = trim (fgets(STDIN));
                            echo "Ingrese los datos del Responsable del viaje: \n ";
                            $responsableViaje = crearResponsable();
                            echo "Ingrese que tipo de viaje es: AEREO -> 1 ||| TERRESTRE -> 2 ";
                            $elex = trim (fgets(STDIN));
                            if($elex == 1){
                                echo "Ingrese el nro de vuelo: \n";
                                $nroVuelo = trim (fgets(STDIN));
                                echo "Ingrese la categoria de asiento: (PRIMERA CLASE -> PC || STANDARD -> S \n";
                                $categoriaAsiento =  strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el nombre de la aerolinea: \n";
                                $aerolinea = strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el nro de escalas: \n";
                                $cantEscalas = trim (fgets(STDIN));
                                echo "Ingrese el valor del vuelo: \n";
                                $importe = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $idaOvuelta = trim (fgets(STDIN));
                                $objAereo = new Aereos($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$nroVuelo,$categoriaAsiento,$aerolinea,$cantEscalas,$importe,$idaOvuelta);
                                agregarViaje($objAereo);
                                echo "Ingrese los datos de los pasajeros: \n";
                            do{
                                $continuacion=false;
                                $persona=[];
                                $persona=infoPasajero();
                                $objAereo->agregarPasajero($persona);
                                echo "Desea agregar un nuevo pasajero?: S o N \n";
                                $seguimos=strtoupper(trim(fgets(STDIN)));
                                if($seguimos=="S"){
                                    $continuacion= true;
                                }
                            }while($continuacion);
                                
                            }
                             if($elex == 2){
                                echo "Ingrese la categoria de asiento: (CAMA || SEMICAMA \n";
                                $comodidadAsiento =  strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el valor del vuelo: \n";
                                $valorPasaje = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $tipoDeTrayecto = trim (fgets(STDIN));
                                $terrestre = new Terrestres($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$comodidadAsiento,$valorPasaje, $tipoDeTrayecto);
                                agregarViaje($terrestre);
                                echo "Ingrese los datos de los pasajeros: \n";
                            do{
                                $continuacion=false;
                                $persona=[];
                                $persona=infoPasajero();
                                $terrestre->agregarPasajero($persona);
                                echo "Desea agregar un nuevo pasajero?: S o N \n";
                                $seguimos=strtoupper(trim(fgets(STDIN)));
                                if($seguimos=="S"){
                                    $continuacion= true;
                                }
                            }while($continuacion);
                            }                   
    
                    break;

                    case '2':
                            // 2) Modificar un viaje
                            echo "Ingrese el codigo de viaje que desea modificar: \n";
                            $nroModificar = trim(fgets(STDIN));
                            $objViaje2 = $objEmpresa->buscarViaje($nroModificar);
                            echo modificacionDatos($objViaje2);
                    break;                           

                    case '3':
                            // 3) Ver datos de un viaje
                            echo "Ingrese el codigo de viaje que desea ver: \n";
                            $nroViagem = trim(fgets(STDIN));
                            $objViaje = $objEmpresa->buscarViaje($nroViagem);
                            echo $objViaje;
                    break;

                    default:
                            $finish= false;
                    break;
        };
    }while($finish);
}

/// PARA AGREGAR PASAJERO ////

    function infoPasajero(){
        
            
            echo "Ingrese apellido: \n";
            $apellido= strtoupper(trim (fgets(STDIN)));
            echo "Ingrese nombre: \n";
            $nombre= strtoupper(trim (fgets(STDIN)));
            echo "Ingrese DNI: \n";
            $dni= trim (fgets(STDIN));
            echo "Ingrese telefono celular: \n";
            $telefono= trim (fgets(STDIN));
            $pasajero = new Pasajero($nombre,$apellido,$dni,$telefono);         
            return $pasajero;
    }

//// MENU PARA EL PUNTO 2 DEL MENU PRINCIPAL ////

    function menuPunto2(){
            return $menu = "Elija la opción deseada: \n.
            1- Desea cambiar el código del viaje? \n.
            2- Desea cambiar el destino? \n.
            3- Desea cambiar la cantidad de pasajeros que viajaron?\n.
            4- Desea cambiar los datos de un pasajero?\n.
            5- Desea cambiar la capacidad máxima de la movilidad?\n.
            6- Ver viaje \n.
            7- Salir \n.";

    }


//// MENU PRINCIIPAL ////

    function menu(){
            $menu= "Ingrese una opción:\n\n
            1) Cargar un viaje \n
            2) Modificar un viaje \n
            3) Ver datos de un viaje \n
            4) Salir\n";            
            
    return $menu;
    }


//// FUNCION PARA MODIFICAR DATOS ////

/**
 * @param obj $objeto
 * @return void
 */

function modificacionDatos($objeto){

        do{
            $salida=true;
            echo menuPunto2();
            $eleccion2= trim (fgets(STDIN));

            switch ($eleccion2){
                case '1':
                    // Desea cambiar el código del viaje? //
                    echo "Ingrese el nuevo código: \n";
                    $newCod= strtoupper(trim (fgets(STDIN)));
                    $objeto->setCodigoViaje($newCod);
                break;
                    
                case '2':
                    // Desea cambiar el destino?  //
                    echo "Ingrese el nuevo destino: \n";
                    $newDestino= strtoupper(trim (fgets(STDIN)));
                    $objeto->setDestino($newDestino);
                break;

                case '3':
                        // Desea cambiar la cantidad de pasajeros que viajaron?  //
                        echo "Ingrese la nueva cantidad de pasajeros que viajaron: \n";
                        $modCantPasajeros =trim (fgets(STDIN));
                        $objeto->setCantPasajerosViaje($modCantPasajeros);
                break;
                
                case '4':
                    // Desea cambiar los datos de un pasajero?  //
                    $pasajeros = $objeto->getColeccObjPasajero();
                    $nuevoArrayObjPasajeros = datosNuevosPasajero($pasajeros);
                    $objeto->setColeccObjPasajero($nuevoArrayObjPasajeros);
                break;
            
                case '5':
                    // Desea cambiar la capacidad máxima de pasajeros   //
                        
                    echo "Ingrese el nuevo valor para la capacidad máxima: \n";
                    $capacidadNew=trim (fgets(STDIN));
                    $objeto->setCantMaxPasajeros($capacidadNew);
                break;

                case '6':
                    //Ver viaje //
                    echo $objeto;
                break;
            
                default:
                    // Salir  //
                    $salida=false;
                break;
            }

        }while($salida);
}



//CREAR RESPONSABLE
    function crearResponsable(){
        echo "Ingrese el numero del empleado: ";
        $numero = trim(fgets(STDIN));
        echo "Ingrese el numero de licencia del empleado: ";
        $licencia = trim(fgets(STDIN));
        echo "Ingrese el nombre del empleado: ";
        $nombreResp = strtoupper(trim(fgets(STDIN)));
        echo "Ingrese el apellido del empleado: ";
        $apellidoResp = strtoupper(trim(fgets(STDIN)));
        $objResponsable = new ResponsableV($numero, $licencia,$nombreResp,$apellidoResp);
        return $objResponsable;
    }


    //CARGAR DATOS PARA CAMBIAR EL PASAJERO
    /**
     * @param obj $objPasajeros
     * return 
     */

    function datosNuevosPasajero($objPasajeros){
  
         echo "Ingrese el numero de DNI del pasajero a modificar: ";
         $nroDocume = trim (fgets(STDIN));
         echo "Ingrese el nombre del pasajero: ";
         $nombreNuevo = strtoupper(trim (fgets(STDIN)));
         echo "Ingrese el apellido del pasajero: ";
         $apellidoNuevo = strtoupper(trim (fgets(STDIN)));
         echo "Ingrese el numero de telefono/celular del pasajero: ";
         $nroTelNuevo = trim (fgets(STDIN));
         $cambio = $objPasajeros->modificarViajeros($nombreNuevo,$apellidoNuevo, $nroDocume,$nroTelNuevo);
        return $cambio;
    }


    //FUNCION PARA AGREGAR ARRAY EN EMPRESA SEGUN EL TIPO DE CLASE QUE SEA

    function agregarViaje($objDeAlgunTipo){
        $arrayInicialAereo = [];
        $arrayInicialTerrestre = [];
        $objEmpresa = new Empresa($arrayInicialAereo,$arrayInicialTerrestre);
        $objEmpresa->agregarViajeAlArrayViajes($objDeAlgunTipo);
        //$objEmpresa->unionColeccion();
        return $objEmpresa;
    }
