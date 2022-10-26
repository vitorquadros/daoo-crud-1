<?php
namespace classes;

abstract class Pessoa{
	public  $nome, $idade;

	public function __destruct()
	{
		echo "\n$this->nome foi destruído!\n";
	}

	public abstract function __toString();
}
