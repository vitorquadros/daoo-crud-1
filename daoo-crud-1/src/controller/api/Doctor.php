<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Doctor as DoctorDao;
use Exception;

class Doctor extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new DoctorDao();
		error_log(print_r($this->model, TRUE));
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$doctor = $this->model->read($id);
		if ($doctor) {
			$response = ['doctor' => $doctor];
		} else {
			$response = ['Erro' => "Doctor not found"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function create()
	{
		try {
			$this->validatePostRequest();

			$this->model = new DoctorDao(
				$_POST['name'],
				$_POST['username'],
				$_POST['crm'],
			);
			$this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->create())
				echo json_encode([
					"success" => "Doctor created successfully!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Error on create Doctor!");
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}


	public function update()
	{
		try {
			if (!isset($_POST["id"]))
				throw new \Exception('Error: missing id');	

			$this->validatePostRequest();

			$this->model = new DoctorDao(
				$_POST['name'],
				$_POST['username'],
				$_POST['crm'],
			);
			$this->model->id = $_POST["id"];
			// $this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->update())
				echo json_encode([
					"success" => "Doctor updated successfully!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Error on update Doctor!");
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	public function remove()
	{
		try {
			if (!isset($_POST["id"]))
				throw new \Exception('Erro: missing id!');
			$id = $_POST["id"];
			if ($this->model->delete($id)) {
				$response = ["message:"=>"Doctor with id:$id removed successfully!"];
			} else {
				throw new Exception("Error on remove Doctor!");
			}
			echo json_encode($response);
		} catch (\Exception $error) {
			header('HTTP/1.0 404 Not Found');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	private function validatePostRequest()
	{
		if (
			!isset($_POST['name']) ||
			!isset($_POST['username']) ||
			!isset($_POST['crm'])
		) throw new \Exception('Erro: missing params!');
	}
}
