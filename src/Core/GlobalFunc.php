<?php

namespace Core;

use App\LayananInternet\Model\LayananInternet;
use Config\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class GlobalFunc
{
    public $conn;
    public $baseUrl;
    public $session;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conn;
        $this->baseUrl = 'http://crt-framework.com/';
    }

    public function render_template($page, $data = [], $request = null)
    {
        if (!is_null($request)) {
            extract($request->attributes->all(), EXTR_SKIP);
        }
        extract($data, EXTR_SKIP);

        $isPermited = function ($userpermissions = [], $permissions, $option = 'required-all') {
            $result = false;

            // jika memiliki semua akses
            if ($userpermissions == '*') {
                return true;
            }

            // option "required-all"
            if ($option == 'required-all') {
                $permissionAmount = count($permissions);
                foreach ($userpermissions as $key => $value) {
                    foreach ($permissions as $key1 => $value1) {
                        if ($value == $value1) {
                            $permissionAmount--;
                        }
                    }
                }
                $result = $permissionAmount == 0 ? true : false;
            } else {
                // option "required-one"
                foreach ($userpermissions as $key => $value) {
                    if (in_array($value, $permissions)) {
                        $result = true;
                        break;
                    }
                }
            }

            return $result;
        };

        ob_start();
        include sprintf(__DIR__ . '/../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }

    public function esc_str($conn, $data)
    {
        return pg_escape_string($conn, $data);
    }

    public function beginSession()
    {
        $this->session = new Session();
        $this->session->start();

        return $this->session;
    }


    public function dd(...$var)
    {
        foreach ($var as $key => $value) {
            dump($value);
        }
        die();
    }

    public function noRegistrasi($datas)
    {
        $layanan_internet = new LayananInternet();
        $kode_layanan = $layanan_internet->selectOne("WHERE idLayananinternet = '" . $datas['idLayanan'] . "'");
        $month = date('m');
        $year = date('Y');
        $lastestData = $this->model->selectOneWHere("WHERE MONTH(createdAt) = '$month' AND YEAR(createdAt) = '$year' ORDER BY createdAt DESC");
        if (!$lastestData) {
            $noResgitrasi = $kode_layanan['kodeLayanan'] . date("my") . '001';
        } else {
            $no_urut = str_split($lastestData['noRegistrasi'], 3)[2]; // 001
            $no_urut_baru = strval(intval($no_urut) + 1); // 2
            $total_karakter_no_urut = 3;
            $angka_nol = '';
            for ($i = 0; $i < ($total_karakter_no_urut - strlen($no_urut_baru)); $i++) {
                $angka_nol .= '0';
            }
            $noResgitrasi = $kode_layanan['kodeLayanan'] . date("my") . $angka_nol . $no_urut_baru;
        }

        return $noResgitrasi;
    }
}
