<?php
require "autoload.php";

use classes\Atleta;
use classes\Medico;
use logs\Relatorio;

$medico = new Medico("Paulo Paixão",12345,"Fisiologista",65);
$jogador = new Atleta("Pedro Geromel", 1.9, 84);

$relatorio = new Relatorio;
$relatorio->add($medico);
$relatorio->add($jogador);
$relatorio->imprime();
