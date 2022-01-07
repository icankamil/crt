<?php

namespace App\Login\Model;

use App\QueryBuilder\Model\QueryBuilder;
use Core\Classes\SessionData;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Login extends QueryBuilder
{
    protected $table = 'users';
    protected $primaryKey = 'idUser';

    public function auth(string $email, string $password)
    {
        $user = $this->leftJoin('role', 'users.id_role', '=', 'role.id_role')->where('email_user', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password_user'])) {

                SessionData::set('id_user', $user['id_user']);
                SessionData::set('nama_user', $user['nama_user']);
                SessionData::set('id_role', $user['id_role']);
                SessionData::set('alias_role', $user['alias_role']);

                return new RedirectResponse('/admin/profile-saya');

            } else {
                SessionData::get()->getFlashBag()->add('errors', 'Password salah!');
            }
        } else {
            SessionData::get()->getFlashBag()->add('errors', 'Akun tidak ditemukan!');    
        }

        return new RedirectResponse('/admin');
    }
}
