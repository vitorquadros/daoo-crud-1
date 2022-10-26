<?php
namespace classes;

class IMC{
	public static function calc(Atleta $atleta) : float {
        if ($atleta->peso && $atleta->altura) {
            $atleta->imc = $atleta->peso/$atleta->altura**2;
			return $atleta->imc;
		}else{
			echo "Erro, informe o peso e a altura primeiro!";
			return 0;
		}
	}

	public static function classifica(Atleta $atleta){
		if(!$atleta->imc){
			self::calc($atleta);
		}
		if($atleta->imc){
			if($atleta->imc<18.5)
				return "Abaixo do Peso";
			else if($atleta->imc<25)
				return "Saudável";
			else if($atleta->imc<30)
				return "Sobrepeso";
			else return "Obesidade";
		}
	}

	public static function isNormal(Atleta $atleta){
		if(!$atleta->idade){
			echo "\nErro: defina a idade!\n";
		} 
		if(!$atleta->imc){
			self::calc($atleta);
		}
		if($atleta->idade >= 19 && $atleta->idade <=24){
			if(
					$atleta->imc >= 19 
					&& $atleta->imc <=24
				) 
				return true;
			else return false;
		}else if($atleta->idade >= 25 && $atleta->idade <=34){
			return (
				$atleta->imc >= 20
				&& $atleta->imc <=25
			);
		}else if($atleta->idade >= 35 && $atleta->idade <=44){
			return (
				$atleta->imc >= 21
				&& $atleta->imc <=26
			);
		}else if($atleta->idade >= 45 && $atleta->idade <=54){
			return (
				$atleta->imc >= 22
				&& $atleta->imc <=27
			);
		}else if($atleta->idade >= 55 && $atleta->idade <=64){
			return (
				$atleta->imc >= 23
				&& $atleta->imc <=28
			);
		}else if($atleta->idade >= 65){
			return (
				$atleta->imc >= 24
				&& $atleta->imc <=29
			);
		}

		return false;
	}



}