<?php 
spl_autoload_register(function ($class_name) {
	echo "include $class_name\n";
	$path = implode("/",explode('\\',$class_name));
    require_once $path . '.php';
});

