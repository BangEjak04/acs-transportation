<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home - ACS Transportation',
            'content' => 'home/index' // File view yang akan dimuat
        ];
        $this->view('layouts/app', $data);
    }
}