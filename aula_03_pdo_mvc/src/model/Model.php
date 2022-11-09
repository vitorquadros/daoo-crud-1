<?php

namespace Daoo\Aula03\model;

use Daoo\Aula03\model\Connection;
use PDO;

class Model
{
    protected $conn;
    protected $columns; //columnNames
    protected $params;  //:columnNames
    protected $updated; //set columnNames=:columnNames
    protected $values;  //array values
    protected $filters; //like
    protected const FETCH = PDO::FETCH_ASSOC;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    protected function setTable(DAO $daoObject){
        if (isset($daoObject)){
            $this->filters = '1';
            $this->columns = '';
            $this->params = '';
            $this->updated = '';
            $this->values = [];
            foreach ($daoObject->mapColumns() as $key => $value) {
                $this->params .= " :$key,";
                $this->columns .= " $key,";
                $this->values[":$key"] = is_bool($value) ? (int)$value : $value;
                $this->updated .= " `$key` = :$key,";
            }
            $this->params = substr($this->params, 0, strlen($this->params) - 1);
            $this->columns = substr($this->columns, 0, strlen($this->columns) - 1);
            $this->updated = substr($this->updated, 0, strlen($this->updated) - 1);
        }
    }

    protected function setFilters($arrayFilter)
    {
        foreach ($arrayFilter as $key => $value) {
            $this->filters .= " AND `$key` like :$key";
            $this->values[":$key"] = "%$value%";
        }
    }

    protected function executeTransaction($sqlCommands, $parameters, $useLastId = false)
    {
        try {
            $this->conn->beginTransaction();
        } catch (\PDOException $error) {
            var_dump([$error->getMessage(), $error->getTraceAsString()]);
            $this->conn->rollBack();
            unset($this->conn);
            return false;
        }
    }

    protected function dumpQuery($prepStatement){
        ob_start();                    
        $prepStatement->debugDumpParams();
        error_log(ob_get_contents());
        ob_end_clean();
    }
}