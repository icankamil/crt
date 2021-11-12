<?php

namespace App\Minat\Model;

use Core\GlobalFunc;
use PDOException;

class Minat extends GlobalFunc
{
    private $table = 'minat';
    private $primaryKey = 'idMinat';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT *, minat.updatedAt as updateTime FROM " . $this->table . " LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan " . $where;

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

    public function selectAllCount($where = "")
    {
        $sql = "SELECT COUNT(minat.idMinat) as count FROM " . $this->table . " LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan " . $where;

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

    public function create($datas)
    {
        $id = uniqid('M-');
        $kodeMinat = $datas->get('kodeMinat');
        $namaPemohon = $datas->get('namaPemohon');
        $latitude = explode(',', $datas->get('koordinat'))[0];
        $longtitude = explode(',', $datas->get('koordinat'))[1];
        $nomorTrancking = $datas->get('nomorTrancking');
        $status = '1';
        $tercover = null;
        $idSales = $datas->get('idSales');
        $idMitra = $datas->get('idMitra');
        $alamat = $datas->get('alamat');
        $rt = $datas->get('rt');
        $rw = $datas->get('rw');
        $idProvinsi = $datas->get('idProvinsi');
        $idKabupaten = $datas->get('idKabupaten');
        $idKecamatan = $datas->get('idKecamatan');
        $idKelurahan = $datas->get('idKelurahan');
        $kodepos = $datas->get('kodepos');
        $tanggalRequest = $datas->get('tanggalRequest');
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        $keterangan = NULL;

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$kodeMinat', '$namaPemohon', '$latitude', '$longtitude', '$nomorTrancking', '$status', '$tercover', '$idSales', '$idMitra', '$alamat', '$rt', '$rw', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan','$kodepos', '$tanggalRequest', '$createdAt', '$updatedAt','$keterangan')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $kodeMinat;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan, salesperorangan.namaSales as nameSales, salesreseller.namaSales as nameReseller FROM " . $this->table .  " LEFT JOIN provinsi ON provinsi.id = minat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = minat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = minat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = minat.idKelurahan LEFT JOIN media ON media.idRelation = minat.kodeMinat LEFT JOIN salesperorangan ON salesperorangan.idSales = minat.idSales LEFT JOIN salesreseller ON salesreseller.idSales = minat.idSales WHERE kodeMinat = '$id'";
        // dd($sql);

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
        $kodeMinat = $datas['kodeMinat'];
        $namaPemohon = $datas['namaPemohon'];
        $latitude = explode(',', $datas['koordinat'])[0];
        $longtitude = explode(',', $datas['koordinat'])[1];
        $nomorTrancking = null;
        $status = '1';
        $tercover = null;
        $idSales = $datas['idSales'];
        $idMitra = null;
        $alamat = $datas['alamat'];
        $rt = $datas['rt'];
        $rw = $datas['rw'];
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodepos = $datas['kodepos'];
        $tanggalRequest = NULL;
        $updatedAt = date('Y-m-d H:i:s');
        $keterangan = NULL;

        $sql = "UPDATE " . $this->table . " SET kodeMinat = '$kodeMinat', namaPemohon = '$namaPemohon', latitude = '$latitude', longtitude = '$longtitude', nomortracking = '$nomorTrancking', status = '$status', tercover = '$tercover', idSales = '$idSales', idMitra = '$idMitra', alamat = '$alamat', rt = '$rt', rw = '$rw', idProvinsi = '$idProvinsi', idKabupaten = '$idKabupaten', idKecamatan = '$idKecamatan', idKelurahan = '$idKelurahan', kodepos = '$kodepos', tanggalRequest = '$tanggalRequest', updatedAt = '$updatedAt', keterangan = '$keterangan'  WHERE kodeMinat = '$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE kodeMinat = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function chronologyMessage($action, $user, $object)
    {
        $message = [
            'store' => $user . " telah menambah provinsi \"" . $object['provinsi'] . "\"",
            'update' => $user . " telah mengubah provinsi \"" . $object['provinsi'] . "\"",
            'delete' => $user . " telah menghapus provinsi \"" . $object['provinsi'] . "\""
        ];

        return $message[$action];
    }


    public function updateStatus($id, $status)
    {
        $tanggalRequest = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET status = '$status', tanggalRequest = '$tanggalRequest' WHERE kodeMinat = '$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function updateStatusMinat($id, $status)
    {

        $sql = "UPDATE " . $this->table . " SET status = '$status' WHERE kodeMinat = '$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function cancel($id, $status, $keterangan)
    {

        $sql = "UPDATE " . $this->table . " SET status = '$status', keterangan = '$keterangan' WHERE kodeMinat = '$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }
}
