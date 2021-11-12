<?php

namespace App\Minat\Controller;

use App\Chronology\Model\Chronology;
use App\GroupKontak\Model\GroupKontak;
use App\HargaItem\Model\HargaItem;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\Kabupaten\Model\Kabupaten;
use App\Kecamatan\Model\Kecamatan;
use App\Kelurahan\Model\Kelurahan;
use App\Kontak\Model\Kontak;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Media\Model\Media;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\Provinsi\Model\Provinsi;
use App\Reseller\Model\Reseller;
use App\Sales\Model\Sales;
use App\SalesPerorangan\Model\SalesPerorangan;
use App\UserRequestSurvey\Model\UserRequestSurvey;
use App\Users\Model\Users;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class MinatController extends GlobalFunc
{
    public $model;
    public $username;

    public function __construct()
    {
        $this->model = new Minat();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll("WHERE status < 7");
        $minat_layanan = new MinatLayanan();

        foreach ($datas as $key => $value) {
            if ($value['status'] == '1') {
                $datas[$key]['statusText'] = 'Minat';
            } else if ($value['status'] == '2') {
                $datas[$key]['statusText'] = 'Request Survey (Soft)';
            } else if ($value['status'] == '3') {
                $datas[$key]['statusText'] = 'Input Hasil Soft Survey (Soft)';
            } else if ($value['status'] == '4') {
                $datas[$key]['statusText'] = 'Konfirmasi Request Survey (Soft)';
            } else if ($value['status'] == '5') {
                $datas[$key]['statusText'] = 'Lanjut Survey Onsite';
            } else if ($value['status'] == '6') {
                $datas[$key]['statusText'] = 'Survey Onsite';
            } else if ($value['status'] == '7') {
                $datas[$key]['statusText'] = 'User';
            } else if ($value['status'] == '8') {
                $datas[$key]['statusText'] = 'Prospek';
            } else if ($value['status'] == '9') {
                $datas[$key]['statusText'] = 'User';
            }

            if ($value['tercover'] == '1') {
                $datas[$key]['tercoverText'] = 'Tercover';
            } else if ($value['tercover'] == '2') {
                $datas[$key]['tercoverText'] = 'Tidak Tercover';
            }
        }

        return $this->render_template('admin/master/minat/index', ['datas' => $datas]);
    }

    public function detail(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);

        if ($datas['status'] == '1') {
            $datas['statusText'] = 'Minat';
        } else if ($datas['status'] == '2') {
            $datas['statusText'] = 'Request Survey (Soft)';
        } else if ($datas['status'] == '3') {
            $datas['statusText'] = 'Input Hasil Soft Survey (Soft)';
        } else if ($datas['status'] == '4') {
            $datas['statusText'] = 'Konfirmasi Request Survey (Soft)';
        } else if ($datas['status'] == '5') {
            $datas['statusText'] = 'Lanjut Survey Onsite';
        } else if ($datas['status'] == '6') {
            $datas['statusText'] = 'Survey Onsite';
        } else if ($datas['status'] == '7') {
            $datas['statusText'] = 'User';
        } else if ($datas['status'] == '8') {
            $datas['statusText'] = 'Prospek';
        } else if ($datas['status'] == '9') {
            $datas['statusText'] = 'User';
        }
        // dd($datas);


        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);

        // Alamat
        $kode_minat = uniqid('M-');
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $id . "'");
        // dd($data_minat_layanan);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['kodeMinat'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['kodeMinat'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $datas['kodeMinat'] . "' AND idKontak = '" . $id_jenis_email . "'");

        return $this->render_template('admin/master/minat/detail', ['datas' => $datas, 'kode_minat' => $kode_minat, 'provinsi' => $data_provinsi, 'data_minat_layanan' => $data_minat_layanan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_sales' => $data_sales]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $kode_minat = uniqid('M-');
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();
        $layanan = new LayananInternet();
        $data_layanan = $layanan->selectAll();
        $kecepatan = new LayananInternet();
        $data_kecepatan = $kecepatan->selectAll();
        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);

        return $this->render_template('admin/master/minat/create', ['kode_minat' => $kode_minat, 'provinsi' => $data_provinsi, 'layanan' => $data_layanan, 'kecepatan' => $data_kecepatan, 'data_sales' => $data_sales]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $request->request->all();

        // $layanan = new LayananInternet();
        // $data_layanan = $layanan->selectOne("WHERE idLayananinternet  =  '" . $datas['idLayanan'] . "'");
        // dd($datas, $data_layanan['namaLayanan']);

        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $create = $this->model->create($request->request);

        $group_kontak = new GroupKontak();

        // create kontak minat telepon
        $data_group_kontak_telp = [
            'idRelation' => $create,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        // create kontak minat whatsapp
        $data_group_kontak_whatsapp = [
            'idRelation' => $create,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        // create kontak minat email
        $data_group_kontak_email = [
            'idRelation' => $create,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);

        // store foto lokasi
        $media = new Media();
        $media->create($_FILES['fotolokasi'], $create, '1', 'foto-lokasi');
        // dd($_FILES['fotolokasi']);


        // Store Layanan
        $layanan = new LayananInternet();
        $layanan_detail = new LayananInternetDetail();
        $minat_layanan = new MinatLayanan();
        $data_layanan = $layanan->selectOne("WHERE idLayananinternet  =  '" . $datas['idLayanan'] . "'");
        $data_layanan_detail = $layanan_detail->selectOne("WHERE idLayananinternetdetail = '" . $datas['idLayanandetail'] . "'");
        $data_minat_layanan = [
            'idMinat' => $datas['kodeMinat'],
            'idLayanan' => $data_layanan['idLayananinternet'],
            'idLayanandetail' => $data_layanan_detail['idLayananinternetdetail'],
            'biayaregistrasiLayanan' => $data_layanan['biayaregistrasi'],
            'biayabulananLayanan' => $data_layanan_detail['biayabulanan'],
            'biayadasarregistrasiLayanan' => $data_layanan['biayadasarregistrasiLayanan'],
            'biayadasarbulananLayanan' => $data_layanan_detail['biayadasarbulanan'],
            'ppnbiayaregistrasiLayanan' => $data_layanan['ppn'],
            'ppnbiayabulananLayanan' => $data_layanan_detail['ppn'],
        ];
        $create_data_layanan = $minat_layanan->create($data_minat_layanan);

        // create chronlogy
        // $chronology = new Chronology();
        // $message = $this->model->chronologyMessage('store', 'User 1', [
        //     'produk' => $request->request->get('namaItem')
        // ]);
        // $createChronology = $chronology->create($message, $produk);

        $user = new Users();
        $namaUser = $_SESSION['_sf2_attributes']['namaUser'];

        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "" . $namaUser . " telah menambahkan data peminat baru atas nama <b>" . $datas['namaPemohon'] . "</b> dengan layanan <b>" . $data_layanan['namaLayanan'] . " " . $data_layanan_detail['kecepatan'] . " Mbps</b>";
        $kirim = $user->telegram($message, $ambilUser['chatId']);

        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menambahkan data pada menu Data Minat atas nama <b>" . $datas['namaPemohon'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/minat');
    }

    public function edit(Request $request)
    {

        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($detail);

        $provinsi = new Provinsi();
        $kabupaten = new Kabupaten();
        $kecamatan = new Kecamatan();
        $kelurahan = new Kelurahan();

        // Alamat Pemasangan
        $data_provinsi = $provinsi->selectAll();
        $data_kabupaten = $kabupaten->selectAll("WHERE idProvinsi = '" . $detail['idProvinsi'] . "'");
        $data_kecamatan = $kecamatan->selectAll("WHERE idKabupaten = '" . $detail['idKabupaten'] . "'");
        $data_kelurahan = $kelurahan->selectAll("WHERE idKecamatan = '" . $detail['idKecamatan'] . "'");

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $id . "'");
        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();
        // dd($data_minat_layanan, $layanan, $layanan_detail);

        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);
        // dd($data_sales);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_email . "'");


        return $this->render_template('admin/master/minat/edit', ['detail' => $detail, 'provinsi' => $data_provinsi, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_minat_layanan' => $data_minat_layanan, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_sales' => $data_sales, 'data_kabupaten' => $data_kabupaten, 'data_kecamatan' => $data_kecamatan, 'data_kelurahan' => $data_kelurahan]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $request->request->all();
        // dd($datas);

        $minat_layanan = new MinatLayanan();
        $layanan = new LayananInternet();
        $layanan_detail = new LayananInternetDetail();
        $data_layanan = $layanan->selectOne("WHERE idLayananinternet  =  '" . $datas['idLayanan'] . "'");
        $data_layanan_detail = $layanan_detail->selectOne("WHERE idLayananinternet = '" . $datas['idLayanandetail'] . "'");
        $data_minat_layanan = [
            'idMinat' => $datas['kodeMinat'],
            'idLayanan' => $data_layanan['idLayananinternet'],
            'idLayanandetail' => $data_layanan_detail['idLayananinternetdetail'],
            'biayaregistrasiLayanan' => $data_layanan['biayaregistrasi'],
            'biayabulananLayanan' => $data_layanan_detail['biayabulanan'],
            'biayadasarregistrasiLayanan' => $data_layanan['biayadasarregistrasiLayanan'],
            'biayadasarbulananLayanan' => $data_layanan_detail['biayadasarbulanan'],
            'ppnbiayaregistrasiLayanan' => $data_layanan['ppn'],
            'ppnbiayabulananLayanan' => $data_layanan_detail['ppn'],
        ];
        // dd($data_layanan_detail, $datas);

        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        $update = $this->model->update($id, $datas);

        $minat_layanan = new MinatLayanan();
        $layanan = new LayananInternet();
        $layanan_detail = new LayananInternetDetail();

        $data_layanan = $layanan->selectOne("WHERE idLayananinternet  =  '" . $datas['idLayanan'] . "'");
        $data_layanan_detail = $layanan_detail->selectOne("WHERE idLayananinternet = '" . $datas['idLayanandetail'] . "'");
        // dd($data_layanan, $data_layanan_detail);
        $d_minat_layanan = $minat_layanan->delete($detail['kodeMinat']);

        $data_minat_layanan = [
            'idMinat' => $datas['kodeMinat'],
            'idLayanan' => $data_layanan['idLayananinternet'],
            'idLayanandetail' => $data_layanan_detail['idLayananinternetdetail'],
            'biayaregistrasiLayanan' => $data_layanan['biayaregistrasi'],
            'biayabulananLayanan' => $data_layanan_detail['biayabulanan'],
            'biayadasarregistrasiLayanan' => $data_layanan['biayadasarregistrasiLayanan'],
            'biayadasarbulananLayanan' => $data_layanan_detail['biayadasarbulanan'],
            'ppnbiayaregistrasiLayanan' => $data_layanan['ppn'],
            'ppnbiayabulananLayanan' => $data_layanan_detail['ppn'],
        ];
        // dd($data_minat_layanan);
        $create_data_layanan = $minat_layanan->create($data_minat_layanan);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Media
        if ($_FILES['fotolokasi']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItem = $media->selectOneMedia("WHERE idRelation = '$id'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fotolokasi'], $update, '1', 'foto-lokasi');
        }

        // Group Kontak
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $detail['kodeMinat'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Update with delete method
        $delete_kontak = $group_kontak->delete("WHERE idRelation = '" . $detail['kodeMinat'] . "'");
        // create kontak minat telepon
        $data_group_kontak_telp = [
            'idRelation' => $detail['kodeMinat'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        // create kontak minat whatsapp
        $data_group_kontak_whatsapp = [
            'idRelation' => $detail['kodeMinat'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        // create kontak minat email
        $data_group_kontak_email = [
            'idRelation' => $detail['kodeMinat'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah memperpaharui data pada menu Data Minat atas nama <b>" . $datas['namaPemohon'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);

        return new RedirectResponse('/minat');
    }

    public function delete(Request $request)
    {

        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $id = $request->attributes->get('id');
        // dd($id);
        $datas = $request->request->all();

        $minat = new Minat();
        $data_minat = $minat->selectOne($id);
        // dd($data_minat);
        $minat_delete = $minat->delete($id);


        $minat_layanan = new MinatLayanan();
        $minat_layanan_delete = $minat_layanan->delete($id);

        $group_kontak = new GroupKontak();
        $group_kontak_delete = $group_kontak->delete("WHERE idRelation = '" . $id . "'");

        $media = new Media();
        $selectItem = $media->selectOneMedia("WHERE idRelation = '$id'");
        // delete existing foto item
        $deleteFotoItem = $media->delete($selectItem['idMedia']);
        // delete file foto item
        $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

        $user_request = new UserRequestSurvey();
        $delete_user_request = $user_request->delete($id);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menghapus data pada menu Data Minat atas nama <b>" . $data_minat['namapemohon'] . "</b>  pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $id, $idUser);


        return new RedirectResponse('/minat');
    }

    public function get_all(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        return new JsonResponse([
            'datas' => $datas
        ]);
    }

    public function get(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);

        return new JsonResponse([
            'data' => $data
        ]);
    }

    public function cancel(Request $request)
    {

        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();

        $status = '10';
        $keterangan = $datas['keterangan'];
        $minat_status = $this->model->cancel($id, $status, $keterangan);

        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Batal";
        $kirim = $user->telegram($message, $ambilUser['chatId']);



        return new RedirectResponse('/registrasi-user-minat');
    }
}
