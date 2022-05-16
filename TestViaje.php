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
    $empresa1 = new Empresa();
    $objRespViaje = new ResponsableV(2, 3211123, 'Florencio', 'Golberg');
    $objRespViaje2 = new ResponsableV(3, 122221, 'Roberto', 'Klimisch');
    $aereo = new Aereos (1,'Traful',30,12, $objRespViaje, "Air232","PC","Aerolineas Argentinas",0,12222,"IyV");
    $empresa1->agregarViajeAlArrayViajes($aereo);
    $aereo2 = new Aereos (2,'Barcelona',150,120, $objRespViaje, "FlixAir2","PC","Latam",4,144432,"I");
    $empresa1->agregarViajeAlArrayViajes($aereo2);
    $tierra1 = new Terrestres(3,"NYC",50,25,$objRespViaje2,"CAMA",1232,"IyV");
    $empresa1->agregarViajeAlArrayViajes($tierra1);
    $tierra2 = new Terrestres(4,"NYC",80,34,$objRespViaje2,"SEMICAMA",12222,"I"); 
    $empresa1->agregarViajeAlArrayViajes($tierra2);
    $objPasajero1 = new Pasajero('Maria', 'Kalauz', 34444332, 299443232);
    $objPasajero2 = new Pasajero('Francisco', 'Klimisch', 1222112, 2994896552);
    $objPasajero3 = new Pasajero('Dominga', 'Cena', 456333, 2984426082);
    $objPasajero4 = new Pasajero('León', 'Kischinovsky', 12221, 2984406511);
    $aereo->agregarPasajero($objPasajero1);
    $aereo2->agregarPasajero($objPasajero2);
    $tierra1->agregarPasajero($objPasajero3);
    $tierra2->agregarPasajero($objPasajero4);     
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
                                $empresa1->agregarViajeAlArrayViajes($objAereo);
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
                                echo "Ingrese la categoria de asiento: (CAMA || SEMICAMA) \n";
                                $comodidadAsiento =  strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el valor del viaje: \n";
                                $valorPasaje = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $tipoDeTrayecto = trim (fgets(STDIN));
                                $terrestre = new Terrestres($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$comodidadAsiento,$valorPasaje, $tipoDeTrayecto);
                                $empresa1->agregarViajeAlArrayViajes($terrestre);
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
                            $objViaje2 = $empresa1->buscarViaje($nroModificar);
                            echo modificacionDatos($objViaje2);
                            break;                           

                    case '3':
                            // 3) Ver datos de un viaje
                            echo "Ingrese el codigo de viaje que desea ver: \n";
                            $nroViagem = trim(fgets(STDIN));
                            $objViaje = $empresa1->buscarViaje($nroViagem);
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
                                $empresa2 = new Empresa();
                                $empresa2->agregarViajeAlArrayViajes($objAereo);
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
                                echo "Ingrese el valor del viaje: \n";
                                $valorPasaje = trim (fgets(STDIN));
                                echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                                $tipoDeTrayecto = trim (fgets(STDIN));
                                $terrestre = new Terrestres($viajeCodigo,$lugarDestino,$maxAsientos,$asientosOcup,$responsableViaje,$comodidadAsiento,$valorPasaje, $tipoDeTrayecto);
                                $empresa2 = new Empresa();
                                $empresa2->agregarViajeAlArrayViajes($terrestre);
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
                            $objViaje2 = $empresa2->buscarViaje($nroModificar);
                            echo modificacionDatos($objViaje2);
                    break;                           

                    case '3':
                            // 3) Ver datos de un viaje
                            echo "Ingrese el codigo de viaje que desea ver: \n";
                            $nroViagem = trim(fgets(STDIN));
                            $objViaje = $empresa2->buscarViaje($nroViagem);
                            echo $objViaje;
                    break;

                    case '4':
                        // 4) Vender un pasaje
                        echo "Ingrese el tipo de viaje que quiere hacer: (A- aereo || T- terrestre) \n";
                        $tipoDeViaje = strtoupper(trim(fgets(STDIN)));
                        $personaQviaja = infoPasajero();
                        if($tipoDeViaje == "A"){
                            $pasajeValor= $empresa2->objViajesAereos->venderPasaje($personaQviaja);
                        }else{
                            $pasajeValor= $empresa2->objViajesTerrestres->venderPasaje($personaQviaja);
                        }
                        if($pasajeValor == null){
                            echo "La venta no se ha podido realizar";
                        }else{
                            echo "El importe del viaje/vuelo es de " . $pasajeValor;
                        }

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
            6- Desea cambiar la categoria de Asiento/comodidad de asiento?\n.
            7- Desea cambiar el nombre de la aerolinea?\n.
            8- Desea cambiar el número de escalas? \n.
            9- Desea cambiar el valor del viaje/vuelo?\n.
            10-Desea cambiar el tipo de trayecto?\n.
            11- Ver viaje \n.
            12- Salir \n.";

    }


//// MENU PRINCIIPAL ////

    function menu(){
            $menu= "Ingrese una opción:\n\n
            1) Cargar un viaje \n
            2) Modificar un viaje \n
            3) Ver datos de un viaje \n
            4) Vender un pasaje \n
            5) Salir\n";            
            
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
                    //Desea cambiar la categoria de Asiento/ comodidad de asiento//
                    echo "Ingrese la nueva categoría de Asiento o comodidad de asiento: \n";
                    $asiento = trim (fgets(STDIN));
                    $resultado = get_class($objeto);
                    if ($resultado == "Aereos"){
                        $objeto->setCategoriaAsiento($asiento);
                    }else{
                        $objeto->setComodidadAsiento($asiento);
                    } 
                    
                break;
                case '7':
                    //Desea cambiar el nombre de la aerolinea //
                    echo "Ingrese el nuevo nombre de la aerolinea: \n";
                    $nameAerolinea = trim (fgets(STDIN));
                    $objeto->setAerolinea($nameAerolinea);
                   
                break;
                case '8':
                    //Desea cambiar el número de escalas//
                    echo "Ingrese el nuevo número de escalas: \n";
                    $escalasCant=trim (fgets(STDIN));
                    $objeto->setCantEscalas($escalasCant);
                   
                break;
                case '9':
                    //Desea cambiar el valor del viaje/vuelo //
                    echo "Ingrese el nuevo valor del viaje/vuelo: \n";
                    $importeViajecito = trim (fgets(STDIN));
                    $resultado = get_class($objeto);
                    if ($resultado == "Aereos"){
                        $objeto->setCategoriaAsiento($importeViajecito);
                    }else{
                        $objeto->setComodidadAsiento($importeViajecito);
                    }
                    
                break;
                case '10':
                    //Desea cambiar el tipo de trayecto //
                    echo "Ingrese el nuevo tipo de trayecto: \n";
                    $trayectito = trim (fgets(STDIN));
                    $resultado = get_class($objeto);
                    if ($resultado == "Aereos"){
                        $objeto->setCategoriaAsiento($trayectito);
                    }else{
                        $objeto->setComodidadAsiento($trayectito);
                    }
                    
                break;
                case '11':
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


    
