<?php

namespace Config;

class AppPermissions
{
    protected $permissions = [
        [
            'menu' => 'Profil',
            'aliasPermission' => 'profil',
            'url' => '/admin/profil'
        ],
        [
            'menu' => 'Berita',
            'aliasPermission' => 'berita',
            'url' => '/admin/berita'
        ],
        [
            'menu' => 'Kategori Berita',
            'aliasPermission' => 'kategori-berita',
            'url' => '/admin/kategori-berita'
        ],
        [
            'menu' => 'Komentar Berita',
            'aliasPermission' => 'komentar-berita',
            'url' => '/admin/komentar-berita'
        ],
        [
            'menu' => 'Produk',
            'aliasPermission' => 'produk',
            'url' => '/admin/produk'
        ],
        [
            'menu' => 'Kategori Produk',
            'aliasPermission' => 'kategori-produk',
            'url' => '/admin/kategori-produk'
        ],
        [
            'menu' => 'Layanan',
            'aliasPermission' => 'layanan',
            'url' => '/admin/layanan'
        ],
        [
            'menu' => 'Kategori Layanan',
            'aliasPermission' => 'kategori-layanan',
            'url' => '/admin/kategori-layanan'
        ],
        [
            'menu' => 'Galeri',
            'aliasPermission' => 'galeri',
            'url' => '/admin/galeri'
        ],
        [
            'menu' => 'Kategori Galeri',
            'aliasPermission' => 'kategori-galeri',
            'url' => '/admin/kategori-galeri'
        ],
        [
            'menu' => 'Video',
            'aliasPermission' => 'video',
            'url' => '/admin/video'
        ],
        [
            'menu' => 'Banner',
            'aliasPermission' => 'banner',
            'url' => '/admin/banner'
        ],
        [
            'menu' => 'Pelanggan',
            'aliasPermission' => 'pelanggan',
            'url' => '/admin/pelanggan'
        ],
        [
            'menu' => 'Akreditasi',
            'aliasPermission' => 'akreditasi',
            'url' => '/admin/akreditasi'
        ],
        [
            'menu' => 'Asosiasi',
            'aliasPermission' => 'asosiasi',
            'url' => '/admin/asosiasi'
        ],
        [
            'menu' => 'Kontak',
            'aliasPermission' => 'kontak',
            'url' => '/admin/kontak'
        ],
        [
            'menu' => 'Sosial Media',
            'aliasPermission' => 'sosial-media',
            'url' => '/admin/sosial-media'
        ],
        [
            'menu' => 'Pengguna',
            'aliasPermission' => 'pengguna',
            'url' => '/admin/pengguna'
        ],
        [
            'menu' => 'Roles',
            'aliasPermission' => 'roles',
            'url' => '/admin/roles'
        ],
        [
            'menu' => 'Karyawan',
            'aliasPermission' => 'karyawan',
            'url' => '/admin/karyawan'
        ],
        [
            'menu' => 'Jabatan',
            'aliasPermission' => 'jabatan',
            'url' => '/admin/jabatan'
        ],
        [
            'menu' => 'Profile Team',
            'aliasPermission' => 'profile-team',
            'url' => '/admin/profile-team'
        ],
        [
            'menu' => 'Kelola Admin Website',
            'aliasPermission' => 'menu',
            'url' => '/admin/menu'
        ],
        [
            'menu' => 'Kelola Komponen Website',
            'aliasPermission' => 'component',
            'url' => '/admin/component'
        ],
        [
            'menu' => 'Kelola Halaman Website',
            'aliasPermission' => 'halaman',
            'url' => '/admin/halaman'
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
