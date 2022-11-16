<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Appointment as AppointmentDao;
use Exception;

class Appointment extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new AppointmentDao();
		error_log(print_r($this->model, TRUE));
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$appointment = $this->model->read($id);
		if ($appointment) {
			$response = ['appointment' => $appointment];
		} else {
			$response = ['Erro' => "Appointment not found"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function create()
	{
		try {
			$this->validatePostRequest();

			$this->model = new AppointmentDao(
				$_POST['description']
				// $_POST['date'],
			);
			$this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->create())
				echo json_encode([
					"success" => "Appointment created successfully!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Error on create Appointment!");
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

			$this->model = new AppointmentDao(
				$_POST['description'],
				$_POST['date']
			);
			$this->model->id = $_POST["id"];
			// $this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->update())
				echo json_encode([
					"success" => "Appointment updated successfully!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Error on update Appointment!");
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
				$response = ["message:"=>"Appointment with id:$id removed successfully!"];
			} else {
				throw new Exception("Error on remove Appointment!");
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
			!isset($_POST['description'])
		) throw new \Exception('Erro: missing params!');
	}
}
