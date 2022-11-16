<?php

namespace Daoo\Aula03\model;

class Desconto
{
    private $descricao;
    private $taxa;

    /**
     * @param $descricao
     * @param $taxa
     */
    public function __construct($descricao='', $taxa=0)
    {
        $this->descricao = $descricao;
        $this->taxa = $taxa;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
     * @param mixed $taxa
     */
    public function setTaxa($taxa)
    {
        $this->taxa = $taxa;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value)
            $array[$key]=$value;
        return $array;
    }
}