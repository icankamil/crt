<?php

namespace App;

class HomeController
{
    public function index()
    {
        return render_template('welcome');
    }
}