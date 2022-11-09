<?php 

namespace Daoo\Aula03\controller\api;

abstract class Controller{

	protected $model;

	public abstract function index();

	protected function setHeader(){
		header("Content-Type:application/json;charset=utf-8'");
	}
}