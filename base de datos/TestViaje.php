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