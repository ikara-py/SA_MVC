<?php

namespace App\Controllers;

class RecruiterController extends Controller {
    public function index($name = 'Recruiter') 
    {
        $data = [
            'title' => 'Welcome to TalentHub',
            'user'  => $name
        ];
        $this->view('home/index', $data);
    }
}