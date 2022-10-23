<?php
$conexao = mysqli_connect('localhost', 'root', 'r00t', 'aula');

if (mysqli_connect_errno())
    die("Connect failed: %s\n".mysqli_connect_error());

echo 'Conexão bem sucedida';
