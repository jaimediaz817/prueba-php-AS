<?php

// sumar 2 numeros :: test
function sumar($a,$b):int{
    return($a+$b);
}

function getControllerName($cadenaIn):string{
    $array = explode("_", $cadenaIn);
    return $array[0];
}

function getCapitalLetter(string $texto):string{
    return ucwords($texto);
}

//retorna los primeros 2 caracteres
function getCharacters($text, $cantidad=0){
    return substr($text,0,$cantidad);
}