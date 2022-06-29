<?php

include "Pasajero.php";
include "ResponsableV.php";
include "Empresa.php";
include "Viaje.php";
    
 

$viaje = new Viaje();
$responsable = new Responsable();
$pasajero = new Pasajero();
$empresa = new Empresa();

echo menu();
    $salida = true;
    $viagiando= trim(fgets(STDIN));
        switch ($viagiando){
            case '1':
                        // 1) Cargar un viaje
                        echo "Ingrese el destino: \n";
                        $lugarDestino= strtoupper(trim (fgets(STDIN)));
                        $viaje->setVDestino($lugarDestino);
                        echo "Ingrese la cantidad máxima de asientos: \n";
                        $maxAsientos = trim (fgets(STDIN));
                        $viaje->setVcantmaxpasajeros($maxAsientos);
                        echo "Elija la empresa que corresponde a su viaje : \n";
                        echo "\n".mostrar($empresa->Listar());
                        echo "Ingrese la id \n";
                        $id = trim (fgets(STDIN));
                        $esta = $empresa->Buscar($id);
                        $viaje->setIdEmpresa($empresa->getIdEmpresa());
                        echo "Elija alguno de los Responsables autorizados: \n ";

                        echo "\n".mostrar($responsable->listarResponsable());
                        echo "Ingrese el número de empleado del responsable elegido: \n";
                        $idResponsable = trim (fgets(STDIN));
                        $viaje->setRNumeroEmpleado($responsable->getRNumeroEmpleado());
                        echo "Ingrese el importe del viaje: ";
                        $importe = trim (fgets(STDIN));
                        $viaje->setVImporte($importe);
                        echo "¿De qué tipo es el asiento? (CAMA/SEMICAMA): ";
                        $clase = strtoupper(trim (fgets(STDIN)));
                        echo "Ingrese tipo de trayecto: (I->ida || V->vuelta || IyV -> ida y vuelta) \n";
                        $idaOvuelta = strtoupper(trim (fgets(STDIN)));
                        echo "¿Desea asignar pasajeros al viaje? SI/NO: ";
                        $agregar = strtoupper(trim (fgets(STDIN)));
                        if(strtoupper($agregar)=="SI"){
                            do{
                                do{
                                    echo "Ingrese el DNI del pasajero a ingresar:  ";
                                    $id = trim (fgets(STDIN));
                                    $existe = $pasajero->buscar($id);
                                    if($existe == false){
                                        echo "Ya existe este pasajero en otro viaje con este DNI \n ";
                                    }
                                }while($existe);

                            echo "Ingrese el nombre del pasajero: ";
                            $pnombre = strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el apellido del pasajero: ";
                            $papellido = strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el telefono del pasajero: ";
                            $ptelefono = trim (fgets(STDIN));
                            $ultimoId = $viaje->idviajesIncremento();
                            $nuevoPasajero = new Pasajero($id,$pnombre,$papellido,$ptelefono,$ultimoId );
                            $coleccionPasajeros = [];
                            array_push($coleccionPasajeros,$nuevoPasajero);
                            echo "¿Desea seguir agregando pasajeros? SI/NO: ";
                            $respuesta = strtoupper(trim (fgets(STDIN)));
                        }while(strtoupper($respuesta)!="NO");
                    }
                    echo $viaje->Insertar() ? "" : $viaje->getErrorOno();   
                    foreach($coleccionPasajeros as $pasaj){
                        echo $pasaj->Insertar() ? "" : $viaje->getErrorOno();
                    }  
                    echo "viaje creado con exito";
            break;

            case '2':
                     // 2) Modificar un viaje
                        do{
                            echo "Desea modificar alguno de los viajes ingresados?? \n ";
                            $respuesta = strtoupper(trim (fgets(STDIN)));
                            if($respuesta == "SI"){
                                echo mostrar($viaje->Listar());
                                do{
                                    echo "Elija uno de los viajes listados (anotelo con su id) \n";
                                    $idViaje = trim (fgets(STDIN));
                                    $pudo = $viaje->BuscarViaje($idViaje);
                                    echo $pudo ? "" : "Número de viaje inválido \n ";
                                }while($pudo!=true);
                                echo "Ingrese el nuevo destino del viaje: ";
                                $destino = strtoupper(trim (fgets(STDIN)));
                                $viaje->setVDestino($destino);
                                echo "Ingrese la nueva cantidad máxima de pasajeros: \n";
                                $cantMaxPasajeros = trim (fgets(STDIN));
                                $viaje->setVCantMaxPasajeros($cantMaxPasajeros);
                                echo "¿Desea modificar los datos de los  pasajeros dentro del viaje? SI/NO: \n";
                                $resp = strtoupper(trim (fgets(STDIN)));
                                if($resp == "SI"){
                                    echo "Ingrese el DNI del pasajero: \n";
                                    $dni = trim (fgets(STDIN));
                                    $pudo = $pasajero->buscar($dni);
                                    if($pudo == false){
                                        echo "DNI está no en los registros \n";
                                    }
                                    echo "Desea modificar (M) o eliminar (E) al pasajero?? : \n"; 
                                    $operat = strtoupper(trim (fgets(STDIN)));
                                    if($operat== "M" ){
                                        echo "Ingrese el nombre modificado del pasajero: ";
                                        $pnombre = strtoupper(trim (fgets(STDIN)));
                                        echo "Ingrese el apellido modificado del pasajero: ";
                                        $papellido = strtoupper(trim (fgets(STDIN)));
                                        echo "Ingrese el telefono modificado del pasajero: ";
                                        $ptelefono = trim (fgets(STDIN));

                                        $pasajero->pasajeroCrear($dni,$pnombre,$papellido,$ptelefono,$viaje->getIdViaje());
                                        $pasajero->modificarPasajero();
                                    }else{
                                        $pasajero->eliminarPasajero($dni);
                                        echo "Pasajero eliminado  \n";
                                    }
                                }
                                echo "¿Desea seguir modificando pasajeros? SI/NO:\n";
                                $operat = strtoupper(trim (fgets(STDIN)));
                                if($operat == "NO"){
                                    $respuesta = false;
                                }else{
                                    $respuesta = true;
                                }
                            }while($respuesta);
                            echo "\n".mostrar($empresa->Listar());
                            do{
                                echo "Elija la empresa que desea utilizar (anotarla con su id) \n ";
                                $codigoEmpresa = trim (fgets(STDIN));
                                $puede = $empresa->Buscar($codigoEmpresa);
                                echo $puede ? "" : "Id de Empresa inválido, verifique el nro \n ";  
                            }while($puede!=true);
                            $viaje->setIdEmpresa($empresa->getIdEmpresa());

                            echo "\n".mostrar($responsable->ListarResponsable());
                            do{
                                echo "Elija el responsable que desea para su viaje: \n ";
                                $empleado = trim (fgets(STDIN));
                                $puede = $responsable->Buscar($empleado);
                                echo $puede ? "" : "Número de empleado inválido, intente nuevamente\n ";
                            }while($puede!=true);
                            $viaje->setRNumeroEmpleado($responsable->getRNumeroEmpleado());
                            echo "Ingrese el nuevo importe del viaje: \n";
                            $importe = trim (fgets(STDIN));
                            $viaje->setVImporte($importe);
                            echo "Ingrese su nuevo tipo de asiento: (CAMA (C) /SEMICAMA (SM))\n";
                            $asiento = strtoupper(trim (fgets(STDIN)));
                            $viaje->setTipoAsiento($asiento);
                            echo "¿El viaje es ida y vuelta? SI/NO: \n";
                            $idaYVuelta = strtoupper(trim (fgets(STDIN)));
                            $viaje->setIdaYVuelta($idaYVuelta);

                            $viaje->Modificar();

                            echo "Viaje modificado \n ";
                        }while($respuesta!=true);
            break;                           

            case '3':
                    // 3) Eliminar un viaje
                        echo mostrar($viaje->Listar());
                        do{
                            echo "Escoja un viaje (por su id): \n ";
                            $idViaje = trim (fgets(STDIN));
                            $puede = $viaje->BuscarViaje($idViaje);
                            echo $puede ? "" : "Número de viaje inválido, verifiquelo \n ";
                        }while($puede!=true);
                        if($viaje->getColecPasajeros() != []){                    
                            foreach($viaje->getColecPasajeros() as $pasaj){           
                                $pasaj->eliminarPasajero();                                       
                            }                                                         
                        }                                                             
                        $viaje->EliminarViaje();
                        echo "Viaje eliminado\n";
            break;

            case '4':
                    // 4)Listar los viajes
                        echo "Desea ver todos los viajes existentes? (S / N) \n";
                        $answer = strtoupper(trim (fgets(STDIN)));
                        if($answer== "S"){
                            echo mostrar($viaje->Listar());
                        }
                    
            break;
            case '5':
                    // 5)Agregar una empresa
                        echo "Ingrese el nombre de la empresa: \n";
                        $enombre = strtoupper(trim (fgets(STDIN)));
                        $empresa->setEnombre($enombre);
                        echo "Ingrese la dirección de la empresa: \n ";
                        $edireccion = strtoupper(trim (fgets(STDIN)));
                        $empresa->setEdireccion($edireccion);
                        echo $empresa->insertarEmpresa() ? "true" : $empresa->getErrorOno(); 
                        

            break;
            case '6':
                     // 6)Modificar una empresa existente
                        echo "\n".mostrar($empresa->Listar());
                        do{
                            echo "Elija una empresa de las listadas para realizar las modificaciones (por su ID): \n ";
                            $id = trim (fgets(STDIN));
                            $puede = $empresa->Buscar($id);
                            echo $puede ? "" : "Número de empresa inválido, verifiquelo\n ";
                        }while($puede!=true);
                        echo "Ingrese el nuevo nombre de la empresa: \n";
                        $enombre = strtoupper(trim (fgets(STDIN)));
                        $empresa->setEnombre($enombre);
                        echo "Ingrese la nueva dirección de la empresa: \n";
                        $edireccion = strtoupper(trim (fgets(STDIN)));
                        $empresa->setEdireccion($edireccion);
                        $empresa->modificarEmpresa();
                        
            break;
            case '7':
                     // 7)Eliminar una empresa
                    
                        echo "\n".mostrar($empresa->Listar());
                        do{
                            echo "Elija una empresa de la lista para eliminar (identificada con un ID): \n ";
                            $id = trim (fgets(STDIN));
                            $puede = $empresa->Buscar($id);
                            echo $puede ? "" : "no existe, verifiquelo nuevamente\n ";
                        }while($puede!=true);
                        $empresa->eliminarViajes();                                    
                        echo $empresa->eliminarEmpresa();   
        
            break;
            case '8':
                    // 8) Listar empresas
                        echo "Desea ver todas las empresas existentes? (S / N) \n";
                        $answer = strtoupper(trim (fgets(STDIN)));
                        if($answer== "S"){
                            echo mostrar($viaje->Listar());
                        }
            break;
            case '9':
                    // 9) Cargar un pasajero 
                            $salida = true;
                            do{
                                do{
                                    echo "Ingrese el DNI del pasajero a ingresar:  ";
                                    $id = trim (fgets(STDIN));
                                    $existe = $pasajero->buscar($id);
                                    if($existe == false){
                                        echo "Ya existe este pasajero en otro viaje con este DNI \n ";
                                    }
                                }while($existe);
                                echo "Ingrese el nombre del pasajero: ";
                                $pnombre = strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el apellido del pasajero: ";
                                $papellido = strtoupper(trim (fgets(STDIN)));
                                echo "Ingrese el telefono del pasajero: ";
                                $ptelefono = trim (fgets(STDIN));
                                $ultimoId = $viaje->idviajesIncremento();
                                $nuevoPasajero = new Pasajero($id,$pnombre,$papellido,$ptelefono,$ultimoId );
                                $coleccionPasajeros = [];
                                array_push($coleccionPasajeros,$nuevoPasajero);
                                echo "¿Desea seguir agregando pasajeros? SI/NO: ";
                                $respuesta = strtoupper(trim (fgets(STDIN)));
                                if($respuesta == "NO"){
                                    $salida = false;
                                }
                            }while($salida = false);
                            
                            
            break;
            case '10':
                    // 10) Modificar un pasajero
                            echo "Ingrese el DNI del pasajero: \n";
                            $dni = trim (fgets(STDIN));
                            $pudo = $pasajero->buscar($dni);
                            if($pudo == false){
                                echo "DNI está no en los registros \n";
                            }
                            echo "Ingrese el nombre modificado del pasajero: ";
                            $pnombre = strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el apellido modificado del pasajero: ";
                            $papellido = strtoupper(trim (fgets(STDIN)));
                            echo "Ingrese el telefono modificado del pasajero: ";
                            $ptelefono = trim (fgets(STDIN));
                            $pasajero->pasajeroCrear($dni,$pnombre,$papellido,$ptelefono,$viaje->getIdViaje());
                            $pasajero->modificarPasajero();
            break;
            case '11':
                    // 11) Eliminar un pasajero
                            echo "Ingrese el DNI del pasajero: \n";
                            $dni = trim (fgets(STDIN));
                            $pudo = $pasajero->buscar($dni);
                            if($pudo == false){
                                echo "DNI está no en los registros \n";
                            }
                            $pasajero->eliminarPasajero($dni);
                            echo "Pasajero eliminado  \n";
                break;
            case '12':
                    // 12) Listar los pasajeros 
                            echo "LISTA DE PASAJEROS";
                            $pasajero->listarPasajeros();
            break;

            default:
                    // 13)Salida
                        $salida= false;
            break;
        }

//MENUES

function menu(){
    $menu= "Ingrese una opción:\n\n
        1) Cargar un viaje \n
        2) Modificar un viaje \n
        3) Eliminar un viaje \n
        4) Listar los viajes \n
        5) Agregar una empresa \n
        6) Modificar una empresa existente \n
        7) Eliminar una empresa \n
        8) Listar empresas \n
        9) Cargar un pasajero \n
       10) Modificar un pasajero \n
       11) Eliminar un pasajero \n
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