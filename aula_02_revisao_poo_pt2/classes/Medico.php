<?php
namespace classes;

class Medico extends Pessoa{

	private $CRM, $especialidade;

	public function __construct($nome, $crm,$especialidade,$idade)
	{
		$this->nome = $nome;
		$this->idade = $idade;
		$this->crm = $crm;
		$this->especialidade = $especialidade;
	}

	public function getCRM(){
		return $this->CRM;
	}

	public function __toString()
	{
		$className = self::class;
		return 	"\n===Dados de $className ==="
			. "\nNome: $this->nome"
			. ($this->idade ? "\nIdade: $this->idade" : "")
			. "\nEspecialidade: $this->especialidade"
			. "\nCRM: $this->crm\n";
	}
}