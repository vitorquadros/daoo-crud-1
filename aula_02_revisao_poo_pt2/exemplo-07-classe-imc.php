<?php
require 'autoload.php';

use classes\IMC;

$jogador = new \classes\Atleta('Douglas',1.86,89);


echo IMC::calc($jogador);
echo "\n";
echo IMC::classifica($jogador);

$jogador->idade = 37;

$msg = "\nO IMC de $jogador->nome é ";

if(IMC::isNormal($jogador))
	$msg .= "NORMAL";
else 
	$msg .= "ANORMAL";

$msg .= " para a idade $jogador->idade!";

echo $msg;