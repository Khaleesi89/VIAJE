<?php

require_once('Empresa.php');
require_once('Responsable.php');
require_once('Viaje.php');
require_once('Pasajero.php');
    
 
$viaje = new Viaje();
$responsable = new Responsable();
$pasajero = new Pasajero();
$empresa = new Empresa();


//MENU PRINCIPAL

function menu(){
    $menu = "Ingrese una opción:\n\n
    1) EMPRESAS \n
    2) PASAJEROS \n
    3) VIAJES \n
    4) RESPONSABLES \n
    5) SALIR \n";
    return $menu;
}

function empresaMenu(){
    $menu = "Ingrese una opción:\n\n
    1) Ingresar una nueva empresa \n
    2) Modificar una existente \n
    3) Listar empresas \n
    4) Eliminar una empresa \n
    5) SALIR \n";
    return $menu;
}

function pasajerosMenu(){
    $menu = "Ingrese una opción:\n\n
    1) Ingresar un nuevo pasajero \n
    2) Modificar un pasajero \n
    3) Listar pasajeros \n
    4) Eliminar un pasajero \n
    5) SALIR \n";
    return $menu;
}

function viajeMenu(){
    $menu = "Ingrese una opción:\n\n
    1) Ingresar un nuevo viaje\n
    2) Modificar un viaje \n
    3) Listar viajes \n
    4) Eliminar un viaje\n
    5) SALIR \n";
    return $menu;
}
function responsableMenu(){
    $menu = "Ingrese una opción:\n\n
    1) Ingresar un nuevo responsable \n
    2) Modificar un responsable \n
    3) Listar responsables \n
    4) Eliminar un responsable \n
    5) SALIR \n";
    return $menu;
}