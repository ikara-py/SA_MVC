<?php

namespace App\Controllers;

class AdminController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            $this->view('errors/403');
            exit();
        }
    }

    public function index($name = 'Admin') 
    {
        $data = [
            'title' => 'Welcome to TalentHub Admin Dashboard',
            'user'  => $_SESSION['user_full_name'] ?? $name
        ];
        $this->view('admin/dashboard', $data);
    }
}