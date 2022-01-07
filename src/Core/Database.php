<?php

namespace Core;

use PDO;
use PDOException;

class Database {
 
	protected $db;
    public $conn;
 
	function __construct(string $connection = 'mysql') {
        
        $database = require __DIR__.'/../../config/database.php';

        $this->db = $database;

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