<?php

use Daoo\Aula03\controller\Route;
use Daoo\Aula03\controller\api\Produto;

Route::routes([
	'produto' => Produto::class,
]);