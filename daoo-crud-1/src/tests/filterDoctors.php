<?php
require_once '../../vendor/autoload.php';

use Daoo\Aula03\model\Doctor;

header("Content-Type:application/json");

$doctorDao = new Doctor();

if(!isset($_GET) || !sizeof($_GET))
    die("Filtros vazios!");
echo json_encode($doctorDao->filter($_GET));