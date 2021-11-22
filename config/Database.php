<?php

namespace Config;

use PDO;
use PDOException;

class Database {
 
	protected $db;
    public $conn;
 
	function __construct(string $connection = 'mysql'){
        
        $this->db = [
            'connections' => [

                'mysql' => [
                    'driver' => 'mysql',
                    'host' => $_ENV['DB_HOST'],
                    'port' => $_ENV['DB_PORT'],
                    'database' => $_ENV['DB_DATABASE'],
                    'username' => $_ENV['DB_USERNAME'],
                    'password' => $_ENV['DB_PASSWORD'],
                ],

                'mysql2' => [
                    'driver' => 'mysql',
                    'host' => $_ENV['DB_HOST_SECOND'],
                    'port' => $_ENV['DB_PORT_SECOND'],
                    'database' => $_ENV['DB_DATABASE_SECOND'],
                    'username' => $_ENV['DB_USERNAME_SECOND'],
                    'password' => $_ENV['DB_PASSWORD_SECOND'],
                ],

            ],
        ];

        $this->connect($connection);
	}
    
    public function connect(string $connection = 'mysql'){
        try{
            $this->conn = new PDO(
                $this->db['connections'][$connection]['driver'] . ':host=' . $this->db['connections'][$connection]['host'] . ';port=' . $this->db['connections'][$connection]['port'] . ';dbname=' . $this->db['connections'][$connection]['database'],
                $this->db['connections'][$connection]['username'],
                $this->db['connections'][$connection]['password']
            );
        }catch(PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }
} 

?>