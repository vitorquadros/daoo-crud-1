<?php 
spl_autoload_register(function ($class_name) {
    echo "\ninclude $class_name\n";
    require_once "classes/$class_name.php";
});

$jogador = new Atleta("Walter Kannemann",1.83,80);

$jogador->calcImc();
$jogador->showIMC();