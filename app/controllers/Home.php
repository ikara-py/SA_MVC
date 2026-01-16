<?php 
namespace App\Controllers;

class Home extends Controller{
    public function index($name = 'Guest') 
    {
        $data = [
            'title' => 'Welcome to TalentHub',
            'user'  => $name
        ];
        $this->view('home/index', $data);
    }
}