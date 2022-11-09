<?php

namespace Daoo\Aula03\model;
use PDO;

class DescontoDao extends Model implements DAO
{
    private $desconto;

    public function __construct(Desconto $desconto = new Desconto()){
        $this->desconto = $desconto;
        $this->setTable($this);
    }

    public function create()
    {
        if(!$this->desconto) return false;
        $sql = "INSERT INTO descontos ($this->columns) VALUES ($this->params)";
        $preparedStatement = $this->conn->prepare($sql);
        $result = $preparedStatement->execute($this->values);
        return ($result && $preparedStatement->rowCount()==1);
    }

    public function read($id = null)
    {
        $sql = "SELECT * FROM descontos";
        $preparedStatement = $this->conn->prepare($sql);
        if($preparedStatement->execute())
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    public function update()
    {
        $this->values[':id'] = $this->desconto->getId();
        $sql = "UPDATE descontos SET $this->updated WHERE id_desc = :id";
        $preparedStatement = $this->conn->prepare($sql);
        if ($preparedStatement->execute($this->values))
                return $preparedStatement->rowCount() > 0;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM descontos WHERE id_desc = :id";
        $preparedStatment = $this->conn->prepare($sql);
        return $preparedStatment->execute([':id'=>$id]);
    }

    public function show($id)
    {
        $sql = "SELECT * FROM descontos WHERE id_desc = :id";
        $preparedStatement = $this->conn->prepare($sql);
        if($preparedStatement->execute([':id'=>$id]))
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    public function filter($arrayFilter)
    {
        if(!sizeof($arrayFilter))die("Filtros vazios!");
        $this->setFilters($arrayFilter);
        $sql = "SELECT * FROM descontos WHERE $this->filters";
        $preparedStatement = $this->conn->prepare($sql);
        if($preparedStatement->execute($this->values))
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    public function getDescFromProd($id_prod){
        $sql = "SELECT * FROM descontos INNER JOIN prod_desc
                ON descontos.id_desc = prod_desc.id_desc WHERE prod_desc.id_prod = :id; ";
        $preparedStatement = $this->conn->prepare($sql);
        if($preparedStatement->execute([':id'=>$id_prod]))
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    public function createMany($descontos)
    {
        foreach ($descontos as $desc){
            $sqls[] = "INSERT INTO descontos ($this->columns) VALUES ($this->params)";
            $params[] = [':descricao'=>$desc[0], ':taxa'=>$desc[1]];
        }
        return $this->executeTransaction($sqls,$params);
    }

    public function mapColumns(){
        return [
            "descricao"=>$this->descricao,
            "taxa"=>$this->taxa
        ];
    }
}