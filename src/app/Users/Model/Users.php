<?php

namespace App\Users\Model;

use Core\GlobalFunc;
use PDOException;

class Users extends GlobalFunc
{
    private $table = 'users';
    private $primaryKey = 'idUser';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($datas)
    {
        $idUser = uniqid('idUser');
        $idRole = $datas['idRole'];
        $nikUser = $datas['nikUser'];
        $namaUser = $datas['namaUser'];
        $chatId = NULL;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idUser', '$idRole', '$nikUser', '$namaUser', '$chatId', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idUser;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOneUser($id)
    {
        $sql = "SELECT * FROM " . "users" . " WHERE idUser = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();
            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $nikUser = $datas['nikUser'];
        $namaUser = $datas['namaUser'];
        $chatId = NULL;
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET nikUser = '$nikUser', namaUser = '$namaUser', chatId = '$chatId', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function updateChatId($datas)
    {
        $username = $datas['username'];
        $chatId = $datas['chatId'];

        $sql = "UPDATE " . $this->table . " SET  chatId = '$chatId' WHERE username = '" . $username . "'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $chatId;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function telegram($msg, $telegramchatid)
    {
        // $path = "https://api.telegram.org/bot1924470254:AAFice-VpivThb0tAYeTvNLnerVHrrzgIns";
        // $path = "https://api.telegram.org/bot2044276717:AAFrgNcxUt4gNCuwbBf6zxcB0gptco4tm78";
        // $result = file_get_contents($path . "/sendmessage?chat_id=" . $telegramchatid . "&text=" . $msg);


        $curl = curl_init();

        $tes = 'https://api.telegram.org/bot2044276717:AAFrgNcxUt4gNCuwbBf6zxcB0gptco4tm78/sendmessage?chat_id=626917343&text=' . $msg . '&parse_mode=html';
        // dd($tes);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $tes,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=b38669be2cacc0d778faf68b3d5fe35a'
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);

        curl_close($curl);
        // echo $response;

        return $response;
    }
}
