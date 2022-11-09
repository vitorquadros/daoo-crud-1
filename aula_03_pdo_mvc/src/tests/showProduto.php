<?php
require_once '../../vendor/autoload.php';

use Daoo\Aula03\model\Produto;

header("Content-Type:application/json;charset=utf-8'");

$prodDao = new Produto();

if(isset($_GET['id'])) {
    $produto = $prodDao->read($_GET['id']);
    if($produto)
        $json =['produto'=>$produto];
    else
        $json = ['Erro'=>"Produto não encontrado"];
    echo json_encode($json);
}