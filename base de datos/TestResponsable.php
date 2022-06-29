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

