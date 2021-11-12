<?php

namespace App\Users\Controller;

use App\Users\Model\Users;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Users();
    }

    public function telegram(Request $request)
    {
        $datas = json_decode($request->getContent(), true);

        $user = new Users();
        $user_update = $user->updateChatId($datas);
        $message = "Hebat";

        return new JsonResponse(['message' => $message]);
    }
}
