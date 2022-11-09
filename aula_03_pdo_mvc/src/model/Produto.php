<?php

namespace Daoo\Aula03\model;

class Produto extends Model implements DAO
{
    private $id, $nome, $descricao, 
            $quantidadeEstoque, $preco, $importado;

    public function __construct(
            $nome = '',$descricao = '',$quantidade = 0,
            $preco = 0,$importado = false
        ) {
        parent::__construct();

        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->quantidadeEstoque = $quantidade;
        $this->preco = $preco;
        $this->importado = $importado;

        $this->setTable($this);
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO produtos ($this->columns) VALUES ($this->params)";
            $prepStmt = $this->conn->prepare($sql);
            $result = $prepStmt->execute($this->values);
            $this->dumpQuery($prepStmt);
            return ($result && $prepStmt->rowCount() == 1);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function read($id = null)
    {
        try {
            if ($id) {
                $sql = "SELECT * FROM produtos WHERE id_prod = :id";
            } else {
                $sql = "SELECT * FROM produtos";
            }
            $prepStmt = $this->conn->prepare($sql);
            if ($id) $prepStmt->bindValue(':id', $id);
            if ($prepStmt->execute()) {
                $this->dumpQuery($prepStmt);
                return $prepStmt->fetchAll(self::FETCH);
            }
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function update()
    {
        try {
            $this->values[':id'] = $this->id;
            $sql = "UPDATE produtos SET $this->updated WHERE id_prod = :id";
            $prepStmt = $this->conn->prepare($sql);
            $prepStmt->bindValue(':importado', $this->importado);
            if ($prepStmt->execute($this->values))
                return $prepStmt->rowCount() > 0;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM produtos WHERE id_prod = :id";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute([':id' => $id]))
            return $prepStmt->rowCount() > 0;
        else return false;
    }

    public function filter($arrayFilter)
    {
        $this->setFilters($arrayFilter);
        $sql = "SELECT * FROM produtos WHERE $this->filters";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute($this->values))
            return $prepStmt->fetchAll(self::FETCH);
        return false;
    }

    
    public function mapColumns()
    {
        return  [
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "qtd_estoque" => $this->quantidadeEstoque,
            "preco" => $this->preco,
            "importado" => $this->importado
        ];
    }

    public function toArray(){
        return $this->mapColumns();
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        if ($name != 'id') $this->setTable($this);
    }


    public function insertProdWithDesc($array_ids_desc)
    {
        //implementar transação
    }
}
