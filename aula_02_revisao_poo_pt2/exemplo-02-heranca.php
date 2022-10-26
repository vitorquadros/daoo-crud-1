<?php 
include "classes/Pessoa.php";
include "classes/Atleta.php";

$jogador = new Atleta("Walter Kannemann",1.83,80);

$jogador->calcImc();
$jogador->showIMC();