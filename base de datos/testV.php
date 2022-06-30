//Este programa ejecuta segun la opcion elegida del usuario la secuencia de pasos a seguir
do{
    $objViaje = new Viaje();
    $dimensionViaje = count($objViaje->listar(""));
    $seleccion = "";
    if($dimensionViaje > 0){
        $seleccion = menuInicio();
        switch($seleccion){
            
            // Salir del programa
            case 0:
                exit();
            break;

            // Cargar un viaje
            case 1:
                separador();
                echo "Ingrese la cantidad de viajes que desea agregar: ";
                $cant = trim(fgets(STDIN));
                $cant = verificadorInt($cant);
                creaViajes($cant);
            break;
    
            // Cargar una empresa
            case 2:
                crearEmpresa();
            break;

            // Cargar una responsable
            case 3:
                crearResponsable();
            break;

            // Modificar datos de una empresa
            case 4:
                $stringEmpresa = stringObjEmpresa();
                $objEmpresa = new Empresa();
                echo "Ingrese la identificacion de la empresa que desea modificar: "."\n".$stringEmpresa;
                $empresaModificar = trim(fgets(STDIN));
                $resp = $objEmpresa->buscar($empresaModificar);
                if($resp){
                    cambiarDatoEmpresa($objEmpresa);
                }else{
                    separador();
                    echo "El numero de la empresa seleccionada no existe!"."\n";
                    separador();
                }
            break;

            // Modificar datos de un responsable
            case 5:
                $stringResponsable = stringObjResponsable();
                $objResponsable = new ResponsableV();
                echo "Ingrese el numero de empleado del responsable que desea modificar: "."\n".$stringResponsable;
                $responsableModificar = trim(fgets(STDIN));
                $resp = $objResponsable->buscar($responsableModificar);
                if($resp){
                    cambiarDatoResponsable($objResponsable);
                }else{
                    separador();
                    echo "El numero del responsable seleccionado no existe!"."\n";
                    separador();
                }
            break;

            //Modificar un viaje
            case 6:
                opcionesViaje();
            break;
    
            // Mostrar todos los viajes
            case 7:
                separador();
                mostrarViajes();
                separador();
            break;
            
            // Elimina un viaje
            case 8:
                separador();
                echo "Los viajes son: "."\n".stringObjViajes();
                echo "Ingrese el codigo del viaje que desea eliminar: ";
                $objViaje = new Viaje();
                $codigo = trim(fgets(STDIN));
                $codigo = verificadorInt($codigo);
                $resp = $objViaje->buscar($codigo);
                while(!$resp){
                    echo "El codigo ingresado no existe, porfavor ingrese uno de los viajes mostrados"."\n".stringObjViajes();
                    $codigo = trim(fgets(STDIN));
                    $resp = $objViaje->buscar($codigo);
                }
                $objViaje->obtenerPasajeros();
                if(count($objViaje->getArrayObjPasajero()) == 0){
                    $resp = $objViaje->eliminar();
                    if($resp){
                        echo "El viaje fue eliminado correctamente!"."\n";
                    }else{
                        echo "el codigo ingresado no coicide con ningun viaje!"."\n";
                    }
                }else{
                    separador();
                    echo "El viaje no se puede eliminar porque tiene pasajeros!"."\n";
                }
                separador();
            break;
    
            default : 
            echo "El número que ingresó no es válido, por favor ingrese un número del 0 al 8"."\n"."\n";
            break;
        }
    }else{
        do{
        separador();
        echo "No hay viajes ingresados todavia! ingrese alguna de las siguentes opciones"."\n".
             "0- Salir"."\n".
             "1- Cargar una empresa"."\n".
             "2- Cargar un responsable"."\n".
             "3- Cargar un viaje"."\n";
        $opcion = trim(fgets(STDIN));
            switch($opcion){
                
                // Salir del programa
                case 0:
                    exit();
                break;

                // Cargar una empresa
                case 1:
                    crearEmpresa();
                break;
        
                // Cargar un responsable
                case 2:
                    crearResponsable();
                break;
        
                // Cargar un viaje
                case 3:
                    separador();
                    echo "Ingrese la cantidad de viajes que desea agregar: ";
                    $cant = trim(fgets(STDIN));
                    $cant = verificadorInt($cant);
                    creaViajes($cant);
                break;
        
                default : 
                echo "El número que ingresó no es válido, por favor ingrese un número del 0 al 3"."\n"."\n";
                break;
            }
        $dimensionViaje = count($objViaje->listar(""));
        }while(($opcion != 0) && ($dimensionViaje == 0));
    }
}while($seleccion != 0);

?>