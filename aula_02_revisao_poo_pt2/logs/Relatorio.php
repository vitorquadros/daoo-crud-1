<?php
namespace logs; //use logs\Relatorio
use classes\Atleta as IMC;

class Relatorio {
	public static function log(IMC $imc)
	{
		echo "\nlog:\n";
		var_dump($imc);
	}
}