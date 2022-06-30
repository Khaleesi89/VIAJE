<?php
require_once("BaseDeDatos.php");

$tra = new BaseDeDatos();
$ram = $tra->Iniciar();
if($ram){
    echo "se ha ingresado ";
}else{
    echo "no se ingreso";
}
