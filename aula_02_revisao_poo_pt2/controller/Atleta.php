<?php

namespace controller;

use classes\Atleta as Jogador;
use logs\Relatorio;

class Atleta
{
	function __construct()
	{
		$jogador = new Jogador("Walter Kannemann", 1.83, 80);

		$jogador->calcImc();
		$jogador->showIMC();
		Relatorio::log($jogador);
	}
}
