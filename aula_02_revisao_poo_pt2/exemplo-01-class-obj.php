<?php 
require "classes/Pessoa.php";
// use classes\Pessoa;

$pessoaUm = new Pessoa("Joao",70,1.7);
$pessoaDois = new Pessoa("Maria",60,1.6);

$pessoaUm->calcImc();
$pessoaUm->showIMC();

$pessoaUm->setPeso(75);
$pessoaUm->showIMC();

$pessoaDois->calcImc();
$pessoaDois->showIMC();

$pessoaDois->imc = 25.5;
$pessoaDois->showIMC();

echo $pessoaDois->peso." ".$pessoaDois->altura;