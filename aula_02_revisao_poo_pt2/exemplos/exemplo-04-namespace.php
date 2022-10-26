<?php 
spl_autoload_register(function ($class_name) {
	$path = implode("/",explode('\\',$class_name));
    require_once "../".$path . '.php';
});

use classes\Atleta;
use logs\Relatorio as logIMC;

$jogador = new Atleta("Walter Kannemann",1.83,80);

$jogador->calcImc();
$jogador->showIMC();
logIMC::log($jogador);