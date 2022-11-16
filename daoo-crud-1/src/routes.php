<?php

use Daoo\Aula03\controller\Route;
use Daoo\Aula03\controller\api\Doctor;
use Daoo\Aula03\controller\api\Appointment;
use Daoo\Aula03\controller\api\Vaccine;
// use Daoo\Aula03\controller\api\Usuario;

Route::routes([
	'doctor' => Doctor::class,
	'appointment' => Appointment::class,
	'vaccine' => Vaccine::class,
	// 'usuario' => Usuaraio::class
]);

//api:
// composer run api
// composer run test
//http://localhost:8081/classe/metodo/parametro
//http://localhost:8081/produto/