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
		$this->calcImc();
	}

	public function calcImc()
	{
		if ($this->peso && $this->altura) {
			$this->imc = $this->peso / $this->altura ** 2;
		} else {
			echo "Erro, informe o peso e a altura primeiro!";
		}
	}

	public function showIMC()
	{
		if (!$this->imc) echo "O IMC ainda não foi calculado!";
		echo "\nIMC $this->nome: $this->imc\n";
	}

	public function setAltura($altura)
	{
		$this->altura = $altura;
		$this->calcImc();
	}

	public function setPeso($peso)
	{
		$this->peso = $peso;
		$this->calcImc();
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
		$this->calcImc();
	}

	public function __get($name){
		return $this->$name;
	}

	public function __toString()
	{
	
		return 	"\n===Dados do Atleta==="
                    ."\nNome: $this->nome"
                   	. ($this->idade?"\nIdade: $this->idade":"")
                    ."\nPeso: $this->peso"
                    ."\nAltura: $this->altura"
					. "\nIMC: " . number_format($this->imc, 2) . "\n";
	}
}
