<?php

namespace App\Example\Controller;

use App\Example\Model\Example;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ExampleController
{
    public $model;

    public function __construct()
    {
        $this->model = new Example();
    }

    public function index(Request $request)
    {

        return render_template('home/index', []);
    }

    public function create(Request $request)
    {

        return render_template('home/create', []);
    }

    public function store(Request $request)
    {

        return new RedirectResponse('/home');
    }

    public function edit(Request $request)
    {


        return render_template('home/edit', []);
    }

    public function update(Request $request)
    {

        return new RedirectResponse('/home');
    }

    public function detail(Request $request)
    {


        return render_template('home/detail', []);
    }

    public function delete(Request $request)
    {

        return new RedirectResponse('/home');
    }
}
