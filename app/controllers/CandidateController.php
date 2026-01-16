<?php

namespace App\Controllers;

class CandidateController extends Controller {
    public function index($name = 'Candidate') 
    {
        $data = [
            'title' => 'Welcome to TalentHub',
            'user'  => $name
        ];
        $this->view('home/index', $data);
    }
}