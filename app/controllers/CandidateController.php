<?php

namespace App\Controllers;

class CandidateController extends Controller 
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'candidate') {
            $this->view('errors/403');
            exit();
        }
    }

    public function index($name = 'Candidate') 
    {
        $data = [
            'title' => 'Welcome to TalentHub Candidate Dashboard',
            'user'  => $_SESSION['user_full_name'] ?? $name
        ];
        $this->view('candidate/dashboard', $data);
    }
}