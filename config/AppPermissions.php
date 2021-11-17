<?php

namespace Config;

class AppPermissions
{
    protected $permissions = [
        [
            'menu' => 'Dashboard',
            'aliasPermission' => 'dashboard',
            'url' => '/dashboard'
        ],
        [
            'menu' => 'Fasilitas Teleconference',
            'aliasPermission' => 'fasilitas-teleconference',
            'url' => '/teleconference'
        ],
        [
            'menu' => 'Fasilitas Ruangan',
            'aliasPermission' => 'fasilitas-ruangan',
            'url' => '/fasilitasruangan'
        ],
        [
            'menu' => 'Fasilitas Teleconference dan Ruangan',
            'aliasPermission' => 'fasilitas-teleconference-dan-ruangan',
            'url' => '/teleconference-ruangan'
        ],
        [
            'menu' => 'Tindak Lanjuti Pengajuan',
            'aliasPermission' => 'tindak-lanjuti-pengajuan',
            'url' => '/tindaklanjut'
        ],
        [
            'menu' => 'Rekap',
            'aliasPermission' => 'rekap',
            'url' => '/rekap'
        ],
        [
            'menu' => 'Akun Zoom',
            'aliasPermission' => 'akun-zoom',
            'url' => '/akunzoom'
        ],
        [
            'menu' => 'Allotment Ruangan',
            'aliasPermission' => 'allotment-ruangan',
            'url' => '/ruangan'
        ],
        [
            'menu' => 'User Management',
            'aliasPermission' => 'user-management',
            'url' => '/usermanagement'
        ],
        [
            'menu' => 'User Roles',
            'aliasPermission' => 'user-roles',
            'url' => '/roles'
        ],
        [
            'menu' => 'User Permissions',
            'aliasPermission' => 'user-permissions',
            'url' => '/permissions'
        ],
        [
            'menu' => 'Data minat',
            'aliasPermission' => 'minat',
            'url' => '/minat'
        ],
        [
            'menu' => 'List Minat Per Status',
            'aliasPermission' => 'minat-status',
            'url' => '/minat-status'
        ],
        [
            'menu' => 'Request Survey Vendor',
            'aliasPermission' => 'request-survey-vendor',
            'url' => '/request-survey-vendor'
        ],
        [
            'menu' => 'Input Hasil Survey',
            'aliasPermission' => 'input-hasil-soft-survey',
            'url' => '/input-hasil-soft-survey'
        ],
        [
            'menu' => 'Konfirmasi Hasil Survey',
            'aliasPermission' => 'konfirmasi-hasil-survey',
            'url' => '/konfirmasi-hasil-survey'
        ],
        [
            'menu' => 'Atur Tanggal On Site',
            'aliasPermission' => 'atur-tanggal-onsite',
            'url' => '/atur-tanggal-onsite'
        ],
        [
            'menu' => 'Input Hasil Survey Onsite',
            'aliasPermission' => 'input-hasil-survey-onsite',
            'url' => '/input-hasil-survey-onsite'
        ],
        [
            'menu' => 'Registrasi User',
            'aliasPermission' => 'registrasi-user',
            'url' => '/registrasi-user-minat'
        ],
        [
            'menu' => 'Instalasi',
            'aliasPermission' => 'instalasi',
            'url' => '/instalasi'
        ],
        [
            'menu' => 'Aktivasi',
            'aliasPermission' => 'aktivasi',
            'url' => '/aktivasi'
        ],
        [
            'menu' => 'Start Billing',
            'aliasPermission' => 'aktif',
            'url' => '/aktif'
        ],
        [
            'menu' => 'Data User Registrasi',
            'aliasPermission' => 'data-user-registrasi',
            'url' => '/registrasi-user'
        ],
        [
            'menu' => 'Layanan Internet',
            'aliasPermission' => 'layanan-internet',
            'url' => '/layanan-internet'
        ],
        [
            'menu' => 'Kecepatan Internet',
            'aliasPermission' => 'kecepatan-internet',
            'url' => '/kecepatan-internet'
        ],
        [
            'menu' => 'UrbanLite',
            'aliasPermission' => 'Urban-Lite',
            'url' => '/Urban-Lite'
        ],
        [
            'menu' => 'UrbanMax',
            'aliasPermission' => 'urban-max',
            'url' => '/urban-max'
        ],
        [
            'menu' => 'UrbanUltimate',
            'aliasPermission' => 'urban-ultimate',
            'url' => '/urban-ultimate'
        ],
        [
            'menu' => 'Reseller',
            'aliasPermission' => 'reseller',
            'url' => '/reseller'
        ],
        [
            'menu' => 'Sales Perorangan',
            'aliasPermission' => 'Sales-Perorangan',
            'url' => '/sales-perorangan'
        ],
        [
            'menu' => 'vendor',
            'aliasPermission' => 'vendor',
            'url' => '/kvendor'
        ],
        [
            'menu' => 'Forecast',
            'aliasPermission' => 'forecast',
            'url' => '/forecast'
        ],
        [
            'menu' => 'User Management',
            'aliasPermission' => 'user-management',
            'url' => '/user-management'
        ],
        [
            'menu' => 'Riwayat',
            'aliasPermission' => 'riwayat',
            'url' => '/riwayat'
        ],

    ];

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getOnePermission($alias)
    {
        foreach ($this->permissions as $key => $value) {
            if ($value['aliasPermission'] == $alias) {
                return $value;
            }
        }

        return [];
    }
}
