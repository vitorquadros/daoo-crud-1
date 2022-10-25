<?php
require "conecta.php";

if($_POST){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$cpf = $_POST['cpf'];

	$sql="insert into pessoa (nome,email,cpf) values ('$nome','$email','$cpf')";

	if(mysqli_query($conexao,$sql)){
		echo "Cadastrado!";
	}else{
		echo "erro!";
	} 
}