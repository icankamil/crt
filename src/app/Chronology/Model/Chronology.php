<?php

namespace App\Chronology\Model;

use Core\GlobalFunc;

class Chronology extends GlobalFunc
{
    private $table = 'chronology';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN users ON users.idUser = " . $this->table . ".idUser " . $where;
        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idChronology = '$id'";
        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($deskripsiChronology, $idTables, $idUser)
    {
        $idChronology = uniqid('crn');
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idChronology', '$deskripsiChronology','$idTables', '$dateCreate',  '$idUser')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idChronology;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($idChronology, $deskripsiChronology)
    {
        $sql = "UPDATE " . $this->table . " SET deskripsiChronology='$deskripsiChronology' WHERE idChronology='$idChronology'";
        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idChronology;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($idChronology)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idChronology='$idChronology'";
        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idChronology;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function chronologyWithIdTable($idTables)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idTables = '$idTables'";
        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }
}
