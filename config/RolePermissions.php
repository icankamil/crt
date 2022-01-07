<?php

namespace Config;

class RolePermissions
{
    protected $role_permissions = [
        [
            'id_role' => '61c3ea5e19998',
            'nama_role' => 'Developer',
            'alias_role' => 'developer',
            'permissions' => '*'
        ],
        [
            'id_role' => '61c3ebd49785e',
            'nama_role' => 'Administrator',
            'alias_role' => 'administrator',
            'permissions' => ['profil', 'berita', 'kategori-berita', 'komentar-berita', 'produk', 'kategori-produk', 'layanan', 'kategori-layanan', 'galeri', 'kategori-layanan', 'video', 'banner', 'pelanggan', 'akreditasi', 'asosiasi', 'kontak', 'sosial-media', 'pengguna', 'roles', 'profile-team', 'jabatan']
        ],
        [
            'id_role' => '61c302ba75028',
            'nama_role' => 'Editor',
            'alias_role' => 'editor',
            'permissions' => ['profil', 'berita', 'kategori-berita', 'komentar-berita', 'produk', 'kategori-produk', 'layanan', 'kategori-layanan', 'galeri', 'kategori-layanan', 'video', 'banner', 'pelanggan', 'akreditasi', 'asosiasi', 'kontak', 'sosial-media', 'profile-team']
        ],
        [
            'id_role' => '61c304b03104d',
            'nama_role' => 'User',
            'alias_role' => 'user',
            'permissions' => ['berita', 'kategori-berita', 'komentar-berita', 'produk', 'kategori-produk', 'layanan', 'kategori-layanan', 'galeri', 'kategori-galeri', 'video']
        ],
    ];

    public function getAllRolePermissions()
    {
        return $this->role_permissions;
    }

    public function getRolePermissions($idRole)
    {
        foreach ($this->role_permissions as $key => $value) {
            if ($value['id_role'] == $idRole) {
                return $value['permissions'];
            }
        }

        return [];
    }
}
