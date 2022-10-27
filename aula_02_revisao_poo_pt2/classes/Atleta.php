<?php

namespace classes;

use \classes\traits\IMC;

class Atleta extends Pessoa
{
	use IMC;

	public $peso, $altura;
	private $imc;

	public function __construct($nome, $altura, $peso, $idade=null)
	{
		$this->nome = $nome;
		$this->peso = $peso;
		$this->altura = $altura;
		if($idade) 
			$this->idade = $idade;
		$this->calc();
	}

	public function showIMC()
	{
		if (!$this->imc) echo "O IMC ainda não foi calculado!";
		echo "\nIMC $this->nome: $this->imc\n";
	}

	public function setAltura($altura)
	{
		$this->altura = $altura;
		$this->calc();
	}

	public function setPeso($peso)
	{
		$this->peso = $peso;
		$this->calc();
	}

	public function getAltura()
	{
		return $this->altura;
	}

	public function getPeso()
	{
		return $this->peso;
	}

	public function __set($name, $value)
	{
		if ($name === 'imc' && is_array($value)) {
			$this->peso = $value[0];
			$this->altura = $value[1];
		} else {
			$this->$name = $value;
		}
		$this->calc();
	}

	public function __get($name){
		return $this->$name;
	}

	public function __toString()
	{
	
		return 	"\n\n===Dados do Atleta==="
                    ."\nNome: $this->nome"
                   	. ($this->idade?"\nIdade: $this->idade":"")
                    ."\nPeso: $this->peso"
                    ."\nAltura: $this->altura"
					."\nIMC:\n  - Valor: " . number_format($this->imc, 2)
					."\n  - Classificacao: ".$this->classifica()
					.($this->idade
						?"\n  - Para Idade: ".
						($this->isNormal()
								?"Normal"
								:"Anormal")
						:"")
					."\n==================\n";

	}
}
