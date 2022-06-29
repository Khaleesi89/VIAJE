<?php
require_once('BaseDeDatos.php');

$base = new BaseDeDatos();
$inicia = $base->Iniciar();
if(!$inicia){
    echo "no se conecta";
}else{
    echo "inicia";
}