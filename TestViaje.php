<?php

include "Viaje.php";
include "ResponsableV.php";
include "Pasajero.php";

echo "--------- Viaje Feliz ----------\n";

// EJECUTAMOS EL PROGRAMA //

// MENU PRINCIPAL //

echo "Desea ver un viaje anterior?: S o N \n";
$aswer = strtoupper(trim (fgets(STDIN)));
if( $aswer == "S"){
    $objRespViaje = new ResponsableV(2, 3211123, 'Florencio', 'Golberg');
    $objViaje = new Viaje(23,'Traful',30,12, $objRespViaje);
    $objPasajero1 = new Pasajero('Maria', 'Kalauz', 34444332, 299443232);
    $objPasajero2 = new Pasajero('Francisco', 'Klimisch', 1222112, 2994896552);
    $objPasajero3 = new Pasajero('Dominga', 'Cena', 456333, 2984426082);
    $objViaje->agregarPasajero($objPasajero1);
    $objViaje->agregarPasajero($objPasajero2);
    $objViaje->agregarPasajero($objPasajero3);

}else{
    $finish=true;
    do{
        
        $viagiando= menu();
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
                            echo "Ingrese los datos del Responsable del viaje: ";
                            $responsableViaje = crearResponsable();
                            $objViaje = new Viaje($viajeCodigo,$lugarDestino,$maxAsientos, $asientosOcup, $responsableViaje);
                            echo "Ingrese los datos de los pasajeros: \n";
                            do{
                                $continuacion=false;
                                $persona=[];
                                $persona=infoPasajero();
                                $objViaje->agregarPasajero($persona);
                                echo "Desea agregar un nuevo pasajero?: S o N \n";
                                $seguimos=strtoupper(trim(fgets(STDIN)));
                                if($seguimos=="S"){
                                    $continuacion= true;
                                }
                            }while($continuacion);
                                break;

                    case '2':
                            // 2) Modificar un viaje
                            echo modificacionDatos($objViaje);
                            break;                           

                    case '3':
                            // 3) Ver datos de un viaje
                            echo $objViaje;
                            break;

                    default:
                            $finish= false;
                            break;
        };
    }while($finish);


/// PARA AGREGAR PASAJERO ////

    function infoPasajero(){
        
            $pasajero=[];
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
        do{
            echo "Ingrese una opción:\n\n
            1) Cargar un viaje \n
            2) Modificar un viaje \n
            3) Ver datos de un viaje \n
            4) Salir\n";
            $respuesta =trim(fgets(STDIN));            
             
    }while (((is_int($respuesta))&&($respuesta < 0 || $respuesta < 4)));
    return $respuesta;
    }


//// FUNCION PARA MODIFICAR DATOS ////


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
}
}