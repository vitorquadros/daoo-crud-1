<?php 
// include "Pessoa.php";

class Paciente extends Pessoa {
	public function __construct(
		$nome,
		$altura,
		$peso)
	{
		parent::__construct(
			$nome, $peso, $altura);
	}
}