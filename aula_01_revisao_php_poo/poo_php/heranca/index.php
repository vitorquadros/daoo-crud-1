<?php 
// include "Paciente.php";
include "autoloader.php";

$paciente = new Paciente("Fulano",1.8,80);

$paciente->calcImc();
$paciente->showIMC();