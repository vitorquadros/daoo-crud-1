<?php
namespace classes;

Class Atleta extends Pessoa {
	public function __construct($nome,$altura, $peso)
	{
		parent::__construct($nome,$peso,$altura);
		$this->calcImc();
	}

	public function __toString()
	{
		return parent::__toString()
				."\nIMC: ".number_format($this->imc,2)."\n";
	}
}