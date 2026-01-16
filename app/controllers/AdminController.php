<?php

namespace App\Controllers;

class AdminController extends Controller {
    public function index($name = 'Admin') 
    {
        $data = [
            'title' => 'Welcome to TalentHub',
            'user'  => $name
        ];
        $this->view('home/index', $data);
    }
}