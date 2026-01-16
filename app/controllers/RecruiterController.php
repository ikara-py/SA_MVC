<?php

namespace App\Controllers;

class RecruiterController extends Controller 
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'recruiter') {
            $this->view('errors/403');
            exit();
        }
    }

    public function index($name = 'Recruiter') 
    {
        $data = [
            'title' => 'Welcome to TalentHub Recruiter Dashboard',
            'user'  => $_SESSION['user_full_name'] ?? $name
        ];
        $this->view('recruiter/dashboard', $data);
    }
}