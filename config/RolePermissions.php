<?php

namespace Config;

class RolePermissions
{
    protected $role_permissions = [
        [
            'idRole' => 'admin-010',
            'namaRole' => 'Admin',
            'aliasRole' => 'admin',
            'permissions' => '*'
        ],
        [
            'idRole' => 'mitra-010',
            'namaRole' => 'Mitra',
            'aliasRole' => 'mitra',
            'permissions' => ['minat', 'konfirmasi-hasil-survey']
        ],
        [
            'idRole' => '98sjdhas',
            'namaRole' => 'Administrasi Penjualan',
            'aliasRole' => 'administrasi-penjualan',
            'permissions' => ['request-survey-vendor', 'input-hasil-soft-survey', 'konfirmasi-hasil-survey']
        ],
        [
            'idRole' => 'asd9jh',
            'namaRole' => 'Administrasi',
            'aliasRole' => 'administrasi',
            'permissions' => ['minat', 'list-minat-per-status', 'registrasi-user']
        ],
        [
            'idRole' => 'omnxc78',
            'namaRole' => 'IKR',
            'aliasRole' => 'ikr',
            'permissions' => ['atur-tanggal-onsite', 'input-hasil-survey-onsite', 'instalasi']
        ],
        [
            'idRole' => 'jhs8721',
            'namaRole' => 'Teknis',
            'aliasRole' => 'teknis',
            'permissions' => ['aktivasi']
        ],
        [
            'idRole' => 'ytuy77',
            'namaRole' => 'Billing',
            'aliasRole' => 'billing',
            'permissions' => ['aktif']
        ],
    ];

    public function getAllRolePermissions()
    {
        return $this->role_permissions;
    }

    public function getRolePermissions($idRole)
    {
        foreach ($this->role_permissions as $key => $value) {
            if ($value['idRole'] == $idRole) {
                return $value['permissions'];
            }
        }

        return [];
    }
}
