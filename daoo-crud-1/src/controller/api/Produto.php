<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Produto as ProdutoDao;
use Exception;

class Produto extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new ProdutoDao();
		error_log(print_r($this->model, TRUE));
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$produto = $this->model->read($id);
		if ($produto) {
			$response = ['produto' => $produto];
		} else {
			$response = ['Erro' => "Produto não encontrado"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function create()
	{
		try {
			$this->validatePostRequest();

			$this->model = new ProdutoDao(
				$_POST['nome'],
				$_POST['descricao'],
				$_POST['quantidade'],
				$_POST['preco']
			);
			$this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->create())
				echo json_encode([
					"success" => "Produto criado com sucesso!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Erro ao criar produto!");
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
				throw new \Exception('Erro: id obrigatorio!');

			$this->validatePostRequest();

			$this->model = new ProdutoDao(
				$_POST['nome'],
				$_POST['descricao'],
				$_POST['quantidade'],
				$_POST['preco']
			);
			$this->model->id = $_POST["id"];
			$this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->update())
				echo json_encode([
					"success" => "Produto atualizado com sucesso!",
					"data" => $this->model->toArray()
				]);
			else throw new \Exception("Erro ao criar produto!");
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
				throw new \Exception('Erro: id obrigatorio!');
			$id = $_POST["id"];
			if ($this->model->delete($id)) {
				$response = ["message:"=>"Produto id:$id removido com sucesso!"];
			} else {
				throw new Exception("Erro ao remover Produto!");
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
			!isset($_POST['nome']) ||
			!isset($_POST['descricao']) ||
			!isset($_POST['quantidade']) ||
			!isset($_POST['preco'])
		) throw new \Exception('Erro: falta de parametros !');
	}
}
