<?php 
spl_autoload_register(function ($class_name) {
	echo "\nclass-name: $class_name";
	$path = implode("/",explode('\\',$class_name));
	echo "\npath: $path";
    require_once $path . '.php';
});

use classes\Atleta;
use logs\Relatorio as logIMC;

$jogador = new Atleta("Walter Kannemann",1.83,80);

$jogador->calcImc();
$jogador->showIMC();
logIMC::log($jogador);