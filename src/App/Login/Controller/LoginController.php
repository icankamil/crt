<?php

namespace App\Login\Controller;

use App\CmsBackground\Model\CmsBackground;
use App\CmsTitle\Model\CmsTitle;
use App\Login\Model\Login;
use App\Media\Model\Media;
use App\Role\Model\Role;
use Core\Classes\SessionData;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    public $model;

    public function __construct()
    {
        $this->model = new Login();
    }

    public function index(Request $request)
    {
        $errors = SessionData::get()->getFlashBag()->get('errors', []);

        $cms_title = new CmsTitle();
        $data_cms_title = $cms_title->first();

        $cms_background = new CmsBackground();
        $data_cms_background = $cms_background->first();

        $media = new Media();
        $data_media = $media->where('jenis_dokumen', 'cms-title')->first();

        if (session('id_user') != null) {
            return new RedirectResponse('/admin/profile-saya');
        }

        return render_template('admin/auth/login', ['errors' => $errors, 'data_cms_title' => $data_cms_title, 'data_media' => $data_media, 'data_cms_background' => $data_cms_background]);
    }

    public function login(Request $request)
    {
        if ($request->request->get('g-recaptcha-response')) {
			$captcha = $request->request->get('g-recaptcha-response');
			$secretKey = "6Ldif3EdAAAAAJx2RlrTsNYdqNJs-Az2kQz5fpm8";
			$ip = $_SERVER['REMOTE_ADDR'];
			// post request to server
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			$response = file_get_contents($url);
			$responseKeys = json_decode($response, true);
			// should return JSON with success as true
			if (!$responseKeys["success"]) {
				SessionData::get()->getFlashBag()->add('errors', 'Pengisian captcha gagal!');

				return new RedirectResponse('/admin');
			}
		} else {
			SessionData::get()->getFlashBag()->add('errors', 'Captcha wajib diisi!');

			return new RedirectResponse('/admin');
		}

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        return $this->model->auth($email, $password);
    }

    public function logout(Request $request)
    {
        SessionData::get()->invalidate();

        return new RedirectResponse('/admin');
    }
}
