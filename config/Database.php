<?php

namespace Config;

use PDO;
use PDOException;

class Database
{

    var $host = "localhost";
    var $username = "root";
    var $pass = "";
    var $db = "internal_mysql";
    var $driver = 'mysql';
    var $conn;

    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->pass);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $th) {
            echo "Tidak dapat terkoneksi dengan database" . $th->getMessage();
            die();
        }
    }
}
