<?php
namespace classes\traits;

trait IMC{
	public function calc() : float {
        if ($this->peso && $this->altura) {
            $this->imc = $this->peso/$this->altura**2;
			return $this->imc;
		}else{
			echo "Erro, informe o peso e a altura primeiro!";
			return 0;
		}
	}

	public function classifica() : ?string {
		if(!$this->imc){
			$this->calc($this);
		}
		if($this->imc){
			if($this->imc<18.5)
				return "Abaixo do Peso";
			else if($this->imc<25)
				return "Saudável";
			else if($this->imc<30)
				return "Sobrepeso";
			else return "Obesidade";
		}
	}

	public function isNormal() : bool{
		if(!$this->idade){
			echo "\nErro: defina a idade!\n";
		} 
		if(!$this->imc){
			$this->calc($this);
		}
		if($this->idade >= 19 && $this->idade <=24){
			if(
					$this->imc >= 19 
					&& $this->imc <=24
				) 
				return true;
			else return false;
		}else if($this->idade >= 25 && $this->idade <=34){
			return (
				$this->imc >= 20
				&& $this->imc <=25
			);
		}else if($this->idade >= 35 && $this->idade <=44){
			return (
				$this->imc >= 21
				&& $this->imc <=26
			);
		}else if($this->idade >= 45 && $this->idade <=54){
			return (
				$this->imc >= 22
				&& $this->imc <=27
			);
		}else if($this->idade >= 55 && $this->idade <=64){
			return (
				$this->imc >= 23
				&& $this->imc <=28
			);
		}else if($this->idade >= 65){
			return (
				$this->imc >= 24
				&& $this->imc <=29
			);
		}

		return false;
	}
}