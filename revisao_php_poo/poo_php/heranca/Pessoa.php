<?php 

class Pessoa {
	public $nome, $idade;
	private $imc, $peso, $altura;


	public function __construct(
			$nome,$peso, $altura,$idade=null
	)
	{
		$this->nome = $nome;
		$this->peso = $peso;
		$this->altura = $altura;
		if($idade) $this->idade = $idade;
	}

	public function __destruct()
	{
		echo "\n $this->nome foi destruído!\n";
		
	}

	public function calcImc(){
		if($this->altura && $this->peso)
			$this->imc =  $this->peso/ ($this->altura**2);
		else {
			echo "\nERRO: Configure Peso e Altura primeiro!\n";
		};
	}

	public function getImc(){
		return $this->imc;
	}

	public function showIMC(){
		echo "\nIMC $this->nome: "
				.number_format($this->imc,2)
				."\n";
	}

	public function __get($name){
		return $this->name;
	}

	public function __set($name,$value){
		if($name==='imc'){
			$this->peso = $value[0];
			$this->altura = $value[1];
		}else{
			$this->$name = $value;
		}
		$this->calcImc();
		echo "__set";
	}
}