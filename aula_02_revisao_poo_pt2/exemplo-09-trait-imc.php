<?php
require 'autoload.php';

$jogador = new \classes\Atleta('Douglas',1.86,89);


echo $jogador->calc();
echo "\n";
echo $jogador->classifica();

$jogador->idade = 37;

$msg = "\nO IMC de $jogador->nome é ";

if($jogador->isNormal())
	$msg .= "NORMAL";
else 
	$msg .= "ANORMAL";

$msg .= " para a idade $jogador->idade!";

echo $msg;