<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Produto as ProdutoDao;

class Produto extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new ProdutoDao();
		error_log(print_r($this->model,TRUE));
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$produto = $this->model->read($id);
		if ($produto) {
			$json = ['produto' => $produto];
		} else {
			$json = ['Erro' => "Produto não encontrado"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($json);
	}

	public function create()
	{
		try {
			if(
				!isset($_POST['nome']) ||
				!isset($_POST['descricao']) ||
				!isset($_POST['quantidade']) ||
				!isset($_POST['preco'])
			) throw new \Exception('Erro: falta de parametros !');

			$this->model = new ProdutoDao(
				$_POST['nome'],
				$_POST['descricao'],
				$_POST['quantidade'],
				$_POST['preco']
			);
			$this->model->importado =$_POST['importado']==1?TRUE:FALSE;

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');
			
			if ($this->model->create())
				echo json_encode([
					"success" => "Produto criado com sucesso!",
					"data" => $this->model->mapColumns()
				]);
			else throw new \Exception("Erro ao criar produto!");

		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}
}
