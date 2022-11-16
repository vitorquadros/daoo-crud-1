<?php

namespace Daoo\Aula03\model;

interface DAO
{
    public function create();
    public function read($id = null);
    public function update();
    public function delete($id);
    
    public function filter($arrayFilter);
    public function mapColumns();
}