<?php

namespace Daoo\Aula03\model;

use PDO;

class Connection
{
    private static $instance;
    private static $config;

    public static function getConnection(){
        if(!isset(self::$instance)){
            $configFile = file_get_contents(__DIR__.'/config.json');
            self::$config = json_decode($configFile);
            $db = self::$config->db;
            self::$instance = new PDO("pgsql: host=$db->host;"
                                            ."port=5432;"
                                            ."dbname=$db->name;",
                                            $db->user, //user
                                            $db->pass //password
                                        );
        }
        return self::$instance;
    }
}