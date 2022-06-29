<?php

require_once('Empresa.php');
require_once('Responsable.php');
require_once('Viaje.php');
require_once('Pasajero.php');
    
 
$viaje = new Viaje();
$responsable = new Responsable();
$pasajero = new Pasajero();
$empresa = new Empresa();

//MENUES

    function menu(){
        $menu= "Ingrese una opción:\n\n
            1) Agregar una empresa \n
            2) Cargar un viaje \n
            3) Cargar un pasajero \n
            4) Modificar una empresa existente \n
            5) Modificar un viaje \n
            6) Modificar un pasajero \n
            7) Eliminar una empresa \n
            8) Eliminar un viaje \n
            9) Eliminar un pasajero \n
           10) Listar empresas \n
           11) Listar los viajes \n
           12) Listar los pasajeros \n
           13) Salir\n";                        
        return $menu;
    }

    //MUESTRA TODA LA INFO CARGADA EN UN ARRAY DE CUALQUIER CLASE

    function mostrar($colex){
        $str = "";
        foreach($colex as $obj){
            $str .= $obj."\n";
        }
        return $str;
    }


    //PROGRAMA PRINCIPAL

    do {
        $menu = menu();
        echo $menu."\n";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1:
                //1) Agregar una empresa
                $salida = false; 
                do{
                    $empresa = crearEmpresa();
                    echo "Desea seguir cargando empresas? SI o NO";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if($resp == "SI"){
                        $empresa = crearEmpresa();
                        $salida = true;   
                    }else{
                        $salida = false;
                    }
                }while($salida);
               
            break;
            case 2:
                //2)Cargar un viaje
                $salida = false; 
                do{
                    $viaje = crearViaje();
                    echo "Desea seguir cargando viajes? SI o NO";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if($resp == "SI"){
                        $viaje = crearViaje();
                        $salida = true;   
                    }else{
                        $salida = false;
                    }
                }while($salida);
                
            break;
            case 3:
                //3) Cargar un pasajero
                $salida = false; 
                do{
                    $pasajero = infoPasajero();
                    echo "Desea seguir cargando pasajeros? SI o NO";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if($resp == "SI"){
                        $pasajero = infoPasajero();
                        $salida = true;   
                    }else{
                        $salida = false;
                    }
                }while($salida);

            break;

            case 4:
                //3) Cargar un responsable
                $salida = false; 
                do{
                    $responsable = infoResponsable();
                    echo "Desea seguir cargando un responsable? SI o NO";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if($resp == "SI"){
                        $responsable = infoResponsable();
                        $salida = true;   
                    }else{
                        $salida = false;
                    }
                }while($salida);
               
            break;
            case 5:
                //4) Modificar una empresa existente

            break;

            case 6:
                //5) Modificar un viaje

            break;

            case 7:
                //7) Modificar un pasajero

            break;

            case 8:
                //8) Modificar un responsable

            break;
            case 9:
                //9) Eliminar una empresa
                echo "Ingrese la ID de la empresa que quiere eliminar";
                $eliminar = trim(fgets(STDIN));
                $empres = new Empresa;
                $empres->eliminar($eliminar);
                echo "La empresa ha sido eliminada";
            break;
            case 10:
                //10) Eliminar un viaje
                echo "Ingrese la ID del viaje que quiere eliminar";
                $eliminar = trim(fgets(STDIN));
                $viaje = new Viaje;
                if($viaje->getColeccionPasajeros() != []){                    
                    foreach($viaje->getColeccionPasajeros() as $p){           
                        $p->Eliminar();                                       
                    }                                                         
                }                                          
                $viaje->eliminar($eliminar);
                echo "El viaje ha sido eliminado"; 
            break;
            case 11:
                //11) Eliminar un pasajero
                echo "Ingrese el DNI del pasajero que quiere eliminar";
                $eliminar = trim(fgets(STDIN));
                $pasaj = new Pasajero;
                $pasaj->eliminar($eliminar);
                echo "El pasajero ha sido eliminado";
            break;
            case 11:
                //11) Eliminar un responsable
                echo "Ingrese la ID del responsable que quiere eliminar";
                $eliminar = trim(fgets(STDIN));
                $respon = new Responsable;
                $respon->eliminar($eliminar);
                echo "El responsable ha sido eliminado";
            break;
            case 12:
                //12) Listar empresas
                $empresa = new Empresa;
                echo $empresa->listar();
            break;
            case 13:
                //13) Listar los viajes
                $viaje = new Viaje;
                echo $viaje->listar();
            break;
            case 14:
                //14) Listar los pasajeros
                $pasaj = new Pasajero;
                echo $pasaj->listar();
            break;
            case 15:
                //15) Listar los responsables
                $responsab = new Responsable;
                echo $responsab->listar();
            break;

            default:
                // Salir  //
                $salida=false;
            break;
        }



    }while($salida);




    //FUNCION PARA CREAR UNA EMPRESA

    function crearEmpresa(){
        echo "Ingrese los datos de la empresa \n";
        echo "Ingrese el nombre: \n";
        $name= strtoupper(trim (fgets(STDIN)));
        echo "Ingrese la direcciòn: \n";
        $direccion= strtoupper(trim (fgets(STDIN)));
        $empresa = new Empresa();
        $id = $empresa->idempresaIncremento();
        $empresa->cargar($id,$name,$direccion);
        return $empresa;

    }


    //FUNCION PARA CREAR UN VIAJE
    function crearViaje(){
        echo "Ingrese los datos correspondientes al viaje \n";
        echo "Ingrese el destino: \n";
        $lugarDestino= strtoupper(trim (fgets(STDIN)));
        echo "Ingrese la cantidad máxima de asientos: \n";
        $maxAsientos = trim (fgets(STDIN));
        echo "Ingrese el importe del viaje: \n";
        $importe = trim (fgets(STDIN));
        echo "Viaje de ida o ida y vuelta?";
        $idavuelta = strtoupper(trim (fgets(STDIN)));
        echo "Que tipo de asiento desea?? PRIMERA CLASE (PC) O TURISTA (T)";
        $asiento = strtoupper(trim (fgets(STDIN)));
        $empresa = new Empresa();
        $resposnable = new Responsable();
        $viaje = new Viaje();
        $id = $viaje->idviajesIncremento();
        $viaje->ingresarViaje($id,$lugarDestino,$maxAsientos,$empresa,$resposnable,$importe,$asiento,$idavuelta);
        $validacion = viajeduplicado($viaje);
        if($validacion){
            $viaje->eliminar();
            echo "Su viaje està duplicado";
        }
        return $viaje;
    }

    
    //FUNCION PARA VER VIAJE REPETIDO devuelve true si es repetido




    function viajeduplicado($objViajeIngresado){
        $empresa = new Empresa();
        $arrayViajes = $empresa->listar("");
        $i = 0;
        $mismoViaje = false;
        $cantidad = count($arrayViajes);
        while(!$mismoViaje && $i < $cantidad){
            $viajecito = $arrayViajes[$i]->getVdestino();
            $viajeInspect = $objViajeIngresado->getVDestino();
            if($viajecito == $viajeInspect){
                $mismoViaje = true;
            }else{
                $i++;
            }
        }
        return $mismoViaje;
    }
    
    
    //FUNCION PARA CREAR UN PASAJERO

    function infoPasajero(){
                echo "Ingrese los datos del pasajero \n";
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


    //FUNCION PARA CREAR UN RESPONSABLE
    function infoResponsable(){
        echo "Ingrese apellido: \n";
        $apellido= strtoupper(trim (fgets(STDIN)));
        echo "Ingrese nombre: \n";
        $nombre= strtoupper(trim (fgets(STDIN)));
        echo "Ingrese numero de licencia: \n";
        $licencia= trim (fgets(STDIN));
        $responsable = new Responsable();
        $idempleado = $responsable->idResponsablencremento();
        $responsable->cargar($nombre,$apellido,$licencia,$idempleado);         
        return $responsable;
    }
    

    //MODIFICAR UNA EMPRESA
    function modificarEmpresa($id){
        $empresa = new 
    }




    //MODIFICAR UN VIAJE


    //MODIFICAR UN PASAJERO



    //FUNCION PARA BUSCAR SI YA ESTA REGISTRADO EN EL DESTINO


    function buscandoPasajero($dni, $destino){

    }