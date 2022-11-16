<?php

namespace Daoo\Aula03\model;

class Appointment extends Model implements DAO
{
    private $id, $description, $date;

    public function __construct(
            $description = '',$date = '2022-05-05'
        ) {
        parent::__construct();

        $this->description = $description;
        $this->date = $date;

        $this->setTable($this);
    }

    public function read($id = null)
    {
        try {
            $sql = "SELECT * FROM appointments ";
            if ($id)
                $sql .= " WHERE id = :id";
          
            $prepStmt = $this->conn->prepare($sql);
            if ($id) 
                $prepStmt->bindValue(':id', $id);
            
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

    public function create()
    {
        try {
            $sql = "INSERT INTO appointments ($this->columns) " 
                    ."VALUES ($this->params)";
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


    public function update()
    {
        try {
            $this->values[':id'] = $this->id;
            $sql = "UPDATE appointments SET $this->updated  WHERE id = :id";
            $prepStmt = $this->conn->prepare($sql);
            // $prepStmt->bindValue(':importado', $this->importado);
            if ($prepStmt->execute($this->values)){
                $this->dumpQuery($prepStmt);
                return $prepStmt->rowCount() > 0;
            }
        } catch (\Exception $error) {
            error_log("ERROR: " . print_r($error, TRUE));
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM appointments WHERE id = :id";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute([':id' => $id]))
            return $prepStmt->rowCount() > 0;
        else return false;
    }

    public function filter($arrayFilter)
    {
        $this->setFilters($arrayFilter);
        $sql = "SELECT * FROM appointments WHERE $this->filters";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute($this->values))
            return $prepStmt->fetchAll(self::FETCH);
        return false;
    }

    
    public function mapColumns()
    {
        return  [
            "description" => $this->description,
            "date" => $this->date,
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
