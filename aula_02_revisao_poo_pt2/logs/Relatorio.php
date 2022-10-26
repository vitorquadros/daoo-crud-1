<?php
namespace logs;
use classes\Pessoa;

class Relatorio {

	private $pessoas = [];

	public function add(Pessoa $pessoa)
	{
		$this->pessoas[]=$pessoa;
	}
	
	public function log(Pessoa $pessoa)
	{
		echo "\nlog: ".$pessoa;
	}

	public function imprime(){
		echo "\n### RELATORIO ###\n";
		foreach ($this->pessoas as $pessoa)
			 $this->log($pessoa);
		echo "\n#############\n";
	}
}